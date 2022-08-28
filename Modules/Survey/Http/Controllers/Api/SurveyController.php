<?php

namespace Modules\Survey\Http\Controllers\Api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use DB;

class SurveyController extends Controller
{
    public function index(Request $request)
    {
        return "request `{$request->getUri()}` dengan method `{$request->getMethod()}`";
    }

    public function store(Request $request)
    {
        return "request `{$request->getUri()}` dengan method `{$request->getMethod()}`, content: `{$request->getContent()}`";
    }

    public function show(Request $request, string $id) 
    {
        return "request `{$request->getUri()}` dengan method `{$request->getMethod()}`, parameter ID ({$id})";   
    }

    public function update(Request $request, string $id)
    {
        return "request `{$request->getUri()}` dengan method `{$request->getMethod()}`, parameter ID ({$id}) dan dengan content `{$request->getContent()}`";
    }

    public function destroy(Request $request, string $id)
    {
        return "request `{$request->getUri()}` dengan method `{$request->getMethod()}`, parameter ID ({$id})";
    }

    /**
     * return choicesByUrl options.
     * @return Renderable
     */
    public function getOptions(Request $request)
    {
        $datas = DB::table("users")->get();
        // return response()->json(collect($datas)->map(function ($item, $key) {
        //     return ['value' => $item->id, 'text' => $item->name];
        // }));
        return response()->json(
            [ 
                "results" => collect($datas)->map(function ($item, $key) {
                    return ['id' => $item->id, 'text' => $item->name];
                })
            ]
        );
    }
}
