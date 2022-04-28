<?php

use Illuminate\Database\Seeder;
use App\Models\Users\UserPersonCharge;

class UserPersonChargesTableSeeder extends Seeder
{
    public function run()
    {
        for ($i = 1; $i <= 94; $i++) {
            UserPersonCharge::create([
                'user_id' => $i,
                'japanese_language_user_id' => rand(95, 97),
                'math_teacher_user_id' => rand(98, 100),
            ]);
        }
    }
}
