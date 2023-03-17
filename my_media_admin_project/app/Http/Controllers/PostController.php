<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    //post page
    public function post(){
        $categories=Category::get();
        $posts=Post::when(request('search_key'),function($search_product){
            $search_product->orwhere('title','like','%'.request('search_key').'%')
            ->orwhere('description','like','%'.request('search_key').'%');
        })
        ->get();
        return view('admin.post.post',compact('categories','posts'));
    }

    //post Create
    public function postCreate(Request $req){
        // dd($req->toArray());
        $this->validationCheck($req);
        $data=$this->getData($req);
        if (!empty($req->file('image'))) {
            $file=$req->file('image');
            $imgName=uniqid().'_'.$file->getClientOriginalName();
            $file->move(public_path().'/postImage',$imgName);
            $data['image']=$imgName;
        }
        // dd($data);
        Post::create($data);
        return back();

    }

    //postDelete
    public function postDelete($id){
        $dbImage=Post::where('id',$id)->first()->image;
        if(File::exists(public_path().'/postImage'.$dbImage)){
            File::delete(public_path().'/postImage'.$dbImage);
        }
        Post::where('id',$id)->delete();

        return back()->with(['deleteSuc'=>'Post delete successful']);
    }

    //postEditPage
    public function postEditPage($id){
        $post=Post::where('id',$id)->first();
        $category=Category::get();
        return view('admin.post.postEdit',compact('post','category'));
    }

    public function postUpdate(Request $req){
        $this->validationCheck($req);
        $data=$this->getData($req);
        if(isset($req->image)){

            $dbImage=Post::where('id',$req->id)->first()->image;

            $image=$req->file('image');

            $imgName=uniqid().'_'.$image->getClientOriginalName();
            // dd($image);
            $image->move(public_path().'/postImage',$imgName);

            File::delete(public_path().'/postImage'.$dbImage);
            $data['image']=$imgName;
        }

        Post::where('id',$req->id)->update($data);
        return redirect()->route('admin#post')->with(['updateSucc'=>'Post Update Successful']);


    }


    // validationCheck
    private function validationCheck($req){
        Validator::make($req->all(),[
            'name'=>'required',
            'description'=>'required',
            'category'=>'required'
        ])->validate();
    }

    //change array form
    private function getData($req){
        return [
            'title'=>$req->name,
            'description'=>$req->description,
            'category_id'=>$req->category,
        ];
    }

}
