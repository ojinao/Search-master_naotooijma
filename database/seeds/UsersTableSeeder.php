<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use App\Models\Users\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $start = Carbon::create('1995', '1', '1');
        $end = Carbon::create('2021', '7', '1');
        $min = strtotime($start);
        $max = strtotime($end);
        $date = rand($min, $max);
        $date = date('Y-m-d', $date);

        for ($i = 1; $i <= 94; $i++) {
            User::create([
                'username' => '田中太郎' . $i,
                'username_kana' => 'タナカタロウ' . $i,
                'birthday' => $date,
                'admission_date' => $date,
                'gender' => rand(0, 1),
                'email' => Str::random(10) . '@gmail.com',
                'password' => Hash::make('test' . $i),
            ]);
        }

        User::create([
            'username' => '田中国語講師1',
            'username_kana' => 'タナカコクゴコウシ1',
            'birthday' => $date,
            'admission_date' => $date,
            'gender' => rand(0, 1),
            'email' => Str::random(10) . '@gmail.com',
            'role' => 0,
            'password' => Hash::make('test' . $i),
        ]);

        User::create([
            'username' => '田中国語講師2',
            'username_kana' => 'タナカコクゴコウシ2',
            'birthday' => $date,
            'admission_date' => $date,
            'gender' => rand(0, 1),
            'email' => Str::random(10) . '@gmail.com',
            'role' => 0,
            'password' => Hash::make('test' . $i),
        ]);

        User::create([
            'username' => '田中国語講師3',
            'username_kana' => 'タナカコクゴコウシ3',
            'birthday' => $date,
            'admission_date' => $date,
            'gender' => rand(0, 1),
            'email' => Str::random(10) . '@gmail.com',
            'role' => 0,
            'password' => Hash::make('test' . $i),
        ]);

        User::create([
            'username' => '田中数学講師1',
            'username_kana' => 'タナカスウガクコウシ1',
            'birthday' => $date,
            'admission_date' => $date,
            'gender' => rand(0, 1),
            'email' => Str::random(10) . '@gmail.com',
            'role' => 5,
            'password' => Hash::make('test' . $i),
        ]);

        User::create([
            'username' => '田中数学講師2',
            'username_kana' => 'タナカスウガクコウシ2',
            'birthday' => $date,
            'admission_date' => $date,
            'gender' => rand(0, 1),
            'email' => Str::random(10) . '@gmail.com',
            'role' => 5,
            'password' => Hash::make('test' . $i),
        ]);

        User::create([
            'username' => '田中数学講師3',
            'username_kana' => 'タナカスウガクコウシ3',
            'birthday' => $date,
            'admission_date' => $date,
            'gender' => rand(0, 1),
            'email' => Str::random(10) . '@gmail.com',
            'role' => 5,
            'password' => Hash::make('test' . $i),
        ]);
    }
}
