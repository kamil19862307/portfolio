<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'image' => 'no_image.png',
            'password' => Hash::make('password'),
            'role_id' => Role::where('name', 'admin')->first()->id,
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);

        // Обычные пользователи
        User::factory(5)->create([
            'role_id' => Role::where('name', 'user')->first()->id,
        ]);
    }
}
