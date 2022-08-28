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
    public $menu_title, $target, $url;
    public $addCategories = [];
    public $addPages = [];

    public $listeners = [
        'updateOrderTree' => 'updateOrderTree',
        'deleteMenu' => 'deleteMenu',
        'refreshComponent' => '$refresh'
    ];

    public function addToMenu($type)
    {
        switch ($type) {
            case 'page':
                foreach($this->addPages as $key => $page){
                    if($page){
                        $page = Page::find($page)->first();
                        $menu = new Menu();
                        $menu->name = 'main';
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
            break;
            case 'custom':
                $menu = new Menu();
                $menu->name = $this->name;
                $menu->type = $type;
                $menu->url = $this->url;
                $menu->menu_title = $this->menu_title;
                $menu->target = $this->target ? '_blank' : '';
                $menu->custom_class = '';
                $menu->view = 1;
                $menu->save();
            break;
            default:
        }
        $this->emit('refreshComponent');
        $this->emit('notify', 'Menu berhasil ditambah');
    }

    public function toggleView($id)
    {
        $menu = Menu::findOrFail($id);
        $menu->view = $menu->view ? 0: 1;
        $menu->update();
        $this->emit('notify', 'Menu berhasil diperbarui');
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
        $this->emit('toast', ['success', 'Menu has been updated']);
    }

    public function deleteMenu($id){
        $menu = Menu::findOrFail($id);
        if($menu){
            $menu->delete();
            $this->emit('notify', 'Menu berhasil dihapus');
        }
    }
    
    public function render()
    {
        // dd(Page::get());
        return view('core::livewire.setting.menu.table',[
            'names' => Menu::select('name')->groupBy('name')->get()->pluck('name'),
            'menus' => Menu::with('children')->orderBy('sort_order', 'asc')->where('name', $this->name)->get(),
            'categories' => Category::get(),
            'pages' => Page::get()
        ])
        ->extends('theme::backend.layouts.master');
    }
}
