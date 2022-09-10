<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        $password = Hash::make('testtest');

        User::create([
            'name' => 'test',
            'email' => 'test@test.com',
            'password' => $password,
            'amount_money'=> 100000,
            'amount_points'=> 100000,
        ]);
    }
}
