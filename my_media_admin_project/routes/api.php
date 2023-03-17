<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\api\PostController;
use App\Http\Controllers\ActionLogController;
use App\Http\Controllers\api\CategoryController;


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/user/login',[AuthController::class,'login']);
Route::post('/user/register',[AuthController::class,'register']);

Route::get('/category/get',[CategoryController::class,'getCategory']);

Route::get('/post/get',[PostController::class,'getPost']);
Route::post('post/search',[PostController::class,'search']);
Route::post('post/search/category',[PostController::class,'searchCategory']);
Route::post('post/detail',[PostController::class,'postDeatail']);

Route::post('actionLog/post/viewCount',[ActionLogController::class,'viewCount']);
