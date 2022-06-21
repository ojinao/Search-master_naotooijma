<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Model;

class UserScore extends Model
{
    protected $table = 'user_scores';

    protected $fillable = [
        'user_id',
        'score',
    ];


        public function users()
    {
        return $this->hasOne('App\Models\Users\user');
    }
}
