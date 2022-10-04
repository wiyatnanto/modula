<?php

namespace Modules\Core\Http\Livewire\Setting\Menu;

use Livewire\Component;
use Modules\Core\Entities\Menu;
use Modules\Core\Entities\MenuItem;
use Modules\Blog\Entities\Category;
use Modules\Blog\Entities\Page;
use Modules\Store\Entities\Category as ProductCategory;

class Table extends Component
{
    public $search;
    public $menu = 'main';
    public $menu_title, $target, $url, $icon, $isSeparator;
    public $menuItems = [];
    public $addCategories = [];
    public $addPages = [];

    public $listeners = [
        'storeMenu' => 'storeMenu',
        'updateOrderTree' => 'updateOrderTree',
        'deleteMenuItem' => 'deleteMenuItem',
        'refreshComponent' => '$refresh'
    ];

    protected $queryString = ['menu'];

    public function mount()
    {
        $menu = Menu::where('slug', $this->menu)->first();
        $this->menuItems = collect(MenuItem::with('children')->where('menu_id', $menu->id)->get());
        // foreach(Category::get()->pluck('slug','id') as $id => $slug) {
        //     $menu = MenuItem::where('type', 'category')->where('url', '/category/'.$slug)->first();
        //     if($menu){
        //         $this->addCategories[$id] = true;
        //     }
        // }
        // foreach(Page::get()->pluck('id') as $id) {
        //     $this->addPages[$id] = true;
        // }
    }

    public function updatedMenu()
    {
        $this->mount();
        $this->emit('refreshComponent');
    }

    public function addItemToMenu($type)
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
                        $menu->icon = '';
                        $menu->view = 1;
                        $menu->save();
                    }
                }
            break;
            case 'category':
                $categories = Category::whereIn('id', array_keys($this->addCategories))->get();
                foreach($categories as $key => $category){
                    $menu = MenuItem::where('type', $type)->where('url', '/category/'.$category->slug)->first();
                    // if(isset($menu)){
                        $menu = new MenuItem();
                        $menu->name = $this->name;
                        $menu->type = $type;
                        $menu->url = '/category/'.$category->slug;
                        $menu->target = $this->target ? '_blank' : '';
                        $menu->menu_title = $category->name;
                        $menu->custom_class = '';
                        $menu->icon = '';
                        $menu->view = 1;
                        $menu->save();
                    // }
                }
            break;
            case 'custom':
                $menu = new MenuItem();
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
        $menu = MenuItem::findOrFail($id);
        $menu->view = $menu->view ? 0: 1;
        $menu->update();
        $this->emit('toast', ['success', 'Menu has been updated']);
    }

    public function updateOrderTree($datas){
        foreach($datas as $key => $data){
            $menu = MenuItem::findOrFail($data['id']);
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

    public function deleteMenuItem($id){
        $menu = MenuItem::findOrFail($id);
        if($menu){
            $menu->delete();
            $this->mount();
            $this->emit('toast', ['success', 'Menu has been updated']);
        }
    }

    public function storeMenu($name)
    {
        $menu = new Menu();
        $menu->name = $name;
        $menu->save();
        $this->menu = $menu->slug;
        $this->emit('toast', ['success', 'Menu has been created']);
        $this->mount();
        $this->emit('refreshComponent');
    }
    
    public function render()
    {
        return view('core::livewire.setting.menu.table',[
            'menus' => Menu::get()->pluck('name', 'slug'),
            'categories' => Category::get(),
            'productCategories' => ProductCategory::get(),
            'pages' => Page::get()
        ])
        ->extends('theme::backend.layouts.master');
    }
}
