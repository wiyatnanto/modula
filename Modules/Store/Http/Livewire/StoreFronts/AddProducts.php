<?php

namespace Modules\Store\Http\Livewire\StoreFronts;

use Livewire\Component;
use Modules\Store\Entities\Category;
use Modules\Store\Entities\Product;
use Modules\Store\Entities\StoreFront;


class AddProducts extends Component
{
    public $storeFrontId;
    public $search;
    public $sortBy = false;
    public $sortAsc = 'asc';
    public $categoriesFilter = [];
    public $selectedItem = [];

    protected $listeners = [
        'sortByFilter' => 'sortByFilter'
    ];

    public function mount($storeFrontId, $selected)
    {
        $this->storeFrontId = $storeFrontId;
        foreach($selected as $value)
        {
            $this->selectedItem[$value] = true;
        }
    }

    public function sortByFilter($sortBy)
    {
        $expl = explode('_', $sortBy);
        $this->sortBy = $expl[0];
        $this->sortAsc = $expl[1];
    }

    public function clearFilter()
    {
        $this->sortBy = false;
        $this->sortAsc = 'asc';
    }

    public function store()
    {
        $selected = array_keys(\Arr::where($this->selectedItem, function ($value, $key) {
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
        }
    }

    public function render()
    {   
        $categories = Category::get();
        $products = Product::where(function($query){
            if($this->search !== null){
                $query->where('name','like', '%'.$this->search.'%');
            }
        })->orderBy($this->sortBy ? $this->sortBy : 'created_at', $this->sortAsc)->get();
        return view('store::livewire.store-front.add-products',[
            'products' => $products,
            'categories' => $categories
        ]);
    }
}
