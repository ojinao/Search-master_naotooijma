<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Model;
Use App\Models\Users\User;

class UserPersonCharge extends Model
{
    protected $table = 'user_person_charges';

    protected $fillable = [
        'user_id',
        'math_teacher_user_id',
        'japanese_language_user_id',
    ];

        public function user()
    {
        return $this->belongsToMany('App\Models\Users\User');
        // (user::class);
    }

        public function getM($user_id){
        return $this ->where('math_teacher_user_id', $user_id)->get();
    }





}
