<?php

namespace App\Models\Users;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';

    protected $fillable = [
        // 'user_id',
        // 'math_teacher_user_id',
        // 'japanese_language_user_id',
                    'username',
                    'username_kana',
                    'birthday',
                    'admission_date',
                    'gender',
                    'email',
                    'password',
                    'role',
    ];

        protected $dates = [
        'birthday',
        'admission_date'
    ];

    public function mathT()
    {
        // return $this->hasMany('App\Models\Users\UserPersonCharge');
        return $this->belongsToMany(self::class,'user_person_charges','user_id','math_teacher_user_id')->withPivot('user_id');
    }
    public function kokugoT()
    {
        // return $this->hasMany('App\Models\Users\UserPersonCharge');
        return $this->belongsToMany(self::class,'user_person_charges','user_id','japanese_language_user_id');
    }

    public function UserScore()
    {
        return $this->hasOne('App\Models\Users\UserScore');

    }

            public function getM($user_id){
        return $this -> mathT()->where('math_teacher_user_id', $user_id)->get();
    }

}
