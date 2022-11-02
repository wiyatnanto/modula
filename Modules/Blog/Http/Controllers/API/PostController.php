<?php

namespace Modules\Blog\Http\Controllers\API;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Blog\Entities\Post;
use Modules\Blog\Transformers\PostResource;

use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $posts = QueryBuilder::for(Post::class)
            ->allowedSorts("created_at")
            ->allowedIncludes(["category", "tags", "user"])
            ->allowedFilters([
                AllowedFilter::exact("lang"),
                "id",
                AllowedFilter::exact("category.slug"),
            ]);

        return response()->json(
            $posts->fastPaginate(request()->query("per_page"))
        );
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view("blog::create");
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
        $post = QueryBuilder::for(Post::class)->allowedIncludes([
            "category",
            "tags",
            "user",
        ]);

        return response()->json($post->where("slug", $slug)->firstOrFail());
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view("blog::edit");
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
