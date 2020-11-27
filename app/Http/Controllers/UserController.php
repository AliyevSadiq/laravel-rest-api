<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    public function register(Request $request){
      if($request->method()=='POST'){
         $validator=Validator::make($request->all(),User::$registerRules,User::$errorMsg);
         if($validator->fails()){
             return response()->json($validator->errors(),400);
         }
         User::create([
           'name'=>$request->input('name'),
           'email'=>$request->input('email'),
           'password'=>Hash::make($request->input('password'))
         ]);
         return response()->json('USER REGISTERED',200);
      }
    }


    public function login(Request $request){
        if($request->method()=='POST'){
            $validator=Validator::make($request->all(),User::$loginRules,User::$errorMsg);
            if($validator->fails()){
                return response()->json($validator->errors(),400);
            }
            if (!$token = auth()->attempt($request->all())) {
                return response()->json(['error' => true, 'message' => 'Incorrect Login/Password'], 401);
            }
            return response()->json(['token' => $token]);
        }
    }
    public function refresh() {
        try {
            $token = auth()->refresh();
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['error' => true, 'message' => $e->getMessage()], 401);
        }
        return response()->json(['token' => $token]);
    }
}
