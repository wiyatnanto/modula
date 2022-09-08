<?php

namespace Modules\Core\Http\Livewire\Setting\Menu;

use Livewire\Component;
use Modules\Core\Entities\Menu;
use Modules\Blog\Entities\Category;
use Modules\Blog\Entities\Page;

class Table extends Component
{
    public $search;
    public $name = 'main';
    public $menu_title, $target, $url, $icon, $isSeparator;
    public $menus = [];
    public $addCategories = [];
    public $addPages = [];

    public $listeners = [
        'updateOrderTree' => 'updateOrderTree',
        'deleteMenu' => 'deleteMenu',
        'refreshComponent' => '$refresh'
    ];

    protected $queryString = ['name'];

    public function mount()
    {
        $this->menus = collect(Menu::with('children')->where('name', $this->name)->get());
    }

    public function updatedName()
    {
        $this->mount();
        $this->emit('refreshComponent');
    }

    public function addToMenu($type)
    {
        switch ($type) {
            case 'page':
                foreach($this->addPages as $key => $page){
                    if($page){
                        $page = Page::find($page)->first();
                        $menu = new Menu();
                        $menu->name = $this->name;
                        $menu->type = $type;
                        $menu->url = '/p/'.Page::findOrFail($key)->slug;
                        $menu->target = '';
                        $menu->menu_title = Page::findOrFail($key)->title;
                        $menu->custom_class = '';
                        $menu->view = 1;
                        $menu->save();
                    }
                }
            break;
            case 'category':
                foreach($this->addCategories as $key => $category){
                    if($category){
                        $menu = new Menu();
                        $menu->name = $this->name;
                        $menu->type = $type;
                        $menu->url = '/category/'.Category::findOrFail($key)->slug;
                        $menu->target = '';
                        $menu->menu_title = Category::findOrFail($key)->name;
                        $menu->custom_class = '';
                        $menu->view = 1;
                        $menu->save();
                    }
                }
            break;
            case 'custom':
                $menu = new Menu();
                $menu->name = $this->name;
                $menu->type = $this->isSeparator ? 'separator' : $type;
                $menu->url = $this->isSeparator ? '#' : $this->url;
                $menu->menu_title = $this->menu_title;
                $menu->target = $this->target ? '_blank' : '';
                $menu->custom_class = '';
                $menu->icon = $this->icon;
                $menu->view = 1;
                $menu->save();
            break;
            default:
        }
        $this->mount();
        $this->emit('toast', ['success', 'Menu has been updated']);
    }

    public function toggleView($id)
    {
        $menu = Menu::findOrFail($id);
        $menu->view = $menu->view ? 0: 1;
        $menu->update();
        $this->emit('toast', ['success', 'Menu has been updated']);
    }

    public function updateOrderTree($datas){
        foreach($datas as $key => $data){
            $menu = Menu::findOrFail($data['id']);
            $menu->sort_order = $key;
            $menu->parent_id = 0;
            $menu->update();
            if(isset($data['children'])){
                foreach($data['children'] as $key2 => $data2){
                    $menu = Menu::findOrFail($data2['id']);
                    $menu->sort_order = $key2;
                    $menu->parent_id = $data['id'];
                    $menu->update();
                    if(isset($data2['children'])){
                        foreach($data2['children'] as $key3 => $data3){
                            $menu = Menu::findOrFail($data3['id']);
                            $menu->sort_order = $key3;
                            $menu->parent_id = $data2['id'];
                            $menu->update();
                        }   
                    }
                }   
            }
        }
        $this->mount();
        $this->emit('toast', ['success', 'Menu has been updated']);
    }

    public function deleteMenu($id){
        $menu = Menu::findOrFail($id);
        if($menu){
            $menu->delete();
            $this->mount();
            $this->emit('toast', ['success', 'Menu has been updated']);
        }
    }
    
    public function render()
    {
        return view('core::livewire.setting.menu.table',[
            'names' => Menu::select('name')->groupBy('name')->get()->pluck('name'),
            'categories' => Category::get(),
            'pages' => Page::get()
        ])
        ->extends('theme::backend.layouts.master');
    }
}
