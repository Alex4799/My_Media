<?php

namespace App\Http\Controllers\api;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    //get all Category
    public function getCategory(){
        $categories=Category::get();
        $data=[
            'category'=>$categories,
            'status'=>'success'
        ];
        return response()->json($data, 200);
    }
}
