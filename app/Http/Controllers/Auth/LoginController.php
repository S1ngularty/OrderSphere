<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    public function signUp(Request $request){
        $rules=[
            'email'=>'required|email',
            'password'=>'required|min:8'
        ];

        $messages=[
            'email.required'=>'Please enter your email address',
            'email.email'=>'Please enter a valid email address format',
            'password'=>'Please enter your password',
        ];

        $validator=Validator::make($request->all(),$rules,$messages);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
            exit;
        }
        // dd($request);
        if(Auth::attempt(array('email'=>$request->email,'password'=>$request->password))){
            if(Auth::user()->status==='active' && Auth::user()->role=='admin'){
                return redirect()->route('user.index');
            }elseif(Auth::user()->status==='active' && Auth::user()->role=='user'){
                //still in progess
            }else{
                Auth::logout();
                return redirect()->back()->with('warning','Your account is deactivated');
            }
        }else{
            return redirect()->back()->with('error','Wrong credentials');
            dd($request);
        };
    }


    
    
}
