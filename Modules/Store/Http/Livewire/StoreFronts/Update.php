<?php

namespace Modules\Store\Http\Livewire\StoreFronts;

use Livewire\Component;
use Modules\Store\Entities\StoreFront;

class Update extends Component
{
    public $search;
    public $sortBy = false;
    public $sortAsc = 'asc';
    public $filterActive = 1;
    
    public $slug;
    public $name;
    public $onAddProducts = false;
    public $storeFrontId;

    public $minimize = false;
    protected $listeners = [
        '$refresh',
        'reloadTable' => 'reloadTable'
    ];

    public function toggleSidebar(){
        $this->minimize = $this->minimize ? false : true;
    }

    public function mount($id)
    {
        $storeFront = StoreFront::with('products')->findOrFail($id);
        $this->storeFrontId = $id;
        $this->name = $storeFront->name;
    }

    public function update()
    {
        $storeFront = StoreFront::findOrFail($this->storeFrontId);
        $storeFront->name = $this->name;
        $storeFront->save();
        $this->emit('notify', 'Etalase berhasil diperbarui');
    }

    public function reloadTable()
    {
        $this->emit('notify', 'Produk pada etalase berhasil diperbarui');
    }

    public function addProducts()
    {
        $this->onAddProducts = true;
    }

    public function render()
    {
        $storeFront = StoreFront::with(['products' => function($query){
            if($this->search !== null){
                $query->where('name','like', '%'.$this->search.'%');
            }
        }])->findOrFail($this->storeFrontId);
        $products = $storeFront->products;
        return view('store::livewire.store-front.update',[
            'storeFront' => $storeFront,
            'products' => $products
        ])
        ->extends('theme::backend.layouts.master');
    }
}
