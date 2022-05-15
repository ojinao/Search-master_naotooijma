<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Model;

class UserPersonCharge extends Model
{
    protected $table = 'user_person_charges';

    protected $fillable = [
        'user_id',
        'math_teacher_user_id',
        'japanese_language_user_id',
    ];

    //     public function user()
    // {
    //     return $this->belongsTo('App\Models\Users\User');
    //     // (user::class);
    // }
}
