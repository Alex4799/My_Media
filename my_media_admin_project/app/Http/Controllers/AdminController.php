<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{



    //admin profile page
    public function profile(){
        $data=User::select('id','name','email','phone','address','gender')->where('id',Auth::user()->id)->first();
        return view('admin.profile.profile',compact('data'));
    }

    //update Profile
    public function updateProfile(Request $req){
        $this->validationCheck($req);
        $data=$this->getData($req);
        User::where('id',Auth::user()->id)->update($data);
        return back()->with(['profileUpdate'=>'Update Profile Successful']);
    }

    //change Passwword page
    public function changePasswordPage(){
        return view('admin.profile.changePassword');
    }

    //change password
    public function changePassword(Request $req){
        // dd($req->toArray());
        $dbPassword=User::where('id',Auth::user()->id)->first()->password;
        $this->passwordValidationCheck($req);
        if(Hash::check($req->oldPassword, $dbPassword)){
            $hashPassword=Hash::make($req->newPassword);
            User::where('id',Auth::user()->id)->update(['password'=>$hashPassword]);
            return redirect()->route('admin#profile');
        }else{
            return back()->with(['passWorng'=>'Old password do not match']);
        }
    }

    // public function list(){
    //     $products=Product::select('products.*','categories.name as category_name')
    //     ->leftjoin('categories','products.category_id','categories.id')
    //     ->when(request('search_key'),function($search_product){
    //         $search_product->where('products.name','like','%'.request('search_key').'%');})
    //     ->orderBy('products.created_at','desc')->paginate(3);
    //     $products->append(request()->all());
    //     return view('admin.products.productList',compact('products'));
    // }

    //admin list
    public function list(){
        $userData=User::when(request('search_key'),function($search_product){
            $search_product->orWhere('name','like','%'.request('search_key').'%')
            ->orWhere('email','like','%'.request('search_key').'%')
            ->orWhere('phone','like','%'.request('search_key').'%')
            ->orWhere('address','like','%'.request('search_key').'%')
            ->orWhere('gender','like','%'.request('search_key').'%');
        })->get();
        return view('admin.list.adminList',compact('userData'));
    }

    // admin list delete
    public function listDelete($id){
        User::where('id',$id)->delete();
        return back()->with(['deleSuccess'=>'Admin account delete successful']);
    }


    //change data
    private function getData($req){
        return [
            'name'=>$req->name,
            'email'=>$req->email,
            'phone'=>$req->phone,
            'address'=>$req->address,
            'gender'=>$req->gender
        ];
    }

    //profile validation check
    private function validationCheck($req){
        return Validator::make($req->all(),[
            'name'=>'required',
            'email'=>'required',
        ])->validate();
    }

    //profile passwordValidationCheck
    private function passwordValidationCheck($req){
        return Validator::make($req->all(),[
            'oldPassword'=>'required',
            'newPassword'=>'required|min:6|max:18',
            'comfirmPassword'=>'required|same:newPassword',
        ])->validate();
    }

}
