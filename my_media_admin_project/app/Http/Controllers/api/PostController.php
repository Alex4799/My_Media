<?php

namespace App\Http\Controllers\api;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function getPost(){
        $post=Post::get();
        $data=[
            'post'=>$post,
            'status'=>'success',
        ];
        return response()->json($data, 200);
    }

    public function search(Request $req){
        $post=Post::where('title','like','%'.$req->key.'%')->get();
        $data=[
            'post'=>$post,
            'status'=>'success',
        ];
        return response()->json($data, 200);
    }

    public function searchCategory(Request $req){
        $post=Post::where('category_id',$req->id)->get();
        $data=[
            'post'=>$post,
            'status'=>'success',
        ];
        return response()->json($data, 200);
    }

    public function postDeatail(Request $req){
        $id=$req->id;
        $post=Post::where('id',$id)->first();
        $data=[
            'post'=>$post,
            'status'=>'success',
        ];
        return response()->json($data, 200);
    }
}
