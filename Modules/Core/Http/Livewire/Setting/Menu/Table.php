<?php

namespace Modules\Core\Http\Livewire\Setting\Menu;

use Livewire\Component;
use Modules\Core\Entities\Language;
use Modules\Core\Entities\Menu;
use Modules\Core\Entities\MenuItem;
use Modules\Blog\Entities\Category;
use Modules\Blog\Entities\Page;
use Modules\Store\Entities\Category as ProductCategory;

class Table extends Component
{
    public $search;
    public $menu = "frontend";
    public $menuId;
    public $lang = "id";
    public $menu_title, $target, $url, $url_as, $icon, $isSeparator;
    public $menuItems = [];
    public $addCategories = [];
    public $addPages = [];
    public $updateMode = false;

    public $listeners = [
        "storeMenu" => "storeMenu",
        "updateOrderTree" => "updateOrderTree",
        "deleteMenuItem" => "deleteMenuItem",
        "refreshComponent" => '$refresh',
    ];

    protected $queryString = ["menu", "lang"];

    public function mount()
    {
        $menu = Menu::where("slug", $this->menu)->first();
        $this->menuId = $menu->id;
        $this->menuItems = collect(
            MenuItem::with("children")
                ->where("menu_id", $menu->id)
                ->where("lang", $this->lang)
                ->get()
        );
    }

    public function clear()
    {
        $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function updatedMenu()
    {
        $this->mount();
        $this->emit("refreshComponent");
    }

    public function updatedlang()
    {
        $this->mount();
        $this->emit("refreshComponent");
    }

    public function addItemToMenu()
    {
        $menu = new MenuItem();
        $menu->menu_id = $this->menuId;
        $menu->menu_title = $this->menu_title;
        $menu->target = $this->target;
        $menu->url = $this->url;
        $menu->url_as = $this->url_as;
        $menu->icon = $this->icon;
        $menu->type = $this->isSeparator ? "separator" : "custom";
        if ($menu->save()) {
            $this->emit("toast", ["success", "Menu has been updated"]);
            $this->mount();
        }
        // $this->clear();
        // $this->mount();
    }

    public function toggleView($id)
    {
        $menu = MenuItem::findOrFail($id);
        $menu->status = $menu->status ? 0 : 1;
        $menu->update();
        $this->emit("toast", ["success", "Menu has been updated"]);
    }

    public function updateOrderTree($datas)
    {
        foreach ($datas as $key => $data) {
            $menu = MenuItem::findOrFail($data["id"]);
            $menu->sort_order = $key;
            $menu->parent_id = 0;
            $menu->update();
            if (isset($data["children"])) {
                foreach ($data["children"] as $key2 => $data2) {
                    $menu = Menu::findOrFail($data2["id"]);
                    $menu->sort_order = $key2;
                    $menu->parent_id = $data["id"];
                    $menu->update();
                    if (isset($data2["children"])) {
                        foreach ($data2["children"] as $key3 => $data3) {
                            $menu = Menu::findOrFail($data3["id"]);
                            $menu->sort_order = $key3;
                            $menu->parent_id = $data2["id"];
                            $menu->update();
                        }
                    }
                }
            }
        }
        $this->mount();
        $this->emit("toast", ["success", "Menu has been updated"]);
    }

    public function editMenuItem($id)
    {
        $menu = MenuItem::findOrFail($id);
        $this->menuId = $menu->id;
        $this->menu_title = $menu->menu_title;
        $this->target = $menu->target;
        $this->url = $menu->url;
        $this->url_as = $menu->usl_as;
        $this->icon = $menu->icon;
        $this->isSeparator = $menu->type === "separator" ? 1 : 0;
        $this->updateMode = true;
    }

    public function deleteMenuItem($id)
    {
        $menu = MenuItem::findOrFail($id);
        if ($menu) {
            $menu->delete();
            $this->mount();
            $this->emit("toast", ["success", "Menu has been updated"]);
        }
    }

    public function storeMenu($name)
    {
        $menu = new Menu();
        $menu->name = $name;
        $menu->save();
        $this->menu = $menu->slug;
        $this->emit("toast", ["success", "Menu has been created"]);
        $this->mount();
        $this->emit("refreshComponent");
        $this->updateMode = false;
    }

    public function updateMenu()
    {
        $menu = MenuItem::findOrFail($this->menuId);
        $menu->menu_title = $this->menu_title;
        $menu->target = $this->target;
        $menu->url = $this->url;
        $menu->url_as = $this->url_as;
        $menu->icon = $this->icon;
        $menu->type = $this->isSeparator ? "separator" : "custom";
        $menu->update();
        $this->emit("toast", ["success", "Menu has been updated"]);
        $this->mount();
        $this->emit("refreshComponent");
        $this->updateMode = false;
    }

    public function render()
    {
        return view("core::livewire.setting.menu.table", [
            "menus" => Menu::get()->pluck("name", "slug"),
            "languages" => Language::get()->pluck("name", "code"),
            "categories" => Category::get(),
            "productCategories" => ProductCategory::get(),
            "pages" => Page::get(),
        ])->extends("theme::backend.layouts.master");
    }
}
