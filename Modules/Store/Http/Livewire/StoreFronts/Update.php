<?php

namespace Modules\Store\Http\Livewire\StoreFronts;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\Crud\Http\Traits\WithSorting;

use Modules\Store\Entities\Product;
use Modules\Store\Entities\StoreFront;

class Update extends Component
{
    use WithPagination, WithSorting;

    public $search, $searchAllProducts;
    public $filterActive = 1;
    
    public $slug;
    public $name;
    public $onAddProducts = false;
    public $storeFrontId;

    public $categoriesFilter = [];
    public $storefrontsFilter = [];
    public $sortByFilter;
    public $selectedProducts = [];

    protected $listeners = [
        '$refresh',
        'reloadTable',
        'deleteStoreFrontProduct'
    ];

    public function toggleSidebar(){
        $this->minimize = $this->minimize ? false : true;
    }

    public function mount($id)
    {
        $storeFront = StoreFront::with('products')->findOrFail($id);
        $this->storeFrontId = $storeFront->id;
        $this->name = $storeFront->name;
        $this->slug = $storeFront->slug;
    }

    public function update()
    {
        $storeFront = StoreFront::findOrFail($this->storeFrontId);
        $storeFront->name = $this->name;
        $storeFront->save();
        $this->emit('toast', ['success', 'Store Front has been updated']);
    }

    public function reloadTable()
    {
        $this->emit('toast', ['success', 'Store Front has been updated']);
    }

    public function openProducts()
    {
        $storeFront = StoreFront::with('products')->findOrFail($this->storeFrontId);
        foreach($storeFront->products as $value)
        {
            $this->selectedProducts[$value->id] = true;
        }
    }

    public function updateStoreFrontProducts($closeModal = false)
    {
        $selected = array_keys(\Arr::where($this->selectedProducts, function ($value, $key) {
            return $value == true;
        })); 
        $storeFront = StoreFront::with('products')->findOrFail($this->storeFrontId);
        $storeFrontProducts = $storeFront->products->pluck('id')->toArray();
        foreach ($selected as $key => $productId) {
            $updated[] = array('storefront_id' => $storeFront->id, 'product_id' => $productId);
        }
        if(isset($updated)){
            $storeFront->products()->sync([]);
            $storeFront->products()->sync($updated);
            $this->emitTo('store::store-front.update','reloadTable');
            $this->emit('toast', ['success', 'Store Front has been updated']);
            if($closeModal){
                $this->dispatchBrowserEvent('closeModal');
            }
        }
    }

    public function deleteStoreFrontProduct($productId)
    {
        $storeFront = StoreFront::with('products')->findOrFail($this->storeFrontId);
        $storeFrontProducts = $storeFront->products->pluck('id','id')->toArray();
        unset($storeFrontProducts[$productId]);
        foreach ($storeFrontProducts as $key => $productId) {
            $updated[] = array('storefront_id' => $storeFront->id, 'product_id' => $productId);
        }
        if(isset($updated)){
            $storeFront->products()->sync([]);
            $storeFront->products()->sync($updated);
            $this->emitTo('store::store-front.update','reloadTable');
            $this->emit('toast', ['success', 'Store Front has been updated']);
        }
    }

    public function render()
    {
        $storeFront = StoreFront::with(['products' => function($query){
            if($this->search !== null){
                $query->where('name','like', '%'.$this->search.'%');
            }
        }])->findOrFail($this->storeFrontId);
        $products = $storeFront->products;


        // all products
        $allProducts = Product::with(['brand', 'images', 'categories',
            'storefronts', 'variants', 'variantValues', 'variantOptions.variantValues'
        ]);

        if ($this->searchAllProducts !== null) {
            $allProducts->where('name', 'ILIKE', '%' . $this->searchAllProducts . '%');
        }
        // if(count($this->categoriesFilter) > 0){
        //     $allProducts->whereHas('categories', function ($query){
        //         $query->whereIn('category_id', $this->categoriesFilter);
        //     });
        // }
        // if(count($this->storefrontsFilter) > 0){
        //     $allProducts->whereHas('storefronts', function ($query){
        //         $query->whereIn('storefront_id', $this->storefrontsFilter);
        //     });
        // }

        // if($this->sortField !== false){
        //     $allProducts->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc');
        // }else{
        //     $allProducts->orderBy('created_at', 'desc');
        // }

        // end
        return view('store::livewire.storefronts.update',[
            'storeFront' => $storeFront,
            'products' => $products,
            'allProducts' => $allProducts->fastPaginate(10)
        ])
        ->extends('theme::backend.layouts.master');
    }
}
