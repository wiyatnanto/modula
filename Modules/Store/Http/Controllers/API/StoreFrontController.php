<?php

namespace Modules\Store\Http\Controllers\API;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Store\Entities\StoreFront;

use Modules\Store\Transformers\StoreFrontResource;

use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class StoreFrontController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $storeFronts = QueryBuilder::for(StoreFront::class)
        ->allowedFilters([AllowedFilter::exact('slug'), 'name', 'status'])
        ->allowedSorts('created_at','name')
        ->allowedIncludes(['products.brand','products.images'])
        ->fastPaginate(10)
        ->appends(request()->query());

        return response()->json($storeFronts);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('store::create');
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
    public function show($slug)
    {
        $storeFront = QueryBuilder::for(StoreFront::class)
        ->allowedIncludes(['products.brand','products.images','productsWithLimit']);
        return response()->json($storeFront->where('slug', $slug)->firstOrFail());
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('store::edit');
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
