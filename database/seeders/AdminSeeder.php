<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('admins')->insert([
            'first_name'           => 'Super',
            'last_name'            => 'Admin',
            'email'                => 'admin@example.com',
            'phone'                => '01700000000',
            'status'               => 'active',           // must be 'active' or 'inactive'
            'email_verified_status' => 'sent',             // queued, pending, sent
            'email_verified_at'    => now(),              // nullable timestamp
            'password'             => Hash::make('password'),
            'remember_token'       => Str::random(10),    // typical remember_token
            'created_at'           => now(),
            'updated_at'           => now(),
        ]);
    }
}
