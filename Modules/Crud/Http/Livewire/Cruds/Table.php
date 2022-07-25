<?php

namespace Modules\Crud\Http\Livewire\Cruds;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\Crud\Entities\Crud;
use DB;

class Table extends Component
{
    use WithPagination;

    public $crudId,
        $title = 'Testing',
        $note = 'Testing',
        $author = 'Wiyatnanto',
        $desc = 'Testing',
        $name = 'Testing',
        $db,
        $db_key,
        $table,
        $lang = 'en';

    public $joinedToggle = true;
    public $joinedTables = [];
    public $joinedMasters = [];
    public $joinedKeys = [];

    public $crudType = 'default';
    public $tableOptions = [];

    public $sortField = 'id';
    public $sortAsc = true;
    public $search = '';

    public $selectAll = false;
    public $selected = [];

    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['clear', 'delete', 'bulkDelete'];

    protected $messages = [
        'name.required' => 'The Name cannot be empty.',
    ];

    public function mount()
    {
        $driver = config('database.default');
        $database = config('database.connections');

        $this->db = $database[$driver]['database'];
        // $this->dbuser = $database[$driver]['username'];
        // $this->dbpass = $database[$driver]['password'];
        // $this->dbhost = $database[$driver]['host'];

        $this->tableOptions = Crud::getTableList($this->db);
    }

    public function clear()
    {
        // $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selected = User::where(
                'name',
                'like',
                '%' . $this->search . '%'
            )
                ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                ->pluck('id');
        } else {
            $this->selected = [];
        }
    }

    public function render()
    {
        return view('crud::livewire.cruds.table', [
            'cruds' => Crud::where('name', 'like', '%' . $this->search . '%')
                ->where(function ($query) {
                    if ($this->crudType === 'core') {
                        $query->where('type', 'core');
                    } else {
                        $query->where('type', 'default');
                    }
                })
                ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                ->paginate(10),
        ])->extends('theme::backend.layouts.master');
    }

    public function updatingJoinedTables($value)
    {
    }

    public function addJoinedCount()
    {
        // $this->joinedTables[] = null;
    }

    public function removeJoinedCount($i)
    {
        // unset($this->joinedTables[$i]);
    }

    public function store()
    {
        $this->validate([
            'title' => 'required',
            'name' => 'required|alpha|min:2|unique:crud',
            'note' => 'required',
            'db' => 'required',
        ]);

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

        $i = 0;
        $rowGrid = [];
        $rowForm = [];
        foreach ($columns as $column) {
            if (!isset($column->Table)) {
                $column->Table = $this->table;
            }
            if ($column->Key == 'PRI') {
                $column->Type = 'hidden';
            }
            if ($column->Table == $this->table) {
                $form_creator = self::configForm(
                    $column->Field,
                    $column->Table,
                    $column->Type,
                    $i
                );
                $relation = self::buildRelation($this->table, $column->Field);
                foreach ($relation as $row) {
                    $array = ['external', $row['table'], $row['column']];
                    $form_creator = self::configForm(
                        $column->Field,
                        $this->table,
                        'select',
                        $i,
                        $array
                    );
                }
                $rowForm[] = $form_creator;
            }

            $rowGrid[] = self::configGrid(
                $column->Field,
                $column->Table,
                $column->Type,
                $i
            );
            $i++;
        }

        $json_data['table_db'] = $this->table;
        $json_data['primary_key'] = $primary;
        $json_data['join_table'] = $joined;
        $json_data['grid'] = $rowGrid;
        $json_data['forms'] = $rowForm;

        $data = [
            'name' => strtolower(trim($this->name)),
            'title' => $this->title,
            'note' => $this->note,
            'author' => $this->author,
            'desc' => $this->desc,
            'db' => $this->db,
            'db_key' => $primary,
            'type' => 'default',
            'config' => \CrudHelpers::CF_encode_json($json_data),
            'lang' => $this->lang,
        ];

        $crudId = Crud::insertGetId($data);
        session()->flash('success', 'Crud created successfully.');
        $this->dispatchBrowserEvent('closeModal');
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortAsc = !$this->sortAsc;
        } else {
            $this->sortAsc = true;
        }
        $this->sortField = $field;
    }

    public function edit($id)
    {
        // $user = User::find($id);
        // $this->userId = $id;
        // $this->name = $user->name;
        // $this->email = $user->email;
        // $this->rolesOptions = Role::pluck('name','name')->all();
        // $this->roles = $user->roles->pluck('name')->all();
    }

    public function update($id)
    {
        // $this->validate([
        //     'name' => 'required',
        //     'email' => 'required|email|unique:users,email,'.$id,
        //     'password' => 'confirmed',
        //     'roles' => 'required'
        // ]);

        // $user = User::find($id);
        // $user->name = $this->name;
        // $user->email = $this->email;
        // if(!empty($this->password)) {
        //     $user->password = Hash::make($this->password);
        // }
        // $user->update();

        // DB::table('model_has_roles')
        //     ->where('model_id', $id)
        //     ->delete();

        // $user->assignRole($this->roles);
        // session()->flash('success', 'User updated successfully.');
        // $this->dispatchBrowserEvent('closeModal');
    }

    public function delete($id)
    {
        // User::find($id)->delete();
        // session()->flash('success', 'User deleted successfully.');
        // $this->dispatchBrowserEvent('closeModal');
    }

    public function bulkDelete()
    {
        // User::whereIn('id', $this->selected)->delete();
        // session()->flash('success', 'Users deleted successfully.');
        // $this->dispatchBrowserEvent('closeModal');
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

    public function buildRelation($table, $field)
    {
        $pdo = \DB::getPdo();
        $sql =
            "
        SELECT
            referenced_table_name AS 'table',
            referenced_column_name AS 'column'
        FROM
            information_schema.key_column_usage
        WHERE
            referenced_table_name IS NOT NULL
            AND table_schema = '" .
            $this->db .
            "'  AND table_name = '{$table}' AND column_name = '{$field}' ";
        $Q = $pdo->query($sql);
        $rows = [];
        while ($row = $Q->fetch()) {
            $rows[] = $row;
        }
        return $rows;
    }
}
