<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (!User::where('email', 'teste@gmail.com')->first()) {
            User::create([
                'name' => 'Teste',
                'email' => 'teste@gmail.com',
                'password' => Hash::make('123456', ['rounds' => 12])
            ]);
        }

        if (!User::where('email', 'teste2@gmail.com')->first()) {
            User::create([
                'name' => 'Teste 2',
                'email' => 'teste2@gmail.com',
                'password' => Hash::make('123456', ['rounds' => 12])
            ]);
        }

        if (!User::where('email', 'teste3@gmail.com')->first()) {
            User::create([
                'name' => 'Teste 3',
                'email' => 'teste3@gmail.com',
                'password' => Hash::make('123456', ['rounds' => 12])
            ]);
        }
    }
}
