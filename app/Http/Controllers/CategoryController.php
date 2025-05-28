<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }

      public function chart(){
      $data=Category::withCount('items')->get();

    //   return response()->json($data);
        $chartLabel = [];
        $chartData =[];
      foreach($data as $datas){
        $chartLabel[]=$datas->category_name;
        $chartData[]=$datas->items_count;
      }
    //   dd($chartData);
        return response()->json(array('data'=>$chartData,'label'=>$chartLabel));
    }
}
