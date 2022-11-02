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

class Update extends Component
{
    use WithFileUploads;

    public $product_id;
    public $name;
    public $category;
    public $storefront;
    public $images;
    public $description;
    public $quantity = 1;
    public $price;
    public $sale_price;
    public $minOrder = 1;
    public $weightType;
    public $weight = "10";
    public $length = "10";
    public $width = "10";
    public $height = "10";
    public $brand;
    public $sku;
    public $status;

    public $bulkSelectVariant = false;

    public $hasVarian = false;
    public $varianFile;
    public $variantOptions = [];
    public $variantValues = [];
    public $variants = [];
    public $productVariants = [];
    public $productVariantDatas = [];
    public $bulkVariantValues = [];

    // tryOn
    public $threeD_config_json = [];
    public $image_config_json = [];
    public $imageRight, $imageFront, $imageLeft;

    public $listeners = [
        "removeImage" => "removeImage",
        "selectAttributes" => "selectAttributes",
        "selectAttributeValues" => "selectAttributeValues",
        "removeVarian" => "removeVarian",
        "addVarian" => "addVarian",
    ];

    public function mount($id)
    {
        $product = Product::with([
            "brand",
            "images",
            "categories",
            "storefronts",
            "variants",
            "variantOptions",
            "variantValues",
        ])->findOrFail($id);

        $this->product_id = $id;
        $this->brand = $product->brand->id;
        $this->sku = $product->sku;
        $this->name = $product->name;
        $this->category =
            $product->categories->first() !== null
                ? $product->categories->first()->id
                : 0;
        if (count($product->storefronts)) {
            $this->storefront = $product->storefronts->pluck("id")->toArray();
        }
        $this->description = $product->description;

        $this->quantity = $product->quantity;
        $this->minOrder = $product->min_order;
        $this->price =
            $product->price !== null
                ? number_format(round($product->price), 0, ",", ".")
                : $product->price;
        $this->sale_price =
            $product->sale_price !== null
                ? number_format(round($product->sale_price), 0, ",", ".")
                : $product->sale_price;

        $this->status = $product->status;
        $this->weight = $product->weight;
        $this->length = $product->length;
        $this->width = $product->width;
        $this->height = $product->height;
        $this->productVariantDatas = $product->variants;
        for ($i = 1; $i <= 5; $i++) {
            $this->images[$i] = isset($product->images[$i - 1])
                ? $product->images[$i - 1]->image
                : null;
        }

        foreach (VariantOption::get() as $variantOption) {
            $this->variantOptions[] = [
                "type" => $variantOption->name,
                "variants" => $variantOption->variantValues
                    ->pluck("value")
                    ->toArray(),
            ];
        }

        if (count($product->variants) > 0) {
            $this->hasVarian = true;
            $variants = [];
            foreach ($product->variantOptions as $index => $option) {
                $variants[] = [
                    "name" => $option->name,
                    "values" => collect($product->variantValues)
                        ->where("variant_id", $option->id)
                        ->pluck("value"),
                ];
            }
            $this->variants = $variants;
            $this->defineCombinationAttributes();
        }
    }

    public function updatedVariantOptions()
    {
        dd("asdasdas");
    }

    public function removeImage($key)
    {
        $this->images[$key] = null;
    }

    public function updatedImageRight($image)
    {
        $this->image_config_json["image_right"][
            "image_preview"
        ] = $image->temporaryUrl();
        $this->dispatchBrowserEvent("updateImageRight", $image->temporaryUrl());
    }

    public function updatedImageFront($image)
    {
        $this->image_config_json["image_front"][
            "image_preview"
        ] = $image->temporaryUrl();
        $this->dispatchBrowserEvent("updateImageFront", $image->temporaryUrl());
        $this->dispatchBrowserEvent(
            "updateImagePreview",
            $image->temporaryUrl()
        );
    }

    public function updatedImageLeft($image)
    {
        $this->image_config_json["image_left"][
            "image_preview"
        ] = $image->temporaryUrl();
        $this->dispatchBrowserEvent("updateImageLeft", $image->temporaryUrl());
    }

    public function updatedBulkSelectVariant()
    {
        $this->productVariants = collect($this->productVariants)->map(function (
            $productVariant
        ) {
            if (isset($productVariant["selected"])) {
                $productVariant["selected"] = $this->bulkSelectVariant;
                return $productVariant;
            } else {
                $productVariant["selected"] = $this->bulkSelectVariant;
                return $productVariant;
            }
        });
    }

    public function setBulkVariant()
    {
        $valid = $this->validate([
            "bulkVariantValues.price" => "required",
            "bulkVariantValues.sku" => "",
            "bulkVariantValues.quantity" => "required",
            "bulkVariantValues.weight" => "",
        ]);
        if ($valid) {
            $this->productVariants = collect($this->productVariants)->map(
                function ($productVariant) {
                    $productVariant["price"] =
                        $this->bulkVariantValues["price"];
                    $productVariant["sku"] = isset(
                        $this->bulkVariantValues["sku"]
                    )
                        ? $this->bulkVariantValues["sku"]
                        : "";
                    $productVariant["quantity"] =
                        $this->bulkVariantValues["quantity"];
                    $productVariant["weight"] =
                        $this->bulkVariantValues["weight"];
                    $productVariant["status"] = true;
                    return $productVariant;
                }
            );
        }
    }

    public function defineCombinationAttributes()
    {
        if (count($this->variants) > 0) {
            $values = collect($this->variants)
                ->pluck("values")
                ->toArray();
            $first = array_shift($values);
            $this->productVariants = collect($first)
                ->crossJoin(...$values)
                ->toArray();
        }
        foreach ($this->productVariants as $key => $value) {
        }
        $this->productVariants = collect($this->productVariants)->map(function (
            $productVariant
        ) {
            $unique_id = implode(
                str_split(
                    implode(
                        collect($productVariant)
                            ->map(function ($name) {
                                return strtolower($name);
                            })
                            ->toArray()
                    )
                )
            );
            $checkVariant = $this->productVariantDatas
                ->where("unique_id", $unique_id)
                ->first();
            if ($checkVariant) {
                return [
                    "variants" => explode("-", $checkVariant->variant_values),
                    "unique_id" => $checkVariant->unique_id,
                    "sku" => $checkVariant->sku,
                    "quantity" => $checkVariant->quantity,
                    "weight" => $checkVariant->weight,
                    "price" => number_format(
                        round($checkVariant->price),
                        0,
                        ",",
                        "."
                    ),
                    "sale_price" => number_format(
                        round($checkVariant->sale_price),
                        0,
                        ",",
                        "."
                    ),
                    "status" => $checkVariant->status,
                ];
            } else {
                return [
                    "variants" => $productVariant,
                    "unique_id" => $unique_id,
                    "sku" => null,
                    "quantity" => null,
                    "weight" => null,
                    "price" => null,
                    "sale_price" => null,
                    "status" => null,
                ];
            }
        });
    }

    public function updatedHasVarian($value)
    {
        if ($value) {
            $this->variants[] = ["name" => null, "values" => []];
            $this->defineCombinationAttributes();
        } else {
            $this->variants = [];
        }
    }

    public function addVarian()
    {
        $this->variants[] = ["name" => null, "values" => [], "options" => []];
        $this->productVariants = [];
        $this->variantOptions[] = [
            "type" => null,
            "variants" => [],
        ];
    }

    public function removeVarian($key)
    {
        unset($this->variants[$key]);
        $this->defineCombinationAttributes();
        // $this->productVariants = [];
    }

    public function selectAttributes($index, $name)
    {
        $options = [];
        $variantOption = VariantOption::where("name", $name)
            ->with("variantValues")
            ->first();
        if ($variantOption) {
            $options = $variantOption->variantValues->pluck("value")->toArray();
        }
        $this->variants[$index] = ["name" => $name, "values" => []];
        $this->emit("updateAttributeValueOptions", [
            "index" => $index,
            "options" => $options,
        ]);
    }

    public function selectAttributeValues($index, $value)
    {
        $values = [];
        foreach ($value as $item) {
            $values[] = $item["id"];
        }
        $this->variants[$index]["values"] = $values;
        $this->defineCombinationAttributes();
    }

    public function update($redirect = true)
    {
        $this->resetValidation();
        $validatedData = $this->validate([
            "brand" => "required",
            "sku" => "",
            "name" => "required",
            "category" => "required",
            "storefront" => "",
            "description" => "",
            "quantity" => "required",
            "minOrder" => "required",
            "price" => "required",
            "sale_price" => "",
            "status" => "",
            "weight" => "",
            "length" => "",
            "width" => "",
            "height" => "",
            "images.1" => "required",
        ]);

        $valid = $this->validate([
            "productVariants.*.price" => "required",
            "productVariants.*.sku" => "",
            "productVariants.*.quantity" => "required",
            "productVariants.*.weight" => "",
        ]);
        if ($validatedData) {
            $product = Product::findOrFail($this->product_id);
            $product->brand_id = $validatedData["brand"];
            $product->sku = "-";
            $product->name = $validatedData["name"];
            $product->description = $validatedData["description"];
            if ($this->hasVarian) {
                $product->price = null;
                $product->sale_price = null;
            } else {
                $product->quantity = $validatedData["quantity"];
                $product->min_order = $validatedData["minOrder"];
                $product->weight = $validatedData["weight"];
                $product->length = $validatedData["length"];
                $product->width = $validatedData["width"];
                $product->height = $validatedData["height"];
                $product->price =
                    str_replace(".", "", $validatedData["price"]) . ".00";
                $product->sale_price = $validatedData["sale_price"]
                    ? str_replace(".", "", $validatedData["sale_price"]) . ".00"
                    : $validatedData["sale_price"];
                $product->status = $validatedData["status"];
            }
            $product->featured = 0;
            $product->save();
            $images = [];
            if ($this->images !== null) {
                $images = [];
                for ($i = 1; $i <= count($this->images); $i++) {
                    if ($this->images[$i] !== null) {
                        if (is_object($this->images[$i])) {
                            $imageName = $this->images[$i]->store(
                                "public/store/products",
                                "local"
                            );
                            $images[] = new Image([
                                "product_id" => $product->id,
                                "image" => str_replace(
                                    "public/",
                                    "",
                                    $imageName
                                ),
                                "main_image" => $i === 1 ? 1 : 0,
                                "order_image" => $i,
                            ]);
                        } else {
                            $images[] = new Image([
                                "product_id" => $product->id,
                                "image" => $this->images[$i],
                                "main_image" => $i === 1 ? 1 : 0,
                                "order_image" => $i,
                            ]);
                        }
                    }
                }
                $product->images()->delete();
                $product->images()->saveMany($images);
            }
            $product->categories()->sync($validatedData["category"]);
            $attach = [];
            foreach (
                collect($validatedData["storefront"])
                    ->where("selected", false)
                    ->pluck("text")
                as $item
            ) {
                $attach[] = StoreFront::create([
                    "name" => $item,
                    "order_menu" => 0,
                ])->id;
            }
            $product->storefronts()->sync(
                collect($validatedData["storefront"])
                    ->where("selected", true)
                    ->pluck("id")
                    ->merge($attach)
            );
            if ($this->hasVarian) {
                $variantOptions = [];
                $variantValues = [];
                $variants = [];
                foreach ($this->variants as $key => $variant) {
                    if ($variant["name"] !== null) {
                        $variant_id = VariantOption::firstOrCreate([
                            "name" => $variant["name"],
                            "frontend_type" => "select",
                        ])->id;
                        foreach ($variant["values"] as $value) {
                            $value_id = VariantValue::firstOrCreate([
                                "variant_id" => $variant_id,
                                "value" => $value,
                            ])->id;

                            $variantValues[] = [
                                "value_id" => $value_id,
                            ];
                        }

                        $variantOptions[] = [
                            "variant_id" => $variant_id,
                        ];
                        // dd($variantValues);
                    }
                }
                // dd($this->productVariants);
                foreach ($this->productVariants as $key => $productVariant) {
                    $variants[] = new Variant([
                        "product_id" => $product->id,
                        "variant_values" => strval(
                            implode("-", $productVariant["variants"])
                        ),
                        "unique_id" => $productVariant["unique_id"],
                        "sku" => $productVariant["sku"],
                        "quantity" => $productVariant["quantity"],
                        "weight" => $productVariant["weight"],
                        "price" =>
                            str_replace(".", "", $productVariant["price"]) .
                            ".00",
                        "sale_price" =>
                            str_replace(
                                ".",
                                "",
                                $productVariant["sale_price"]
                            ) . ".00",
                        "status" => $productVariant["status"] || false,
                    ]);
                }
                $product->variantOptions()->sync([]);
                $product->variantOptions()->sync($variantOptions);
                $product->variantValues()->sync([]);
                $product->variantValues()->sync($variantValues);
                $product->variants()->delete();
                $product->variants()->saveMany($variants);
            } else {
                $product->variantOptions()->sync([]);
                $product->variantValues()->sync([]);
                $product->variants()->delete();
            }
            if (is_object($this->imageRight)) {
                $imageRight = $this->imageRight->store(
                    "public/store/tryons",
                    "local"
                );
                $this->image_config_json["image_right"]["image"] = str_replace(
                    "public/store/tryons/",
                    "",
                    $imageRight
                );
                unset($this->image_config_json["image_right"]["image_preview"]);
            }
            if (is_object($this->imageFront)) {
                $imageFront = $this->imageFront->store(
                    "public/store/tryons",
                    "local"
                );
                $this->image_config_json["image_front"]["image"] = str_replace(
                    "public/store/tryons/",
                    "",
                    $imageFront
                );
                unset($this->image_config_json["image_front"]["image_preview"]);
            }
            if (is_object($this->imageLeft)) {
                $imageLeft = $this->imageLeft->store(
                    "public/store/tryons",
                    "local"
                );
                $this->image_config_json["image_left"]["image"] = str_replace(
                    "public/store/tryons/",
                    "",
                    $imageLeft
                );
                unset($this->image_config_json["image_left"]["image_preview"]);
            }
            // $tryOn = new TryOn([
            //     'product_id' => $product->id,
            //     'type' => 'image',
            //     '3D_config_json' => '{}',
            //     'image_config_json' => json_encode($this->image_config_json),
            // ]);
            // $product->tryon()->save($tryOn);

            if ($product) {
                $this->emit("toast", ["success", "Product has been created"]);
                if ($redirect) {
                    return redirect()->to("/store/products");
                }
            }
        }
    }

    public function render()
    {
        return view("store::livewire.products.update", [
            "categories" => Category::get(),
            "categoriesTrees" => collect(
                Category::where("parent_id", 0)
                    ->with("children.children")
                    ->get()
            ),
            "brands" => Brand::get(),
            "storefronts" => StoreFront::get(),
        ])->extends("theme::backend.layouts.master");
    }
}
