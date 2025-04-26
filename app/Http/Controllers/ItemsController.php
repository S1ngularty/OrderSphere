<?php

namespace App\Http\Controllers;

use App\Models\Items;
use App\Models\Category;
use App\Models\Stocks;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\DataTables\ItemDataTable;
use App\Models\item_category;

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
        $collection=Category::all();
        return view('admin.items.create',compact('collection'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            // dd($request->all());
        $rules=[
            'item_name'=>'required',
            'qty'=>'required|min:1',
            'category'=>'required',
            'item_desc'=>'required',

        ];

        $messages=[
            'item_name'=>'Please enter the item name',
            'qty'=>'Please enter the item stocks',
            'category'=>'Please enter the item category',
            'item_desc'=>'Please enter the item description',
        ];

        $validate=Validator::make($request->all(),$rules,$messages);

        if($validate->fails()){
            return redirect()->back()->withErrors($validate)->withInput();
        }else{
            $item= new Items();
            $item->item_name=$request->item_name;
            $item->item_price=$request->item_price;
            $item->description=$request->item_desc;
            if($item->save() && $last_id=$item->item_id){
                $stock= new Stocks();
                $stock->item_id=$last_id;
                $stock->qty=$request->qty;

                $ic=new item_category();
                $ic->item_id=$last_id;
                $ic->category_id=$request->category;

                if($stock->save() && $ic->save()){
                    if($request->hasFile('file')){
                        foreach($request->file('file') as $files){
                            $filename=$files->hashName();
                            if(!empty($filename)){
                                $path=$files->storeAs('item_images',$filename,'public');
                                if($path){
                                    DB::table('item_gallery')->insert([
                                        'item_id'=> $last_id,
                                        'img'=>$filename,
                                    ]);
                                }else{
                                    return redirect()->back()->with('failed','failed to store the images');
                                }
                            }
                        }
                    }
                }
            }
        }
        return redirect()->back()->with('success','New item has been added successfully');
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
