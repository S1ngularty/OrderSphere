<?php

namespace App\Http\Controllers;
use App\Models\Items;
use App\Models\Category;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Http\Request;

class testController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $item=Items::withWhereHas('category')->get();
        return response()->json($item);

       
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
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
