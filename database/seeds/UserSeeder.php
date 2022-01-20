<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $USER = new User();
        $USER->name = 'admin';
        $USER->email ='admin@localhost.com';
        $USER->password=Hash::make('password');
        $USER->save();

    }
}
