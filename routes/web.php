<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserInfoController;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\testController;
use App\Http\Controllers\Auth\LoginController;
use App\Models\Items;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Auth;
use Barryvdh\Debugbar\Facades\Debugbar;
use App\Http\Controllers\apiController;
use Spatie\FlareClient\Api;

// admin side
Route::prefix('admin')->group(function(){
    Route::get('/users',[UserInfoController::class,"index"])->name("user.index");
    Route::get('users/create', function (){
        return view("admin.users.create");
    });
    Route::post('/user/store',[UserInfoController::class,'store'])->name('user.store');
    Route::get('/user/edit/{id}',[UserInfoController::class,'edit'])->name('user.edit');
    Route::post('/user/update/{id}',[UserInfoController::class,'update'])->name('user.update');
    Route::get('user/delete/{id}',[UserInfoController::class,'destroy'])->name('user.delete');
    Route::get('user/restore/{id}',[UserInfoController::class,'restore'])->name('user.restore');


    Route::resource('items',ItemsController::class)->names('items');
    Route::patch('items/restore/{id}',[ItemsController::class,'restore'])->name('items.restore');
});


Route::get('/user/status_update/{id}',[UserInfoController::class,'status_update'])->name('user.status');
Route::get('/user/role_update/{id}',[UserInfoController::class,'role_update'])->name('user.role');

Auth::routes([
    'login'=>false
]);

Route::post('/signup',[LoginController::class,'signUp'])->name('signup');
Route::get('/login',function (){
    return view('auth.login');
})->name('login');
Route::get('/lg',function (){
Auth::logout();
});


Route::resource('test',testController::class);
Route::view("ajax/users","user.test");


