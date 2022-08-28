<?php

namespace Modules\Store\Http\Livewire\Product;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\Store\Entities\Product;
use Modules\Store\Entities\Category;
use Modules\Store\Entities\StoreFront;
use Cookie;

class Table extends Component
{
    use WithPagination;

    public $categoriesFilter = [];
    public $storefrontsFilter = [];
    public $search;
    public $tab = 0;
    public $sortBy = false;
    public $sortAsc = 'asc';

    public $selected;
    public $selectAll = false;

    public $minimize = false;
    public $listeners = [
        'categoriesFilter' => 'categoriesFilter',
        'storefrontsFilter' => 'storefrontsFilter',
        'sortByFilter' => 'sortByFilter',
        'toggleActive' => 'toggleActive',
        'selectAll' => 'selectAll',
        'updatePrice' => 'updatePrice',
        'updateStock' => 'updateStock',
        'deleteProduct' => 'deleteProduct',
        'deleteAllProduct' => 'deleteAllProduct',
        '$refresh'
    ];

    protected $queryString = ['tab'];
    protected $paginationTheme = 'bootstrap';

    public function hydrate()
    {
        $this->dispatchBrowserEvent('hydrateEvent');
    }
    
    public function toggleSidebar(){
        $this->minimize = $this->minimize ? false : true;
        $this->mount();
    }

    public function updatePrice($id, $value){
        $product = Product::findOrFail($id);
        $product->price = str_replace('.','',$value).'.00';
        $product->update();
        session()->flash('message', 'Produk berhasil diperbarui');
        $this->emit('notify', 'Produk berhasil diperbarui');
    }

    public function updateStock($id, $value){
        $product = Product::findOrFail($id);
        $product->quantity = (float)$value;
        $product->status = (int)$value > 0 ? 1 : 0;
        $product->update();
        session()->flash('message', 'Produk berhasil diperbarui');
        $this->emit('notify', 'Produk berhasil diperbarui');
    }

    public function categoriesFilter($data)
    {
        $this->categoriesFilter = $data;
    }

    public function storefrontsFilter($data)
    {
        $this->storefrontsFilter = $data;
    }

    public function removeCategoriesFilter($value)
    {
        $categoriesFilter = $this->categoriesFilter;
        $index = array_search($value, $categoriesFilter);
        unset($categoriesFilter[$index]);
        $this->categoriesFilter = array_values($categoriesFilter);
        $this->dispatchBrowserEvent('unselect2category', $this->categoriesFilter);
    }

    public function removeStorefrontFilter($value)
    {
        $storefrontsFilter = $this->storefrontsFilter;
        $index = array_search($value, $storefrontsFilter);
        unset($storefrontsFilter[$index]);
        $this->storefrontsFilter = array_values($storefrontsFilter);
        $this->dispatchBrowserEvent('unselect2storefront', $this->storefrontsFilter);
    }

    public function removeSort()
    {
        $this->sortBy = false;
        $this->sortAsc = 'asc';
        $this->dispatchBrowserEvent('unselect2sort');
    }

    public function sortByFilter($sortBy)
    {
        $expl = explode('_', $sortBy);
        $this->sortBy = $expl[0];
        $this->sortAsc = $expl[1];
    }

    public function sortBy($field)
    {
        $this->sortBy = $field;
        $this->sortAsc = $this->sortAsc === 'asc' ? 'desc' : 'asc'; 
    }

    public function clearFilter()
    {
        $this->sortBy = false;
        $this->sortAsc = 'asc';
        $this->categoriesFilter = [];
        $this->storefrontsFilter = [];
        $this->dispatchBrowserEvent('unselect2category', $this->categoriesFilter);
        $this->dispatchBrowserEvent('unselect2storefront', $this->storefrontsFilter);
        $this->dispatchBrowserEvent('unselect2sort');
    }

    public function toggleActive($id){
        $product = Product::findOrFail($id);
        $product->status = $product->status ? 0 : 1;
        $product->update();
        $this->emit('notify', 'Produk berhasil diperbarui');
    }

    public function selectAll($selected)
    {
        $this->selected = null;
        if(count($selected) > 0){
            foreach($selected as $item){
                $this->selected[$item] = true;
            }
        }
        $this->dispatchBrowserEvent('delete-all');
    }

    public function selectedUpdate()
    {
        $this->dispatchBrowserEvent('delete-all');
    }

    public function deleteProduct($id){
        $product = Product::findOrFail($id);
        if($product){
            $product->delete();
            $this->emit('notify', 'Produk berhasil dihapus');
        }
    }

    public function deleteAllProduct()
    {
        $selected = \Arr::where($this->selected, function ($value, $key) {
            return $value == true;
        });
        $products = Product::whereIn('id', array_keys($selected))->get();
        if($products){
            $products->each->delete();
            $this->emit('notify', 'Produk berhasil dihapus');
        }
    }

    public function render()
    {   

        $products = Product::with(['brand', 'images', 'categories',
            'storefronts'
        ]);
        if($this->tab === 1){
            $products->where('status', 1);
        }
        if($this->tab === 2){
            $products->where('status', 0);
        }
        if ($this->search !== null) {
            $products->where('name', 'like', '%' . $this->search . '%');
        }
        if(count($this->categoriesFilter) > 0){
            $products->whereHas('categories', function ($query){
                $query->whereIn('category_id', $this->categoriesFilter);
            });
        }
        if(count($this->storefrontsFilter) > 0){
            $products->whereHas('storefronts', function ($query){
                $query->whereIn('storefront_id', $this->storefrontsFilter);
            });
        }
        if($this->sortBy !== false){
            $products->orderBy($this->sortBy, $this->sortAsc);
        }else{
            $products->orderBy('created_at', 'desc');
        }

        $countInActive = Product::where('status', 0)->count();
        $countActive = Product::where('status', 1)->count();

        $categories = new Category;
        $storefronts = new StoreFront;
        return view('store::livewire.product.table', [
            'products' => $products->paginate(10),
            'categories' => $categories->get(),
            'categoriesFilterLabel' => $categories->whereIn('id', $this->categoriesFilter)->get(),
            'storefronts' => $storefronts->get(),
            'storefrontsFilterLabel' => $storefronts->whereIn('id', $this->storefrontsFilter)->get(),
            'countInActive' => $countInActive,
            'countActive' => $countActive
        ])
        ->extends('theme::backend.layouts.master');
    }
}
