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
    public $quantity = 1;
    public $price;
    public $minOrder = 1;
    public $weightType;
    public $weight = '10';
    public $length = '10';
    public $width = '10';
    public $height = '10';
    public $brand;
    public $sku;

    public $hasVarian = false;
    public $varianFile;
    public $attributeOptions = [];
    public $attributeValueOptions = [];
    public $productAttributes = [];
    // public $values;

    protected $listeners = [
        'selectAttributes' => 'selectAttributes',
        'selectAttributeValues' => 'selectAttributeValues'
    ];

    public function mount(){
        $this->attributeOptions = Attribute::get();
        $this->attributeValueOptions = AttributeValue::get();
    }

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

    public function selectAttributes($index, $name)
    {
        $values = [];
        $attribute = Attribute::where('name', $name)->with('values')->first();
        if($attribute){
            $values = $attribute->values;
        }
        $this->productAttributes[$index] = ['name' => $name, 'values' => []];

        $this->emit('updateAttributeValueOptions', ['index' => $index, 'options' => $values]);
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
                $attributeValues = [];
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
                            $attributeValues[] = array(
                                'value_id' => $value_id,
                                'sku' => 'asdas',
                                'quantity' => 0
                            );
                        }
                        $attributes[] = array(
                            'attribute_id' => $attribute_id
                        );
                    }
                }
                $product->attributes()->sync($attributes);
                $product->attributeValues()->sync($attributeValues);
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
                return redirect()->to('/store/products');
            }
        }
    }

    public function render()
    {
        // dd(Attribute::with('values')->get());
        return view('store::livewire.products.create',[
            'categories' => Category::get(),
            'brands' => Brand::get(),
            'storefronts'=> StoreFront::get()
        ])
        ->extends('theme::backend.layouts.master');
    }
}
