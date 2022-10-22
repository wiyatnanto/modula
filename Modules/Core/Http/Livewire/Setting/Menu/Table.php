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
    public $lang = "id";
    public $menuId;
    public $langId;
    public $menu_title, $target, $url, $icon, $isSeparator;
    public $menuItems = [];
    public $addCategories = [];
    public $addPages = [];

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
        $language = Language::where("code", $this->lang)->first();
        $this->menuId = $menu->id;
        $this->langId = $language->id;
        $this->menuItems = collect(
            MenuItem::with("children")
                ->where("menu_id", $menu->id)
                ->where("lang_id", $language->id)
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

    public function addItemToMenu($type)
    {
        switch ($type) {
            case "page":
                foreach ($this->addPages as $key => $page) {
                    if ($page) {
                        $page = Page::find($page)->first();
                        $menu = new Menu();
                        $menu->menu_id = $this->menuId;
                        $menu->type = $type;
                        $menu->url = "/p/" . Page::findOrFail($key)->slug;
                        $menu->target = "";
                        $menu->menu_title = Page::findOrFail($key)->title;
                        $menu->custom_class = "";
                        $menu->icon = "";
                        $menu->view = 1;
                        $menu->save();
                    }
                }
                break;
            case "category":
                $categories = Category::whereIn(
                    "id",
                    array_keys($this->addCategories)
                )->get();
                foreach ($categories as $key => $category) {
                    $menu = MenuItem::where("type", $type)
                        ->where("url", "/category/" . $category->slug)
                        ->first();
                    $menu = new MenuItem();
                    $menu->menu_id = $this->menuId;
                    $menu->type = $type;
                    $menu->url = "/category/" . $category->slug;
                    $menu->target = $this->target ? "_blank" : "";
                    $menu->menu_title = $category->name;
                    $menu->custom_class = "";
                    $menu->icon = "";
                    $menu->view = 1;
                    $menu->save();
                }
                break;
            case "custom":
                $menu = new MenuItem();
                $menu->menu_id = $this->menuId;
                $menu->lang_id = $this->langId;
                $menu->type = $this->isSeparator ? "separator" : $type;
                $menu->url = $this->isSeparator ? "#" : $this->url;
                $menu->target = $this->target ? "_blank" : "";
                $menu->menu_title = $this->menu_title;
                $menu->custom_class = null;
                $menu->icon = null;
                $menu->view = false;
                $menu->save();
                break;
            default:
        }
        $this->clear();
        $this->mount();
        $this->emit("toast", ["success", "Menu has been updated"]);
    }

    public function toggleView($id)
    {
        $menu = MenuItem::findOrFail($id);
        $menu->view = $menu->view ? 0 : 1;
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
