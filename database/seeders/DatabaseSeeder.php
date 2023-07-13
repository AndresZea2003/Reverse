<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Credential;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
         User::create([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10)]);

         Credential::create([
             'login' => '6dd490faf9cb87a9862245da41170ff2',
             'secret_key' => 'iQhxZqnRbJe',
             'url' => 'https://test.placetopay.com/rest/',
             'local' => 'CO'

         ]);

         Credential::create([
             'login' => '9206a367f2b9a8918bbd5951a4064235',
             'secret_key' => 'iYj4QbQHu5i91Dz4',
             'url' => 'https://test.placetopay.ec/rest/',
             'local' => 'EC'

         ]);

         Credential::create([
             'login' => 'dd346ae765faed66156b2b2924673e5e',
             'secret_key' => 'O9o5mF8U425byx4m',
             'url' => 'https://test.placetopay.com/rest/',
             'local' => 'PR'
         ]);
    }
}
