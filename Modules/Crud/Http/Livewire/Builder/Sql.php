<?php

namespace Modules\Crud\Http\Livewire\Builder;

use Livewire\Component;
use Modules\Crud\Entities\Crud;

class Sql extends Component
{
    public $title, $name, $note, $desc, $db, $db_key, $author, $type, $lang;
    public $config, $setting;

    public $joinedToggle = true;
    public $joinedTables = [];
    public $joinedMasters = [];
    public $joinedKeys = [];

    public $tableOptions = [];

    public function mount($name)
    {
        $driver = config('database.default');
        $database = config('database.connections');
        $this->db = $database[$driver]['database'];

        $crud = Crud::where('name', $name)->first();
        $this->config = \CrudHelpers::CF_decode_json($crud->config, true);
        $this->title = $crud->title;
        $this->name = $crud->name;
        $this->join_table = $this->config['join_table'];
        $this->module = 'module';
        $this->tableOptions = Crud::getTableList($this->db);
        $this->type = $crud->type == 'ajax' ? 'addon' : $crud->type;
        $this->table = $crud->db;
    }

    public function render()
    {
        return view('crud::livewire.builder.sql')->extends(
            'theme::backend.layouts.master'
        );
    }

    public function update()
    {
        $joined = [];
        $query = ' SELECT * FROM ' . $this->table;
        if ($this->joinedToggle) {
            for ($i = 0; $i < count($this->joinedTables); $i++) {
                $jt = $this->joinedTables[$i];
                $mk = $this->joinedMasters[$i];
                $jk = $this->joinedKeys[$i];
                if ($jt != '' && $mk != '' && $jk != '') {
                    $joined[$jt] = ['master' => $mk, 'join' => $jk];
                    $query .=
                        ' LEFT JOIN ' .
                        $jt .
                        ' ON ' .
                        $this->table .
                        '.' .
                        $mk .
                        ' = ' .
                        $jt .
                        '.' .
                        $jk .
                        ' ';
                }
            }
        }
        $columns = [];

        $results = Crud::getColoumnInfo($query);
        $primary_exits = '';
        foreach ($results as $r) {
            $Key =
                isset($r['flags'][1]) && $r['flags'][1] == 'primary_key'
                    ? 'PRI'
                    : '';
            if ($Key != '') {
                $primary_exits = $r['name'];
            }
            $columns[] = (object) [
                'Field' => $r['name'],
                'Table' => $r['table'],
                'Type' => $r['native_type'],
                'Key' => $Key,
            ];
        }
        $primary = $primary_exits != '' ? $primary_exits : '';
        
        try {
            \DB::select($query);
        } catch (Exception $e) {
            $error = 'Error : ' . $query;
            return response()->json([
                'status' => 'error',
                'message' => ' ERROR QUERY :<br />' . $error,
            ]);
        }
        
        $columns = Crud::getColoumnInfo($query);
        $i = 0;
        $form = [];
        $grid = [];
        foreach ($columns as $field) {
            $name = $field['name'];
            $alias = $field['table'];
            $grids = self::configGrid($name, $alias, '', $i);
            foreach ($this->config['grid'] as $g) {
                if (!isset($g['type'])) {
                    $g['type'] = 'text';
                }
                if ($g['field'] == $name && $g['alias'] == $alias) {
                    $grids = $g;
                }
            }
            $grid[] = $grids;

            if ($this->table == $alias) {
                $forms = self::configForm($name, $alias, 'text', $i);
                foreach ($this->config['forms'] as $f) {
                    if ($f['field'] == $name && $f['alias'] == $alias) {
                        $forms = $f;
                    }
                }
                $form[] = $forms;
            }

            $i++;
        }

        unset($this->config['forms']);
        unset($this->config['grid']);

        $new_config = [
            'join_table' => $joined,
            'grid' => $grid,
            'forms' => $form,
        ];
        $crud = Crud::where('name', $this->name)->first();
        $crud->config = \CrudHelpers::CF_encode_json(array_merge($this->config, $new_config));
        $crud->update();
        $this->emit('toast', ['success', 'Crud has been updated']);
    }

    public function configGrid($field, $alias, $type, $sort)
    {
        $grid = [
            'field' => $field,
            'alias' => $alias,
            'label' => ucwords(str_replace('_', ' ', $field)),
            'language' => [],
            'search' => '1',
            'download' => '1',
            'align' => 'left',
            'view' => '1',
            'detail' => '1',
            'sortable' => '1',
            'frozen' => '0',
            'hidden' => '0',
            'sortlist' => $sort,
            'width' => '100',
            'format_as' => '',
            'format_value' => '',
        ];
        return $grid;
    }

    public function configForm($field, $alias, $type, $sort, $opt = [])
    {
        $opt_type = '';
        $lookup_table = '';
        $lookup_key = '';
        if (count($opt) >= 1) {
            $opt_type = $opt[0];
            $lookup_table = $opt[1];
            $lookup_key = $opt[2];
        }

        $forms = [
            'field' => $field,
            'alias' => $alias,
            'label' => ucwords(str_replace('_', ' ', $field)),
            'language' => [],
            'required' => '',
            'view' => '1',
            'type' => self::configFieldType($type),
            'add' => '1',
            'edit' => '1',
            'search' => '1',
            'size' => 'span12',
            'sortlist' => $sort,
            'form_group' => '',
            'option' => [
                'opt_type' => $opt_type,
                'lookup_query' => '',
                'lookup_table' => $lookup_table,
                'lookup_key' => $lookup_key,
                'lookup_value' => $lookup_key,
                'is_dependency' => '',
                'select_multiple' => '0',
                'image_multiple' => '0',
                'lookup_dependency_key' => '',
                'path' => '',
                'upload_type' => '',
                'tooltip' => '',
                'attribute' => '',
                'extend_class' => '',
            ],
        ];
        return $forms;
    }

    public function configFieldType($type)
    {
        switch ($type) {
            default:
                $type = 'text';
                break;
            case 'timestamp':
                $type = 'text_datetime';
                break;
            case 'datetime':
                $type = 'text_datetime';
                break;
            case 'string':
                $type = 'text';
                break;
            case 'int':
                $type = 'text';
                break;
            case 'text':
                $type = 'textarea';
                break;
            case 'blob':
                $type = 'textarea';
                break;
            case 'select':
                $type = 'select';
                break;
        }
        return $type;
    }
}
