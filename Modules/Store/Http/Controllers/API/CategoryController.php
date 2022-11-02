<?php

namespace Modules\Store\Http\Controllers\API;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Store\Entities\Category;

use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedInclude;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $categories = QueryBuilder::for(Category::class)
            ->allowedFilters([
                AllowedFilter::exact("slug"),
                "name",
                AllowedFilter::exact("status"),
                AllowedFilter::exact("parent_id"),
            ])
            ->allowedSorts("created_at", "order_menu")
            ->allowedIncludes(["children", "products", "lastProduct.images"]);
        return response()->json(
            $categories->fastPaginate(request()->query("per_page"))
        );
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
        $category = QueryBuilder::for(Category::class)->allowedIncludes([
            "products.brand",
            "products.images",
        ]);
        return response()->json($category->where("slug", $slug)->firstOrFail());
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
