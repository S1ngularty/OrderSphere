<?php

namespace App\Http\Controllers;

use App\Models\Items;
use Illuminate\Http\Request;
use App\DataTables\ItemDataTable;

class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ItemDataTable $datatable)
    {
        return $datatable->render('admin.items.index');
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
    public function show(Items $items)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Items $items)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Items $items)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $item=Items::find($id);
        if($item->delete()){
            return redirect()->back()->with('success','Successfully deleted the Item');
        }else{
            return redirect()->back()->with('failed','Failed to delete the Item');
        }
    }

    public function restore($id){
        // dd($id);
        $items=Items::withTrashed()->find($id);
        if(!empty($id)){
            if($items->restore()){
                return redirect()->back()->with('success','The item is successfully restored');
            }else{
                return redirect()->back()->with('failed','The item is failed to Restore');
            }
        }
    }

}
