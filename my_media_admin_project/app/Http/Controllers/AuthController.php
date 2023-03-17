<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $req){
        $user=User::where('email',$req->email)->first();

        if (isset($user)) {
            if(Hash::check($req->password, $user->password)){
                $data=[
                    'user'=>$user,
                    'token'=>$user->createToken(time())->plainTextToken,
                ];
                return response()->json($data, 200);
            }else {
                $data=[
                    'user'=>null,
                    'token'=>null,
                ];
                return response()->json($data, 200);
            }

        }else{
            $data=[
                'user'=>null,
                'token'=>null,
            ];
            return response()->json($req, 200);
        }
    }

    public function register(Request $req){
        $data=[
            'name'=>$req->name,
            'email'=>$req->email,
            'phone'=>$req->phone,
            'address'=>$req->address,
            'gender'=>$req->gender,
            'password'=>Hash::make($req->password),
        ];
        User::create($data);
        $user=User::where('email',$req->email)->first();
        $userdata=[
            'user'=>$user,
            'token'=>$user->createToken(time())->plainTextToken
        ];
        return response()->json($userdata, 200);
    }

    public function gerCategory(){
        $category=Category::get();
        return response()->json($category, 200);
    }

}
