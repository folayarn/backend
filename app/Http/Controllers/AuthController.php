<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\User;

class AuthController extends Controller
{
    public function signup( Request $request){
$this->validate($request,[
"name"=>"required|string",
"email"=>"email|required|unique:users",
"password"=>"required|confirmed"
]);
 $user =new User([
"name"=>$request->name,
"email"=>$request->email,
"password"=>bcrypt($request->password)
 ]);
 $user->save();
$token=$user->createToken('token')->accessToken;

 return response()->json(['message'=>'saved succefully', 'token'=>$token]);
    }

public function Login(Request $request){

$credential= $request->validate([
"email"=>"required|string|email",
"password"=>"required"
]);

if(auth()->attempt($credential)){
    $user=auth()->user()->createToken('token')->accessToken;
    return response()->json([
    "token"=>$user
    ]);
}else{
return response()->json(['message'=>'unauthorised'],401);

}

}

public function signUpWithFacebook(Request $request){
    $this->validate($request,[
        "name"=>"required|string",
        "email"=>"email|required|unique:users",
        "picture"=>"required|string",
        "facebook_id"=>"required|string",
        "token"=>"required"
        ]);
         $user =new User([
        "name"=>$request->name,
        "email"=>$request->email,
        "picture"=>$request->picture,
        "provider_id"=>$request->facebook_id,
        "token"=>$request->token,
         ]);
         $user->save();
         $token=$user->createToken('token')->accessToken;
         return response()->json(['token'=>$token ,'user'=>$user]);
            }

            public function faceLogin(Request $request){

                 $request->validate([
                "email"=>"required|string|email",

                ]);

                $user=User::where('email',$request->email)->get()->first();

                if($user){
                    $token=$user->createToken('token')->accessToken;
                    return response()->json([ 'user'=>$user,
                    "token"=>$token
                    ]);
                }else{
                return response()->json(['message'=>'unauthorised'],401);

                }

                }



}
