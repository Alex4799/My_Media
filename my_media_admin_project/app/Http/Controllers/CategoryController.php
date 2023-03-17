<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //category page
    public function category(){
        $categories=Category::when(request('table_search'),function($search_product){
            $search_product->orwhere('title','like','%'.request('table_search').'%')
            ->orwhere('description','like','%'.request('table_search').'%');
        })->get();
        return view('admin.category.category',compact('categories'));
    }

    //category Create
    public function categoryCreate(Request $req){
        $this->validationCheck($req);
        $data = $this->getData($req);
        Category::create($data);
        $categories=Category::get();
        return redirect()->route('admin#category',compact('categories'))->with(['createSucc'=>'Admin Category create successful']);
    }

    //categoryDelete
    public function categoryDelete($id){
        Category::where('id',$id)->delete();
        $categories=Category::get();
        return back()->with(['deleteSucc'=>'Admin Category delete successful']);
    }

    //categoryEditPage
    public function categoryEditPage($id){
        $category=Category::where('id',$id)->first();
        return view('admin.category.categoryEdit',compact('category'));
    }

    //categoryUpdate
    public function categoryUpdate(Request $req){
        $this->validationCheck($req);
        $data = $this->getData($req);
        Category::where('id',$req->id)->update($data);
        $categories=Category::get();
        return redirect()->route('admin#category',compact('categories'))->with(['updateSucc'=>'Admin Category update successful']);
    }

    //validation Check
    private function validationCheck($req){
        Validator::make($req->all(),[
            'name'=>'required',
            'description'=>'required',
        ])->validate();
    }

    //get data
    private function getData($req){
        return [
            'title'=>$req->name,
            'description'=>$req->description,
        ];
    }
}
