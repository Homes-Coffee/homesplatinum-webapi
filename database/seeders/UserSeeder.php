<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'  => 'administrator',
            'email' => 'homesplatinum.bdj@gmail.com',
            'password' => Hash::make('rahasia123'),
            'email_verified_at' => now(),
            'remember_token'    => Str::random(10),
        ]);
    }
}
