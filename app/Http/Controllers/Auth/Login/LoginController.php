<?php

namespace App\Http\Controllers\Auth\Login;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
        public function __construct(){
        $this->middleware('guest')->except('logout');
    }

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
        return view('auth.login');
    }
        public function logout(){
      Auth::logout();
    return redirect('/login');
    }

}
