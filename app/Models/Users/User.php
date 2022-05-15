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

    //     public function UserPersonCharges()
    // {
    //     return $this->hasMany('App\Models\Users\UserPersonCharge');
    // }
}
