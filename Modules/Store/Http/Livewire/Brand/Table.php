<?php

namespace Modules\Store\Http\Livewire\Brand;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

use Modules\Store\Entities\Brand;

class Table extends Component
{
    use WithFileUploads;

    public $search;
    public $sortBy = false;
    public $sortAsc = 'asc';
    public $filterActive = 1;

    public $brandId;
    public $name;
    public $image;

    public $updateMode = false;
    public $minimize = false;

    public $listeners = [
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
        $brand = Brand::findOrFail($id);
        $brand->status = $brand->status ? 0 : 1;
        $brand->update();
    }

    private function resetInputFields(){
        $this->name = null;
        $this->image = null;
    }

    public function store()
    {
        $brand = new brand;
        $brand->name = $this->name;
        if(is_object($this->image)){
            $fileName = $this->image->store('public/files/store/brands', 'local');
            $brand->image = str_replace('public/files/store/brands/','', $fileName);
        }
        $brand->save();
        $this->resetInputFields();
        $this->emit('notify', 'Brand berhasil ditambah');
    }

    public function edit($id)
    {
        $brand = Brand::find($id);
        $this->brandId = $brand->id;
        $this->name = $brand->name;
        $this->image = $brand->image;
        $this->updateMode = true;
    }

    public function update()
    {
        $brand = Brand::find($this->brandId);
        $brand->name = $this->name;
        if(is_object($this->image)){
            $fileName = $this->image->store('public/files/store/brands', 'local');
            $brand->image = str_replace('public/files/store/brands/','', $fileName);
        }
        $brand->update();
        $this->updateMode = false;
        $this->resetInputFields();
        $this->emit('notify', 'Brand berhasil diperbarui');
    }

    public function delete($id)
    {
        $brand = Brand::findOrFail($id);
        $brand->delete();
        $this->emit('notify', 'Brand '.$brand->name.' berhasil dihapus');
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }

    public function render()
    {
        $brands = Brand::with('products')->where('status', $this->filterActive);

        if ($this->search !== null) {
            $brands->where('name', 'like', '%' . $this->search . '%');
        }

        return view('store::livewire.brand.table',[
            'brands' => $brands->get()
        ])
        ->extends('core::layouts.default.master')
        ->section('content');
    }
}
