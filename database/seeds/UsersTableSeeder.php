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
        $password = Hash::make('T35t1ng.');

        User::create([
            'email' => 'roberto1286@gmail.com',
            'password' => $password,
            'name' => 'Henry Vilchez',
            'phone' => '1921614321',
            'document' => '01234567890',
            'birthdate' => '1986-12-12',
        ]);
    }
}
