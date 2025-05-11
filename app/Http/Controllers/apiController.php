<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Items;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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


        // $password=Hash::make($request->password);
        // $user=new User();
        // $user->email=$request->email;
        // $user->password=$password;
        // $user->role=$request->role;
        // $user->status=$request->status;
        // $user->save();

        $user=User::create($request->all());

        return response()->json(["user is store successfully!",
        "status"=>200,"data"=>$request->all()]);
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
