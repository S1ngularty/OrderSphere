<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Authcontroller extends Controller
{

    public function login(Request $request){
        $validate=Validator::make($request->all(),[
            'email'=>'email|required',
            'password'=>'required'
        ]);

        if($validate->fails()){
            return response()->json(array('data'=>$request->all(),'errors'=>$validate->errors(),'status'=>'422'));
        }

        if(! $token=auth('api')->attempt($validate->validated())){
            return response()->json(['error'=>'unauthorized','status'=>401]);
        }

        return response()->json(array("token"=>$token));
    }

}
