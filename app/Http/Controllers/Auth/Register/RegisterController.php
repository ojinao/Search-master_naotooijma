<?php

namespace App\Http\Controllers\Auth\Register;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
Use App\Models\Users\User;
use Illuminate\Support\Facades\Validator;
use App\Models\Users\UserPersonCharge;
use DB;

class RegisterController extends Controller
{

        public function register(){
        $kokugo=User::where('role','0')->get();
        $math=User::where('role','5')->get();

        return view('auth.register',compact('kokugo','math'));
    }

    public function confirmation(Request $request){

        // $input = $request->all();
        $kokugo=User::where('role','0')->get();
        $math=User::where('role','5')->get();

        $request->session()->put('form_input',$request->input());

        // dd($$request->session());
      //validation
               $validator = Validator::make($request->all(), [
                   'LastName' => ['required', 'string','max:10'],
                   'FirstName' => ['required', 'string','max:10'],
                   'LastName_kana' =>['required', 'string','max:30'],
                   'FirstName_kana' =>['required', 'string','max:30'],
                    'birthday_year'=>['required','after:1979-12-31','before:15 year'],
                    'birthday_month',
                    'birthday_day',
                    'admission_year'=>['required','after:1999-12-31','before:today'],
                    'admission_month',
                    'admission_day',
                   'gender'=>'required|in:0,1|',
                //    'email' => 'required|max:255',
                   'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                   'password' => ['required', 'string', 'min:8', 'max:16','confirmed'],
                   'role' => ['required']
                ]);

        //if fails
        // if($validator->fails()){
        //     return redirect()->back()->withErrors($validator)->withInput();
        // }
         $input =$request->session()->get('form_input',array());

        // dd($input);

        return view('auth.confirmation',compact('kokugo','math','input'));
    }

    public function storage(Request $request){
        // dd($username);
        $data = $request->input();
        $LastName = $request->input('LastName');
        $FirstName = $request->input('FirstName');
        $username = $FirstName.$LastName;
        $LastName_kana = $request->input('LastName_kana');
        $FirstName_kana = $request->input('FirstName_kana');
        $username_kana = $LastName_kana.$FirstName_kana;
        $birthday_year = $request->input('birthday_year');
        $birthday_month = $request->input('birthday_month');
        $birthday_day = $request->input('birthday_day');
        $birthday = $birthday_year.$birthday_month.$birthday_day;
        $admission_year = $request->input('admission_year');
        $admission_month = $request->input('admission_month');
        $admission_day = $request->input('admission_day');
        $admission_date = $admission_year.$admission_month.$admission_day;
            if($request->isMethod('post')){
                $user=user::create([
                 'username' => $username,
                 'username_kana' => $username_kana,
                 'birthday' => new Carbon($birthday),
                 'admission_date' => new Carbon($admission_date),
                 'gender' => $data['gender'],
                 'email' => $data['email'],
                 'password' => bcrypt($data['password']),
                 'role' => $data['role']
                ]);
    //  dd($user);
                UserPersonCharge::create([
                    'user_id' => $user->id,
                    'japanese_language_user_id' =>$data['kokugo_t'],
                    'math_teacher_user_id' =>$data['math_t']
                ]);
            }
             return redirect('add');

        }

        public function added(User $user){
        return view('auth.add');
    }
}

                                                //     protected function validator(array $data)
                                                //     {
                                                //         return Validator::make($data, [

                                                //             'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                                                //             'password' => ['required', 'string', 'min:8', 'max:16'],
                                                //                 // 'LastName' => ['required', 'string','max:10'],
                                                //                 // 'FirstName' => ['required', 'string','max:10'],
                                                //                 // 'LastName_kana' =>['required', 'string','max:30'],
                                                //                 // 'FirstName_kana' =>['required', 'string','max:30'],
                                                //                 // 'birthday_year'=>['required','after:1979-12-31','before:15 year']
                                                //                 // 'birthday_month'
                                                //                 // 'birthday_day'
                                                //                 // 'admission_year'=>['required','after:1999-12-31','before:today']
                                                //                 // 'admission_month'
                                                //                 // 'admission_day'
                                                //                 //  'gender'=>['required',],
                                                //         ]);
                                                //     }


                                                //     public function register(Request $request){
                                                //         $kokugo=User::where('role','0')->get();
                                                //         $math=User::where('role','5')->get();
                                                //         if($request->isMethod('post')){
                                                //             //  inputした物をセッションに保存する
                                                //             // $data = $request->input();
                                                //             // $request->session()->put('form_input',$data);
                                                //             // dd($data);

                                                //             return redirect()->route('confirmation');
                                                //         }
                                                //         return view('auth.register',compact('kokugo','math'));
                                                //     }







                                                //     public function confirmation(Request $request){

                                                //                 $kokugo=User::where('role','0')->get();
                                                //                 $math=User::where('role','5')->get();
                                                //                             $data = $request->input();
                                                //                             $request->session()->push('form_input',$data);
                                                //                             // dd($request);
                                                //                             // セッションで受け取る
                                                //                             $input = $request->session()->get('form_input',array());
                                                //                             // $input = $request->session()->get('users',array());
                                                //                             // $input = $request->session()->all();
                                                //                             // dd($input);

                                                // // echo('<pre>');
                                                // // var_dump($input);
                                                // // echo('</pre>');
                                                // // dd($data);
                                                                // if($request->isMethod('post')){
                                                                // $data = $request->input();
                                                                // $LastName = $request->input('LastName');
                                                                // $FirstName = $request->input('FirstName');
                                                                // $username = $FirstName.$LastName;
                                                                // $LastName_kana = $request->input('LastName_kana');
                                                                // $FirstName_kana = $request->input('FirstName_kana');
                                                                // $username_kana = $LastName_kana.$FirstName_kana;
                                                                // $birthday_year = $request->input('birthday_year');
                                                                // $birthday_month = $request->input('birthday_month');
                                                                // $birthday_day = $request->input('birthday_day');
                                                                // $birthday = $birthday_year.'-'.$birthday_month.'-'.$birthday_day;
                                                                // $admission_year = $request->input('admission_year');
                                                                // $admission_month = $request->input('admission_month');
                                                                // $admission_day = $request->input('admission_day');
                                                                // $admission_date = $admission_year.'-'.$admission_month.'-'.$admission_day;
                                                //   //  dd($input);
                                                //                 User::create([
                                                //                     'username' => $username,
                                                //                     'username_kana' => $username_kana,
                                                //                     'birthday' => new Carbon($birthday),
                                                //                     'admission_date' => new Carbon($admission_date),
                                                //                     'gender' => $data['gender'],
                                                //                     'email' => $data['email'],
                                                //                     'password' => bcrypt($data['password']),
                                                //                     'role' => $data['role']
                                                //                 ]);

                                                //  dd($user);
                                                //                 UserPersonCharge::create([
                                                //                     'user_id' => $request->id,
                                                //                     'japanese_language_user_id' =>$data['kokugo_t'],
                                                //                     'math_teacher_user_id' =>$data['math_t']
                                                //                 ]);

                                                //                 return view('auth.confirmation',compact('kokugo','math','input'));
                                                //     }
                                                //     }



// }
