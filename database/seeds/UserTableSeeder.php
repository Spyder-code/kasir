<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'=>"owner",
            'email'=>"owner@yahoo.com",
            'password' => Hash::make("owner123"),
            'level' =>1,
        ]);
        User::create([
            'name'=>"kasir",
            'email'=>"kasir@yahoo.com",
            'password' => Hash::make("kasir123"),
            'level' =>2,
        ]);
    }
}
