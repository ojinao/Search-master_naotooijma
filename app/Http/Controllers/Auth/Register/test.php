<?php

namespace App\Http\Controllers\Auth\Register;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
Use App\Models\Users\User;


class RegisterController extends Controller
{
    //
    protected function validator(array $data)
    {
        return Validator::make($data, [

            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'max:16'],
                // 'LastName' => ['required', 'string','max:10'],
                // 'FirstName' => ['required', 'string','max:10'],
                // 'LastName_kana' =>['required', 'string','max:30'],
                // 'FirstName_kana' =>['required', 'string','max:30'],
                // 'birthday_year'=>['required','after:1979-12-31','before:15 year']
                // 'birthday_month'
                // 'birthday_day'
                // 'admission_year'=>['required','after:1999-12-31','before:today']
                // 'admission_month'
                // 'admission_day'
                //  'gender'=>['required',],
        ]);
    }

    public function register(Request $request){
        $kokugo=User::where('role','0')->get();
        $math=User::where('role','5')->get();

        return view('auth.register',compact('kokugo','math'));
    }

    public function confirmation(Request $request){

        $kokugo=User::where('role','0')->get();
        $math=User::where('role','5')->get();
      $input = $request->input();
      //validation
       $this->validator($input)->validate();
        //if fails
        if($this->validator->fails()){
            return redirect()->back()->withInput()->withErrors($this->validator);
        }
        return view('auth.confirmation',compact('kokugo','math','input'));
    }






            public function register(Request $request){
        $kokugo=User::where('role','0')->get();
        $math=User::where('role','5')->get();

        return view('auth.register',compact('kokugo','math'));
    }

	function post(Request $request){

		$input = $request->input();
		//セッションに書き込む
		$request->session()->put("form_input", $input);

		return redirect()->action("RegisterController@confirmation");
	}

{
	function confirmation(Request $request){
		//セッションから値を取り出す
		$input = $request->session()->get("form_input");

		//セッションに値が無い時はフォームに戻る

		return view("form_confirm",["input" => $input]);
	}


  }
