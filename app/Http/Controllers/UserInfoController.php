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
        return $user_data_table->render("admin.users.index");
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
        $rules=[
            'email'=>'required',
            'password'=>'required|min:8',
            'confirm_password'=> 'required|same:password',
            'fname'=>'required',
            'lname'=>'required|alpha',
            'age'=>'required|numeric|min:8',
            'contacts'=>'numeric|digits:11'
        ];

        $message=[
            'email'=>'Please enter a valid Email',
            'password.required'=>'Please enter a password for you account security',
            'password.min'=>'password is too short minimum password characters is 8',
            'confirm_password.same'=>'password dont match',
            'confirm_password.required'=>'Please confirm you password',
            'lname'=>'Enter a valid Surname',
            'fname'=>'Ender a valid First Name',
            'age'=>'Must be 18 above',
            'contacts.numeric'=>'Must only contain a numbers',
            'contacts.digits'=>'contact number has only 11 numbers'
        ];

        $vaildate=Validator::make($request->all(),$rules,$message);
        if($vaildate->fails()){
            return redirect()->back()->withErrors($vaildate)->withInput();
            exit;
        }

        $password=Hash::make($request->password);
        $user=new User();
        $user->email=$request->email;
        $user->password=$request->password;
        $user->role='user';
        $user->status='active';
        $user->save();
        $last_id=$user->user_id;
        // dd($user,$last_id);
        
        $info= new User_info();
        $info->user_id=$last_id;
        $info->fname=$request->fname;
        $info->lname=$request->lname;
        $info->age=$request->age;
        $info->gender=$request->gender;
        $info->address=$request->address;
        $info->contact=$request->contacts;
        $info->save();
        // User_info::create([
        //     'user_id'=> $last_id,
        //     'fname'=>$request->fname,
        //     'lname'=>$request->lname,
        //     'age'=>$request->age,
        //     'gender'=>$request->gender,
        //     'address'=>$request->address,
        //     'contact'=>$request->contacts,
        // ]);
        $filename=null;
        if($request->hasFile('pfp')){
            $filename=$request->file('pfp')->hashName();
            if(!empty($filename)){
                $path=$request->file('pfp')->storeAs('user_images',$filename,'public');
                if(!$path){
                    return redirect()->back()->withErrors('failed to store the image');
                    exit;
                }else{
                    User_info::where('user_id',$last_id)
                    ->update([
                        'pfp'=>$filename
                    ]); 
                }
            }
        }
        return redirect()->back()->with('success');

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
        $info=User_info::where('user_id',$id)->first();
        $account=User::where('user_id',$id)->first();

        // dd($info,$account);
        return view('admin.users.edit',compact('info','account'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User_info $user_info, $id)
    {
        dd($request,$id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $del=User::find($id);
        if($del->delete($del)){
            return redirect()->back()->with('success','successfully deleted the user');
        }else{
            return redirect()->back()->with('error','failed to delete the specified user');
        }
    }
}
