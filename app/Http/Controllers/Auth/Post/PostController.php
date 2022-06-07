<?php

namespace App\Http\Controllers\Auth\Post;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; // ←追加
Use App\Models\Users\User;
Use App\Models\Users\UserScore;
use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;



class PostController extends Controller
{
    //
    public function index(Request $request){
        // $a=Auth::user()->role;
         if(!(Auth::user()->role == 0 or Auth::user()->role == 5)){
              Auth::logout();
             return redirect('/login')->with('error', '権限が違います。');
         };

        $user=User::with(['UserPersonCharges','UserScores'])->orderBy('username', 'desc')->paginate(15);
        $kokugo=User::where('role','0')->get();
        $math=User::where('role','5')->get();
// dd(config('user.role'));
// dd($user);
        return view('post.index',compact('user','kokugo','math'));
    }

    public function search(Request $request){

        // $user=User::with(['UserPersonCharges','UserScores'])->orderBy('username', 'desc')->paginate(15);
        $kokugo=User::where('role','0')->get();
        $math=User::where('role','5')->get();

        $search = $request->input();
        $kinds = $request->input('kinds');
        $order = $request->input('order');
        $underAge = $request->input('underAge');
        $overAge = $request->input('overAge');
        $u_admission_date = $request->input('u_admission_date');
        $o_admission_date = $request->input('o_admission_date');
        $kokugo_t = $request->input('kokugo_t');
        $math_t = $request->input('math_t');
        $underscore = $request->input('underscore');
        $overscore = $request->input('overscore');
        $role = $request->input('role');
        // dd($search);

        $query = User::query();

        // 並び替え
        if(!empty($kinds) && !empty($order)){
            switch ($kinds . $order) {
                case 'username'.'asc':
                    //
                    $query->orderBy('username', 'asc');
                    break;
                case 'username'.'desc':
                    //
                    $query->orderBy('username', 'desc');
                    break;
                case 'birthday'.'asc':
                    //
                    $query->orderBy('birthday', 'asc');
                    break;
                case 'birthday'.'desc':
                    //
                    $query->orderBy('birthday', 'desc');
                    break;
                case 'admission_date'.'asc':
                    //
                    $query->orderBy('admission_date', 'asc');
                    break;
                case 'admission_date'.'desc':
                    //
                    $query->orderBy('admission_date', 'desc');
                    break;
                case 'score'.'asc':
                    //
                    //  $query->orderBy('score', 'asc');
                     $query->join('user_scores as asc', function ($query) use ($request) {
                        $query->on('users.id', '=', 'asc.user_id');})->orderBy('asc.score', 'asc');
                    break;
                case 'score'.'desc':
                    //
                    $query->join('user_scores as desc', function ($query) use ($request) {
                        $query->on('users.id', '=', 'desc.user_id');})->orderBy('desc.score', 'desc');
                    break;
            }
        }
            // 年齢検索
        if(!empty($underAge)){
                // subYears()で指定年数を減らす
                $latestBirthday = Carbon::now()->subYear($underAge)->format('Y-m-d');
                $query->where('birthday', '<=', $latestBirthday);
        }
        if(!empty($overAge)){
                // subYears()で指定年数を減らす
                $earliestBirthday = Carbon::now()->subYear($overAge + 1)->addDay()->format('Y-m-d');
                $query->where('birthday', '>=', $earliestBirthday);
        }
        // 入学日検索
        if(!empty($u_admission_date)){
            $query->Where('admission_date','>=',$u_admission_date);
        }
        if(!empty($o_admission_date)){
            $query->Where('admission_date','<=',$o_admission_date);
        }
        // 数学講師
        if(!empty($math_t)){
            $query->join('user_person_charges as math', function ($query) use ($request) {
            $query->on('users.id', '=', 'math.user_id');})
                ->where('math.math_teacher_user_id','=', $math_t);
        }
        // 国語講師
        if(!empty($kokugo_t)){
            $query->join('user_person_charges as kokugo', function ($query) use ($request) {
            $query->on('users.id', '=', 'kokugo.user_id');})
                  ->where('kokugo.japanese_language_user_id','=', $kokugo_t);
        }

        // 点数
        if(!empty($underscore)){
                $query->join('user_scores as u_score', function ($query) use ($request) {
                $query->on('users.id', '=', 'u_score.user_id');})
                        ->where('u_score.score','>=',$underscore);
        }
        if(!empty($overscore)){
                $query->join('user_scores as o_score', function ($query) use ($request) {
                $query->on('users.id', '=', 'o_score.user_id');})
                        ->where('o_score.score','<=',$overscore);
        }
        if(!empty($role)) {
            $query->where('role','=', $role);
        }

         $user = $query->orderBy('username', 'desc')->paginate(15);


        return view('post.index',compact('user','kokugo','math'));;
    }
}
