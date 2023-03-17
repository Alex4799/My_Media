<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ActionLogController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    // admin
    //account

    Route::get('/dashboard',[AdminController::class,'profile'])->name('admin#profile');
    Route::post('/updateProfile',[AdminController::class,'updateProfile'])->name('admin#updateProfile');

    //change Password
    Route::get('admin/changePasswordPage',[AdminController::class,'changePasswordPage'])->name('admin#changePasswordPage');
    Route::post('admin/changePassword',[AdminController::class,'changePassword'])->name('admin#changePassword');

    //admin list
    Route::get('/admin/list',[AdminController::class,'list'])->name('admin#list');
    Route::get('/admin/list/delete/{id}',[AdminController::class,'listDelete'])->name('admin#listDelete');

    //category
    Route::get('/category',[CategoryController::class,'category'])->name('admin#category');
    Route::post('/category/create',[CategoryController::class,'categoryCreate'])->name('admin#categoryCreate');
    Route::get('/category/delete/{id}',[CategoryController::class,'categoryDelete'])->name('admin#categoryDelete');
    Route::get('/category/editPage/{id}',[CategoryController::class,'categoryEditPage'])->name('admin#categoryEditPage');
    Route::post('/category/update',[CategoryController::class,'categoryUpdate'])->name('admin#categoryUpdate');

    // post
    Route::get('/post',[PostController::class,'post'])->name('admin#post');
    Route::post('/post/create',[PostController::class,'postCreate'])->name('admin#postCreate');
    Route::get('/post/delete/{id}',[PostController::class,'postDelete'])->name('admin#postDelete');
    Route::get('/post/edit/{id}',[PostController::class,'postEditPage'])->name('admin#postEditPage');
    Route::post('/post/update',[PostController::class,'postUpdate'])->name('admin#postUpdate');

    //trendPost
    Route::get('/trendPost',[ActionLogController::class,'trendPost'])->name('admin#trendPost');
    Route::get('/trendPost/detail/{id}',[ActionLogController::class,'detail'])->name('admin#trendPostDetail');

});
