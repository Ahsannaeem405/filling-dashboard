<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'telegram' => 'admin@telegram_id',
            'email' => 'admin@admin.com',
            'password' => Hash::make('12345678'),
            'status' => 'active',
            'role' => 'admin',
            'rank' => 'Admin',
            'last_login' => Carbon::now()->format('d.m.Y, H:i'),
        ]);
    }
}
