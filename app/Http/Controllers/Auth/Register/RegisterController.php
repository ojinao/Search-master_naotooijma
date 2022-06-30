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
use App\Models\Users\UserScore;
use DB;
use App\Http\Requests\UserRequest;


class RegisterController extends Controller
{


        public function register(){
        $kokugo=User::where('role','0')->get();
        $math=User::where('role','5')->get();

        return view('auth.register',compact('kokugo','math'));
        }

    public function confirmation(UserRequest $request){

        $kokugo=User::where('role','0')->get();
        $math=User::where('role','5')->get();
        $request->session()->put('form_input',$request->input());

      //validationはphp artisan make:request UserRequestで作成 appのhttpのRequests
         $input =$request->session()->get('form_input',array());
 // dd($input);
        return view('auth.confirmation',compact('kokugo','math','input'));
    }

    public function storage(Request $request){
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

                UserPersonCharge::create([
                    'user_id' => $user->id,
                    'japanese_language_user_id' => $data['kokugo_t'],
                    'math_teacher_user_id' => $data['math_t']
                ]);
                // UserScore::create([
                //     'user_id' => $user->id,
                // ]);

            }
        return redirect('add');
        }


        public function added(User $user){
            return view('auth.add');
        }
}
