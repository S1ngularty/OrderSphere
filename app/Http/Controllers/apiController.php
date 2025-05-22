<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Items;
use App\Models\User;
use GuzzleHttp\Psr7\Message;
use Illuminate\Support\Facades\Hash;

class apiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $item=User::with('user_info')->get();
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
        // $user=User::find($id);
        // $user->update($request->all());
        dump($request->input());
      return response()->json(['ID'=>$id,'status'=>200,
      'message'=> " the user is updated succesfully!",
      'data'=>$request->all()]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(user::forceDestroy($id)){
            return response()->json(['status'=>200,
            'message'=>'user is successfully deleted']);
        }
        
    }
}
