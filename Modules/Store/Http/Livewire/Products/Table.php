<?php

namespace Modules\Store\Http\Livewire\Products;

use Cookie;
use Livewire\Component;
use Livewire\WithPagination;
use Modules\Crud\Http\Traits\WithSorting;

use Modules\Store\Entities\Product;
use Modules\Store\Entities\Category;
use Modules\Store\Entities\StoreFront;

class Table extends Component
{
    use WithPagination, WithSorting;

    public $categoriesFilter = [];
    public $storefrontsFilter = [];
    public $sortByFilter;
    public $search;

    public $selected = [];
    public $selectAll = false;

    public $minimize = false;
    public $listeners = [
        'categoriesFilter' => 'categoriesFilter',
        'storefrontsFilter' => 'storefrontsFilter',
        'toggleActive' => 'toggleActive',
        'selectAll' => 'selectAll',
        'updatePrice' => 'updatePrice',
        'updateStock' => 'updateStock',
        'delete' => 'delete',
        'bulkDelete' => 'bulkDelete',
        '$refresh'
    ];

    protected $paginationTheme = 'bootstrap';

    public function hydrate()
    {
        $this->dispatchBrowserEvent('hydrateEvent');
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatedSelectAll($value)
    {
        if($value){
            $products = Product::with(['brand', 'images', 'categories',
                'storefronts', 'variants', 'variantValues', 'variantOptions.variantValues'
            ]);
            
            if ($this->search !== null) {
                // $products->where('name', 'like', '%' . $this->search . '%');
                $products->where('name', 'ILIKE', '%' . $this->search . '%');
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
            if($this->sortField !== false){
                $products->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc');
            }else{
                $products->orderBy('created_at', 'desc');
            }
            foreach($products->get() as $item){
                $this->selected[$item->id] = true;
            }
        }else{
            $this->selected = [];
        }
    }

    public function updatePrice($id, $value){
        $product = Product::findOrFail($id);
        $product->price = str_replace('.','',$value).'.00';
        $product->update();
        $this->emit('toast', ['success', 'Product has been updated']);
    }

    public function updateStock($id, $value){
        $product = Product::findOrFail($id);
        $product->quantity = (float)$value;
        $product->status = (int)$value > 0 ? 1 : 0;
        $product->update();
        $this->emit('toast', ['success', 'Product has been updated']);
    }

    public function categoriesFilter($data)
    {
        $this->categoriesFilter = $data;
    }

    public function storefrontsFilter($data)
    {
        $this->storefrontsFilter = $data;
    }

    public function updatedSortByFilter($data)
    {
        $expl = explode('_', $data);
        $this->sortField = $expl[0];
        $this->sortAsc = $expl[1] === 'asc' ? true : false;
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
        $this->sortField = false;
        $this->sortAsc = 'asc';
        $this->dispatchBrowserEvent('unselect2sort');
    }

    public function clearFilter()
    {
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
        $this->emit('toast', ['success', 'Product has been updated']);
    }

    public function selectedUpdate()
    {
        $this->dispatchBrowserEvent('delete-all');
    }

    public function delete($id){
        $product = Product::findOrFail($id);
        if($product){
            $product->delete();
            $this->emit('toast', ['success', 'Product has been deleted']);
        }
    }

    public function bulkDelete()
    {
        $selected = \Arr::where($this->selected, function ($value, $key) {
            return $value == true;
        });
        $products = Product::whereIn('id', array_keys($selected))->get();
        if($products){
            $products->each->delete();
            $this->emit('toast', ['success', 'Products has been deleted']);
        }
    }

    public function render()
    {   
        $products = Product::with(['brand', 'images', 'categories',
            'storefronts', 'variants', 'variantValues', 'variantOptions.variantValues'
        ]);
        
        if ($this->search !== null) {
            // $products->where('name', 'like', '%' . $this->search . '%');
            $products->where('name', 'ILIKE', '%' . $this->search . '%');
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
        if($this->sortField !== false){
            $products->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc');
        }else{
            $products->orderBy('created_at', 'desc');
        }

        $countInActive = Product::where('status', 0)->count();
        $countActive = Product::where('status', 1)->count();

        $categories = new Category;
        $storefronts = new StoreFront;
        return view('store::livewire.products.table', [
            'products' => $products->fastPaginate(10),
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
