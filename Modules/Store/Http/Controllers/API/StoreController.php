<?php

namespace Modules\Store\Http\Controllers\API;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Store\Entities\Product;

use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

// class FiltersSalePrice implements Filter
// {
//     public function __invoke(Builder $query, string $property)
//     {
//         $query->where("sale_price", "!=", null);
//     }
// }

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $products = QueryBuilder::for(Product::class)
            ->allowedSorts(["created_at", "price", "name"])
            ->allowedIncludes([
                "brand",
                "images",
                "categories",
                "storefronts",
                "variants",
                "variantOptions.variantValues",
            ])
            ->allowedFilters([
                AllowedFilter::exact("status"),
                AllowedFilter::exact("categories.slug"),
                AllowedFilter::exact("brand.slug"),
                AllowedFilter::exact("storefronts.slug"),
                "categories.name",
                "name",
                AllowedFilter::exact("sale_price")->ignore(!null),
            ])
            ->fastPaginate(request()->query("per_page"))
            ->appends(request()->query());

        return response()->json($products);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view("store::create");
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $product = QueryBuilder::for(Product::class)->allowedIncludes([
            "brand",
            "images",
            "categories",
            "variants",
            "variantOptions.variantValues",
        ]);

        return response()->json($product->findOrFail($id));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view("store::edit");
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
