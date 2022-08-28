<?php

namespace Modules\Crud\Http\Livewire\Builder;

use Livewire\Component;
use Modules\Crud\Entities\Crud;
use Illuminate\Http\File;

class Publish extends Component
{
    public $name, $module, $config;
    public $modulesOptions = [];
    public $type = 'embed';

    protected $queryString = [
        'type'
    ];

    public function mount()
    {
        $modules = \Module::all();
        foreach($modules as $key => $module){
            $this->modulesOptions[] = $module->getLowerName(); 
        }
    }

    public function publish()
    {
        $crud = Crud::where('name', $this->name)->first();
        $this->config = \CrudHelpers::CF_decode_json($crud->config, true);

        $replaces = array(
            'Module'    => ucwords($this->module),
            'module'    => $this->module,
            'Name'      => ucwords($this->name),
            'name'      => $this->name
        );

        $table_class = file_get_contents(module_path('Crud','Resources/views/stubs/Table.php.stub'));
        $table_view = file_get_contents(module_path('Crud','Resources/views/stubs/create.blade.php.stub'));
        $create_view = file_get_contents(module_path('Crud','Resources/views/stubs/create.blade.php.stub'));
        $update_view = file_get_contents(module_path('Crud','Resources/views/stubs/update.blade.php.stub'));

        $table_class_from = $this->blend($table_class, $replaces);
        $table_view_from = $this->blend($table_view, $replaces);
        $create_view_from = $this->blend($create_view, $replaces);
        $update_view_from = $this->blend($update_view, $replaces);

        if(!is_dir(module_path(ucwords($this->module),'Http/Livewire/'.ucwords($this->name)))){
            mkdir(module_path(ucwords($this->module),'Http/Livewire/'.ucwords($this->name)),0777, true);
        }
        $table_class_to = module_path(ucwords($this->module),'Http/Livewire/'.ucwords($this->name).'/Table.php');
		file_put_contents( $table_class_to, $table_class_from);

        if(!is_dir(module_path(ucwords($this->module),'Resources/views/livewire/'.$this->name))){
            mkdir(module_path(ucwords($this->module),'Resources/views/livewire/'.$this->name),0777, true);
        }
        $table_view_to = module_path(ucwords($this->module),'Resources/views/livewire/'.$this->name.'/table.blade.php');
		file_put_contents( $table_view_to, $table_view_from);
        $create_view_to = module_path(ucwords($this->module),'Resources/views/livewire/'.$this->name.'/create.blade.php');
		file_put_contents( $create_view_to, $create_view_from);
        $update_view_to = module_path(ucwords($this->module),'Resources/views/livewire/'.$this->name.'/update.blade.php');
		file_put_contents( $update_view_to, $update_view_from);
        $this->emit('toast', ['success', 'Crud codes has been generated']);
        // dd($tablex);
        // $template = base_path().'/resources/views/Acore/builder/template/native/';
        // $controller = file_get_contents(  $template.'controller.tpl' );
        // $grid = file_get_contents(  $template.'index.tpl' );               
        // $model = file_get_contents(  $template.'model.tpl' );

        // $build_controller       = \SiteHelpers::blend($controller,$codes);    
        // $build_grid             = \SiteHelpers::blend($grid,$codes);    
        // $build_model            = \SiteHelpers::blend($model,$codes);    


        // module_path('Blog');
		// if(is_array($str)){
		// 	foreach($str as $st ){
		// 		$res[] = trim(str_ireplace($src,$rep,$st));
		// 	}
		// } else {
		// 	$res = str_ireplace($src,$rep,$str);
		// }
		
		// return $res;

    }

    public function blend($str, $data)
    {
        $src = $rep = [];
		
		foreach($data as $k=>$v){
			$src[] = "{".$k."}";
			$rep[] = $v;
		}
		if(is_array($str)){
			foreach($str as $st ){
				$res[] = trim(str_replace($src,$rep,$st));
			}
		} else {
			$res = str_replace($src,$rep,$str);
		}
		return $res;
    }

    public function render()
    {
        return view('crud::livewire.builder.publish');
    }
}
