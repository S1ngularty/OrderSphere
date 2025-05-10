<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Items;

class apiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $item=Items::whereHas("category", function($query){
           $query->where("item_id","=",11); 
        })->get();
         return response()->json($item);
         dump($item);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
