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
use Modules\Store\Entities\Variant;
use Modules\Store\Entities\VariantOption;
use Modules\Store\Entities\VariantValue;
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
    public $variantOptions = [];
    public $variantValues = [];
    public $variants = [];
    public $productVariants = [];
    public $productVariantSelected = [];

    // tryOn

    public $threeD_config_json = [];
    public $image_config_json = [];

    // public $values;

    protected $listeners = [
        'selectAttributes' => 'selectAttributes',
        'selectAttributeValues' => 'selectAttributeValues',
    ];

    public function mount()
    {
        $this->variantOptions = VariantOption::get();
        $this->variantValues = VariantValue::get();
    }

    public function defineCombinationAttributes()
    {
        if (count($this->variants) > 0) {
            $values = collect($this->variants)
                ->pluck('values')
                ->toArray();
            $first = array_shift($values);
            $this->productVariants = collect($first)
                // ->crossJoin(...isset($values[count($values) - 1]) && count($values[count($values) - 1]) > 0 ? $values : [])
                ->crossJoin(...$values)
                ->toArray();
        }
    }

    public function updatedHasVarian($value)
    {
        if ($value) {
            $this->variants[] = ['name' => null, 'values' => []];
            $this->defineCombinationAttributes();
        } else {
            $this->variants = [];
        }
    }

    public function addVarian()
    {
        $this->variants[] = ['name' => null, 'values' => []];
        $this->productVariants = [];
    }

    public function removeVarian($key)
    {
        unset($this->variants[$key]);
        $this->defineCombinationAttributes();
        $this->productVariants = [];
    }

    public function selectAttributes($index, $name)
    {
        $values = [];
        $variantOptions = VariantOption::where('name', $name)
            ->with('variantValues')
            ->first();
        if ($variantOptions) {
            $values = $variantOptions->variantValues;
        }
        $this->variants[$index] = ['name' => $name, 'values' => []];

        $this->emit('updateAttributeValueOptions', [
            'index' => $index,
            'options' => $values,
        ]);
    }

    public function selectAttributeValues($index, $value)
    {
        $values = [];
        foreach ($value as $item) {
            $values[] = $item['text'];
        }
        $this->variants[$index]['values'] = $values;
        $this->defineCombinationAttributes();
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
            'images.1' => 'required',
        ]);
        if ($validatedData) {
            $product = new Product();
            $product->brand_id = $validatedData['brand'];
            $product->sku = '-';
            $product->name = $validatedData['name'];
            $product->description = $validatedData['description'];
            $product->quantity = $validatedData['quantity'];
            $product->min_order = $validatedData['minOrder'];
            $product->weight = $validatedData['weight'];
            $product->price =
                str_replace('.', '', $validatedData['price']) . '.00';
            $product->status = 1;
            $product->featured = 0;
            $product->save();
            $images = [];
            for ($i = 1; $i <= count($this->images); $i++) {
                $imageName = $this->images[$i]->store(
                    'public/files/store/products',
                    'local'
                );
                $images[] = new Image([
                    'product_id' => $product->id,
                    'image' => str_replace(
                        'public/files/store/products/',
                        '',
                        $imageName
                    ),
                    'main_image' => $i === 1 ? 1 : 0,
                    'order_image' => $i,
                ]);
            }
            $product->images()->saveMany($images);

            $product->categories()->sync($validatedData['category']);
            $attach = [];
            foreach (
                collect($validatedData['storefront'])
                    ->where('selected', false)
                    ->pluck('text')
                as $item
            ) {
                $attach[] = StoreFront::create([
                    'name' => $item,
                    'order_menu' => 0,
                ])->id;
            }
            $product->storefronts()->sync(
                collect($validatedData['storefront'])
                    ->where('selected', true)
                    ->pluck('id')
                    ->merge($attach)
            );
            if ($this->hasVarian) {
                $variantOptions = [];
                $variantValues = [];
                $variants = [];
                foreach ($this->variants as $key => $variant) {
                    if ($variant['name'] !== null) {
                        $variant_id = VariantOption::firstOrCreate([
                            'name' => $variant['name'],
                            'frontend_type' => 'select',
                        ])->id;
                        foreach ($variant['values'] as $value) {
                            $value_id = VariantValue::firstOrCreate([
                                'variant_id' => $variant_id,
                                'value' => $value,
                            ])->id;
                            $variantValues[] = [
                                'value_id' => $value_id,
                            ];
                        }
                        $variantOptions[] = [
                            'variant_id' => $variant_id,
                        ];
                    }
                }

                $product->variantOptions()->sync($variantOptions);
                $product->variantValues()->sync($variantValues);
                foreach ($this->productVariants as $key => $productVariant) {
                    $variants[] = new Variant([
                        'product_id' => $product->id,
                        'variant_values' => 'values',
                        'unique_id' => implode(
                            str_split(
                                implode(
                                    collect($productVariant)->map(function ($name) {
                                            return strtolower($name);
                                        })->toArray(),
                                ),
                            ),
                        ),
                        'sku' => '',
                        'quantity' => 1,
                        'price' => 100000,
                        'sale_price' => 0,
                    ]);
                }
                // dd($variants);
                $product->variants()->saveMany($variants);
                // if(is_object($this->varianFile)){
                //     $varianFileName = $this->varianFile->store('public/files/store/files', 'local');
                //     $varianFile = new File(array(
                //         'product_id' => $product->id,
                //         'file_category' => 'varian',
                //         'file' => str_replace('public/files/store/files/','', $varianFileName)
                //     ));
                //     $product->files()->save($varianFile);
                // }
            }
            if ($product) {
                $this->emit('toast', ['success', 'Product has been created']);
                return redirect()->to('/store/products');
            }
        }
    }

    public function render()
    {
        return view('store::livewire.products.create', [
            'categories' => Category::get(),
            'brands' => Brand::get(),
            'storefronts' => StoreFront::get(),
        ])->extends('theme::backend.layouts.master');
    }
}
