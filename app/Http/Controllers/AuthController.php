<?php

namespace App\Http\Controllers;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function signup(Request $request){
        $this->validate($request,[
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);

       return User::create([
            'username' => $request->json('username'),
            'email' => $request->json('email'),
            'password' => bcrypt($request->json('password'))
        ]);
    }
    public function test(){
        return "test";
    }

    public function signin(Request $request){
        $this->validate($request,[
            'username' => 'required',
            'password' => 'required'
        ]);

        $credentials=$request->only("username","password");

        try{
            if(!$token=JWTAuth::attempt($credentials)){
                return response()->json(["error" => "invalid_credentials"], 401);
            }
        }catch(JWTException $e){
            return response()->json(["error" => "could_not_create_token"], 500);
        }
        return response()->json(["user_id" => $request->user()->id,
                                  "username" => $request->user()->username, 
                                  "token" => $token
                                ]);
    }
}
