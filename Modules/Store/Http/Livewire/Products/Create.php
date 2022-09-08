<?php

namespace Modules\Store\Http\Livewire\Products;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Modules\Store\Entities\Brand;
use Modules\Store\Entities\Category;
use Modules\Store\Entities\StoreFront;
use Modules\Store\Entities\Product;
use Modules\Store\Entities\Image;
use Modules\Store\Entities\Attribute;
use Modules\Store\Entities\AttributeValue;
use Modules\Store\Entities\File;

class Create extends Component
{
    use WithFileUploads;

    public $name;
    public $category;
    public $storefront;
    public $images;
    public $description;
    public $quantity;
    public $price;
    public $minOrder;
    public $weightType;
    public $weight;
    public $length, $width, $height;
    public $brand;
    public $sku;


    public $hasVarian = false;
    public $varianFile;
    public $productAttributes = [];
    public $values;

    protected $listeners = [
        'selectAttributes' => 'selectAttributes',
        'selectAttributeValues' => 'selectAttributeValues'
    ];

    public function updatedHasVarian($value)
    {
        if($value){
            $this->productAttributes[] = ['name' => null, 'values' => []];
        }else{
            $this->productAttributes = [];
        }
    }
    public function addVarian()
    {
        $this->productAttributes[] = ['name' => null, 'values' => []];
    }

    public function removeVarian($key)
    {
        unset($this->productAttributes[$key]);
    }

    public function selectAttributes($index, $value)
    {
        $attribute = Attribute::where('name', $value)->first();
        $values = [];
        $this->productAttributes[$index] = ['name' => $value, 'values' => $values];
    }

    public function selectAttributeValues($index, $value)
    {

        $values = [];
        foreach($value as $item){
            $values[] = $item['text'];
        }
        $this->productAttributes[$index]['values'] = $values;
    }

    public function store()
    {
        $this->resetValidation();
        $validatedData = $this->validate([
            'brand' => 'required',
            'sku' => '',
            'name' => 'required',
            'category' => 'required',
            'storefront' => '',
            'description' => 'required',
            'quantity' => 'required',
            'minOrder' => 'required',
            'price' => 'required',
            'weight' => '',
            'length' => '',
            'width' => '',
            'height' => '',
            'images.1' => 'required'
        ]);

        if($validatedData){
            $product = new Product;
            $product->brand_id = $validatedData['brand'];
            $product->sku = '-';
            $product->name = $validatedData['name'];
            $product->description = $validatedData['description'];
            $product->quantity = $validatedData['quantity'];
            $product->min_order = $validatedData['minOrder'];
            $product->weight = $validatedData['weight'];
            $product->price = str_replace('.','',$validatedData['price']).'.00';
            $product->status = 1;
            $product->featured = 0;
            $product->save();
            $images = [];
            for ($i = 1; $i <= count($this->images); $i++){
                $imageName = $this->images[$i]->store('public/files/store/products', 'local');
                $images[] = new Image(array(
                   'product_id' => $product->id,
                    'image' => str_replace('public/files/store/products/','', $imageName),
                    'main_image' => $i === 1 ? 1 : 0,
                    'order_image' => $i
                ));
            }
            $product->images()->saveMany($images);

            $product->categories()->sync($validatedData['category']);
            $attach = [];
            foreach(collect($validatedData['storefront'])->where('selected', false)->pluck('text') as $item) {
                $attach[] = StoreFront::create([
                    'name' => $item,
                    'order_menu' => 0
                ])->id;
            }
            $product->storefronts()->sync(collect($validatedData['storefront'])->where('selected', true)->pluck('id')->merge($attach));
            if($this->hasVarian){
                $attributes = [];
                $attribute_values = [];
                foreach ($this->productAttributes as $key => $attribute) {
                    if($attribute['name'] !== null){
                        $attribute_id = Attribute::firstOrCreate([
                            'name' => $attribute['name'],
                            'frontend_type' => 'select'
                        ])->id;
                        foreach($attribute['values'] as $value) {
                            $value_id = AttributeValue::firstOrCreate([
                                'attribute_id' => $attribute_id,
                                'value' => $value
                            ])->id;
                            $attribute_values[] = array(
                                'value_id' => $value_id,
                                'sku' => '',
                                'quantity' => 0
                            );
                        }
                        $attributes[] = array(
                            'attribute_id' => $attribute_id
                        );
                    }
                }
                $product->attributes()->sync($attributes);
                $product->attribute_values()->sync($attribute_values);
                if(is_object($this->varianFile)){
                    $varianFileName = $this->varianFile->store('public/files/store/files', 'local');
                    $varianFile = new File(array(
                        'product_id' => $product->id,
                        'file_category' => 'varian',
                        'file' => str_replace('public/files/store/files/','', $varianFileName)
                    ));
                    $product->files()->save($varianFile);
                }
            }
            if($product){
                $this->emit('toast', ['success', 'Product has been created']);
            }
        }
    }

    public function storeAndNext()
    {

    }

    public function render()
    {
        return view('store::livewire.products.create',[
            'categories' => Category::get(),
            'brands' => Brand::get(),
            'storefronts'=> StoreFront::get(),
            'attributeoptions' => Attribute::with('values')->get()
        ])
        ->extends('theme::backend.layouts.master');
    }
}
