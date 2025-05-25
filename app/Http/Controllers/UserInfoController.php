<?php

namespace App\Http\Controllers;

use App\Models\User_info;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\support\Facades\Validator;
use App\DataTables\UserDataTable;
use Illuminate\Support\Facades\Hash;

class UserInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(UserDataTable $user_data_table)
    {
        // return $user_data_table->render("admin.users.index");
        $info=User::withoutTrashed()->get();
        return response()->json($info);
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

        $user= User::create($request->all());
        if($user){
            return response()->json(["envelope"=>["user"=>$request->all(),"status"=>200]]);
        }

        // $rules=[
        //     'email'=>'required',
        //     'password'=>'required|min:8',
        //     'confirm_password'=> 'required|same:password',
        //     'fname'=>'required',
        //     'lname'=>'required|alpha',
        //     'age'=>'required|numeric|min:8',
        //     'contacts'=>'numeric|digits:11'
        // ];

        // $message=[
        //     'email'=>'Please enter a valid Email',
        //     'password.required'=>'Please enter a password for you account security',
        //     'password.min'=>'password is too short minimum password characters is 8',
        //     'confirm_password.same'=>'password dont match',
        //     'confirm_password.required'=>'Please confirm you password',
        //     'lname'=>'Enter a valid Surname',
        //     'fname'=>'Ender a valid First Name',
        //     'age'=>'Must be 18 above',
        //     'contacts.numeric'=>'Must only contain a numbers',
        //     'contacts.digits'=>'contact number has only 11 numbers'
        // ];

        // $vaildate=Validator::make($request->all(),$rules,$message);
        // if($vaildate->fails()){
        //     return redirect()->back()->withErrors($vaildate)->withInput();
        //     exit;
        // }

        // $password=Hash::make($request->password);
        // $user=new User();
        // $user->email=$request->email;
        // $user->password=$request->password;
        // $user->role='user';
        // $user->status='active';
        // $user->save();
        // $last_id=$user->user_id;
        // // dd($user,$last_id);
        
        // $info= new User_info();
        // $info->user_id=$last_id;
        // $info->fname=$request->fname;
        // $info->lname=$request->lname;
        // $info->age=$request->age;
        // $info->gender=$request->gender;
        // $info->address=$request->address;
        // $info->contact=$request->contacts;
        // $info->save();
        // // User_info::create([
        // //     'user_id'=> $last_id,
        // //     'fname'=>$request->fname,
        // //     'lname'=>$request->lname,
        // //     'age'=>$request->age,
        // //     'gender'=>$request->gender,
        // //     'address'=>$request->address,
        // //     'contact'=>$request->contacts,
        // // ]);
        // $filename=null;
        // if($request->hasFile('pfp')){
        //     $filename=$request->file('pfp')->hashName();
        //     if(!empty($filename)){
        //         $path=$request->file('pfp')->storeAs('user_images',$filename,'public');
        //         if(!$path){
        //             return redirect()->back()->withErrors('failed to store the image');
        //             exit;
        //         }else{
        //             User_info::where('user_id',$last_id)
        //             ->update([
        //                 'pfp'=>$filename
        //             ]); 
        //         }
        //     }
        // }
        // return redirect()->back()->with('success');

    }

    /**
     * Display the specified resource.
     */
    public function show(User_info $user_info)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User_info $user_info,$id)
    {
        // $info=User_info::where('user_id',$id)->first();
        $account=User::where('user_id',$id)->first();
        return response()->json($account);

        // dd($info,$account);
        // return view('admin.users.edit',compact('info','account'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User_info $user_info, $id)
    {
        $user=User::find($id);
        $user->update($request->all());
        if($user){
            return response()->json($user);
        }
        // dd($request,$id);
        // $rules=[
        //     'email'=>'required',
        //     'fname'=>'required',
        //     'lname'=>'required|alpha',
        //     'age'=>'required|numeric|min:8',
        //     'contacts'=>'numeric|digits:11'
        // ];

        // $message=[
        //     'email'=>'Please enter a valid Email',
        //     'lname'=>'Enter a valid Surname',
        //     'fname'=>'Ender a valid First Name',
        //     'age'=>'Must be 18 above',
        //     'contacts.numeric'=>'Must only contain a numbers',
        //     'contacts.digits'=>'contact number has only 11 numbers'
        // ];

        // $vaildate=Validator::make($request->all(),$rules,$message);
        // if($vaildate->fails()){
        //     return redirect()->back()->withErrors($vaildate)->withInput();
        //     exit;
        // }

        // DB::table('users')->where('user_id',$id)
        // ->update([
        //     'email'=>$request->email,
        //     'role'=>$request->role,
        //     'status'=>$request->status,

        // ]);

        // DB::table('user_info')->where('user_id',$id)
        // ->update([
        //     'fname'=>$request->fname,
        //     'lname'=>$request->lname,
        //     'age'=>$request->age,
        //     'gender'=>$request->gender,
        //     'contact'=>$request->contacts,
        //     'address'=>$request->address,
        // ]);

        // if($request->hasFile('pfp')){
        //     $filename=$request->file('pfp')->hashName();
        //     $path=$request->file('pfp')->storeAs('user_images/',$filename,'public');
        //     if($path){
        //         $find=public_path('storage/user_images/'.$request->current_pfp);
        //         if(file_exists($find) && !empty($request->current_pfp)){
        //             // dd($find);
        //             if(unlink($find)){
        //                 DB::table('user_info')->where('user_id',$id)
        //                 ->update([
        //                     'pfp'=>$filename
        //                 ]);
        //             }else{
        //                 return redirect()->back()->with('error','failed to delete your current pfp');
        //             }
        //         }else{
        //             DB::table('user_info')->where('user_id',$id)
        //             ->update([
        //                 'pfp'=>$filename
        //             ]);
        //         }
        //     }
        // }

        // return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $del=User::find($id);
        if($del->forceDelete($del)){
           return response()->json("the user is deleted");
        }else{
            return redirect()->back()->with('error','failed to delete the specified user');
        }
    }

    public function restore($id){
        $user=User::withTrashed()->find($id);
        if(!empty($user)){
            if($user->restore()){
                return redirect()->back()->with('success','user has been restored successfully!');
            }else{
                return redirect()->back()->with('failed','Failed to restore the user');
            }
        }else{
            return redirect()->back()->with('not_found','user is not found in the database');
        }
    }

    public function role_update($id,Request $request){
        $user=User::find($id);
        if(!empty($user)){
            $user->role=$request->role;
            if($user->save()){
                return redirect()->back()->with('success','User role is successfully updated');
            }else{
                return redirect()->back()->with('failed','Failed to update the users Role');
            }
        }
    }

    public function status_update($id, Request $request){
        $user=User::find($id);
        if(!empty($user)){
            $user->status=$request->status;
            if($user->save()){
                return redirect()->back()->with('success','Successfully updated the user status');
            }else{
                return redirect()->back()->with('failed','Failed to update the user status. Please try again');
            }
        }
    }
}
