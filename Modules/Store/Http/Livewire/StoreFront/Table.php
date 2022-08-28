<?php

namespace Modules\Store\Http\Livewire\StoreFront;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

use Modules\Store\Entities\StoreFront;

class Table extends Component
{
    public $search;
    public $sortBy = false;
    public $sortAsc = 'asc';
    public $filterActive = 0;
    public $storeFront;
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

    public function toggleSidebar(){
        $this->minimize = $this->minimize ? false : true;
    }

    public function toggleFilterActive(){
        $this->filterActive = $this->filterActive ? 0 : 1;
    }

    public function toggleActive($id){
        $storeFronts = StoreFront::findOrFail($id);
        $storeFronts->status = $storeFronts->status ? 0 : 1;
        $storeFronts->update();
        $this->emit('notify', 'Brand berhasil diperbarui');
    }

    public function updateOrder($list){
        foreach($list as $key => $val){
            $storeFronts = StoreFront::findOrFail($val['value']);
            $storeFronts->order_menu = $val['order'];
            $storeFronts->update();
        }
    }

    public function storeStoreFront($name)
    {
        $storeFront = new StoreFront;
        $storeFront->name = $name;
        $storeFront->order_menu = 0;
        $storeFront->save();
    }

    public function edit($slug)
    {
        $this->storeFront = StoreFront::with('products')->where('slug', $slug)->firstOrFail();
        $this->products = $this->storeFronts->products;
    }

    public function delete($id)
    {
        $storeFront = StoreFront::findOrFail($id);
        $storeFront->delete();
        $this->emit('notify', 'Etalase '.$storeFront->name.' berhasil dihapus');
    }

    public function render()
    {
        $storeFronts = StoreFront::with('last_product.images')->orderBy('order_menu', 'asc');
        if($this->filterActive){
            $storeFronts->where('status', $this->filterActive);
        }
        if ($this->search !== null) {
            $storeFronts->where('name', 'like', '%' . $this->search . '%');
        }
        return view('store::livewire.store-front.table',[
            'storeFronts' => $storeFronts->get()
        ])
        ->extends('core::layouts.default.master')
        ->section('content');
    }
}
