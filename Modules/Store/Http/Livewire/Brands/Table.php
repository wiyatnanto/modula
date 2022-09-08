<?php

namespace Modules\Store\Http\Livewire\Brands;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Livewire\WithPagination;
use Modules\Crud\Http\Traits\WithSorting;

use Modules\Store\Entities\Brand;

class Table extends Component
{
    use WithFileUploads, WithPagination, WithSorting;

    public $search;
    public $filterActive = 1;

    public $brandId;
    public $name;
    public $image;

    public $updateMode = false;
    public $minimize = false;

    public $listeners = [
        'delete' => 'delete',
    ];

    public function hydrate()
    {
        $this->dispatchBrowserEvent('hydrateEvent');
    }

    public function toggleSidebar()
    {
        $this->minimize = $this->minimize ? false : true;
    }

    public function toggleFilterActive()
    {
        $this->filterActive = $this->filterActive ? 0 : 1;
    }

    public function toggleActive($id)
    {
        $brand = Brand::findOrFail($id);
        $brand->status = $brand->status ? 0 : 1;
        $brand->update();
    }

    private function resetInputFields()
    {
        $this->name = null;
        $this->image = null;
    }

    public function store()
    {
        $this->resetValidation();
        $validatedData = $this->validate([
            'name' => 'required',
            'image' => 'required'
        ]);
        if ($validatedData) {
            $brand = new brand();
            $brand->name = $this->name;
            if (is_object($this->image)) {
                $fileName = $this->image->store(
                    'public/files/store/brands',
                    'local'
                );
                $brand->image = str_replace(
                    'public/files/store/brands/',
                    '',
                    $fileName
                );
            }
            $brand->save();
            if($brand){
                $this->emit('toast', ['success', 'Product has been created']);
                $this->dispatchBrowserEvent('closeModal');
            }
        }
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
        if (is_object($this->image)) {
            $fileName = $this->image->store(
                'public/files/store/brands',
                'local'
            );
            $brand->image = str_replace(
                'public/files/store/brands/',
                '',
                $fileName
            );
        }
        if($brand->update()){
            $this->updateMode = false;
            $this->resetInputFields();
            $this->emit('toast', ['success', 'Product has been deleted']);
            $this->dispatchBrowserEvent('closeModal');
        }
    }

    public function delete($id)
    {
        $brand = Brand::findOrFail($id);
        if($brand->delete()){
            $this->emit('toast', ['success', 'Product has been deleted']);
            $this->dispatchBrowserEvent('closeModal');
        }
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
            // $brands->where('name', 'like', '%' . $this->search . '%');
            $brands->where('name', 'ILIKE', '%' . $this->search . '%');
        }

        return view('store::livewire.brands.table', [
            'brands' => $brands->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')->get(),
        ])->extends('theme::backend.layouts.master');
    }
}
