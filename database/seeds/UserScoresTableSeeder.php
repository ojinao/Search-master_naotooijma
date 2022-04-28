<?php

use Illuminate\Database\Seeder;
use App\Models\Users\UserScore;

class UserScoresTableSeeder extends Seeder
{
    public function run()
    {
        for ($i = 1; $i <= 94; $i++) {
            UserScore::create([
                'user_id' => $i,
                'score' => rand(1, 500),
            ]);
        }
    }
}
