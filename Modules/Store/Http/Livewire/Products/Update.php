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

class Update extends Component
{
    use WithFileUploads;
    
    public $product_id;
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
    public $attributes = [];
    public $values = [];

    public $listeners = [
        'removeImage' => 'removeImage',
        'selectAttributes' => 'selectAttributes',
        'selectAttributeValues' => 'selectAttributeValues'
    ];
    
    public function mount($id)
    {
        $product = Product::with('images','storefronts','attributes.values','files')->findOrFail($id);
        
        $this->product_id = $id;
        $this->brand = $product->brand->id;
        $this->sku = $product->sku;
        $this->name = $product->name;
        $this->category = $product->categories->first() !== null ? $product->categories->first()->id : 0;
        if(count($product->storefronts)){
            $this->storefront = $product->storefronts->pluck('id')->toArray();
        }
        $this->description = $product->description;
        $this->quantity = $product->quantity;
        $this->minOrder = $product->min_order;
        $this->price = number_format(round($product->price),0, ",", ".");
        $this->weight = $product->weight;
        $this->length = $product->length;
        $this->width = $product->width;
        $this->height = $product->height;
        for ($i = 1; $i <= 5; $i++){
            $this->images[$i] = isset($product->images[$i-1]) ? $product->images[$i-1]->image : null;
        }

        if(count($product->attributes) > 0 || $product->files){
            $this->hasVarian = true;
            if($product->files){
                $this->varianFile = $product->files->file;
            }
        }
    }

    public function removeImage($key)
    {
        $this->images[$key] = null;
    }

    public function store($action=null)
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
            'height' => ''
        ]);

        if($validatedData){
            $product = Product::findOrFail($this->product_id);
            $product->brand_id = $validatedData['brand'];
            $product->sku = '-';
            $product->name = $validatedData['name'];
            $product->description = $validatedData['description'];
            $product->quantity = $validatedData['quantity'];
            $product->min_order = $validatedData['minOrder'];
            $product->weight = $this->weightType === 'kg' ? $validatedData['weight'] * 1000 : $validatedData['weight'];
            $product->price = str_replace('.','',$validatedData['price']).'.00';
            $product->status = 1;
            $product->featured = 0;
            $product->save();
            if($this->images !== null){
                $images = [];
                for ($i = 1; $i <= count($this->images); $i++){
                    if($this->images[$i] !== null){
                        if(is_object($this->images[$i])){
                            $imageName = $this->images[$i]->store('public/files/store/products', 'local');
                            $images[] = new Image(array(
                                'product_id' => $product->id,
                                'image' => str_replace('public/files/store/products/','', $imageName),
                                'main_image' => $i === 1 ? 1 : 0,
                                'order_image' => $i
                            ));
                        }else{
                            $images[] = new Image(array(
                                'product_id' => $product->id,
                                'image' => $this->images[$i],
                                'main_image' => $i === 1 ? 1 : 0,
                                'order_image' => $i
                            ));
                        }
                    }
                }
                $product->images()->delete();
                $product->images()->saveMany($images);
            }
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
                foreach ($this->attributes as $key => $attribute) {
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
                $product->attributes()->delete();
                $product->attributes()->sync($attributes);
                $product->attribute_values()->delete();
                $product->attribute_values()->sync($attribute_values);
                if(is_object($this->varianFile)){
                    $varianFileName = $this->varianFile->store('public/files/store/files', 'local');
                        $varianFile = new File(array(
                            'product_id' => $product->id,
                            'file_category' => 'varian',
                            'file' => str_replace('public/files/store/files/','', $varianFileName)
                        ));
                    $product->files()->delete();
                    $product->files()->save($varianFile);
                }elseif($this->varianFile === null){
                    $product->files()->delete();
                }
            }
            if($product){
                return redirect()->to('/store/product')->with('message', 'Produk berhasil diperbarui');
            }
        }
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
        $this->attributes[] = ['name' => null, 'values' => []];
    }

    public function selectAttributes($index, $value)
    {
        $attribute = Attribute::where('name', $value)->first();
        $values = [];
        if($attribute){
            // foreach($attribute->values as $item){
            //     $values[] = $item->value;
            // }
        }
        // dd($index, $value);
        $this->attributes[$index] = ['name' => $value, 'values' => $values];
    }

    public function selectAttributeValues($index, $value)
    {

        $values = [];
        foreach($value as $item){
            $values[] = $item['text'];
        }
        $this->attributes[$index]['values'] = $values;
    }

    public function render()
    {
        return view('store::livewire.products.update',[
            'categories' => Category::get(),
            'brands' => Brand::get(),
            'storefronts'=> StoreFront::get(),
            'attributeoptions' => Attribute::with('values')->get()
        ])
        ->extends('theme::backend.layouts.master');
    }
}
