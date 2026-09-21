<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('email', 'omarihabsayed@gmail.com')->first();
        if(!$user) {
            User::create([
                'name' => 'omarihab',
                'email' => 'omarihabsayed@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]);
        }
    }
}
