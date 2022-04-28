<?php

namespace App\Http\Controllers\Auth\Login;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    //
    public function login(Request $request){

    if($request->isMethod('post')){

    $data=$request->only('email','password');
     $validatedData = $request->validate([
        'email' =>'exists:users,email|',
         ]);
            // ログインが成功したら、トップページへ
        if(Auth::attempt($data)){
                return redirect('/top');
        }
    }
        return view("auth.login");
    }

}
