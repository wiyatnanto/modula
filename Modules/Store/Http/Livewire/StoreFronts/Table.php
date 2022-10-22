<?php

namespace Modules\Store\Http\Livewire\StoreFronts;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Livewire\WithPagination;
use Modules\Crud\Http\Traits\WithSorting;

use Modules\Store\Entities\StoreFront;

class Table extends Component
{
    use WithPagination, WithSorting;
    
    public $search;
    public $name;
    public $filterActive = 0;
    public $storeFrontId;
    public $products;

    public $minimize = false;
    public $listeners = [
        'storeStoreFront' => 'storeStoreFront',
        'delete' => 'delete'
    ];

    public function hydrate()
    {
        $this->dispatchBrowserEvent('hydrateEvent');
    }

    public function toggleFilterActive(){
        $this->filterActive = $this->filterActive ? 0 : 1;
    }

    public function toggleActive($id){
        $storeFronts = StoreFront::findOrFail($id);
        $storeFronts->status = $storeFronts->status ? 0 : 1;
        $storeFronts->update();
        $this->emit('toast', ['success', 'Store Front has been updated']);
    }

    public function updateOrder($list){
        foreach($list as $key => $val){
            $storeFronts = StoreFront::findOrFail($val['value']);
            $storeFronts->order_menu = $val['order'];
            $storeFronts->update();
        }
    }

    public function store()
    {
        $storeFront = new StoreFront;
        $storeFront->name = $this->name;
        $storeFront->order_menu = 0;
        $storeFront->save();
        $this->emit('toast', ['success', 'Store Front has been created']);
        $this->dispatchBrowserEvent('closeModal');
    }

    public function edit($id)
    {
        // $this->storeFront = StoreFront::with('products')->find($id);
        // $this->products = $this->storeFront->products;
    }

    public function delete($id)
    {
        $storeFront = StoreFront::findOrFail($id);
        $storeFront->products()->sync([]);
        $storeFront->delete();
        $this->emit('toast', ['success', 'Store Front has been deleted']);
    }

    public function render()
    {
        $storeFronts = StoreFront::with('products.images')->orderBy('order_menu', 'asc');
        if($this->filterActive){
            $storeFronts->where('status', $this->filterActive);
        }
        if ($this->search !== null) {
            $storeFronts->where('name', 'like', '%' . $this->search . '%');
        }
        return view('store::livewire.storefronts.table',[
            'storeFronts' => $storeFronts->fastPaginate(10)
        ])
        ->extends('theme::backend.layouts.master');
    }
}
