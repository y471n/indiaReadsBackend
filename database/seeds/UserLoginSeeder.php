<?php

use Illuminate\Database\Seeder;

class UserLoginSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_login')->insert([
            'user_email' => 'p.bafna@indiareads.com',
            'user_password' => '09730a46521c48da5dabab70002735306bf1c6e32b299a609d11f6796dcaca1b',
            'user_status' => 1,
            'salt' => '7rcolUlCypEORGng9GLCfkBMa4mUJQtK',
            'created_at' => \Carbon\Carbon::now()->subYear(),
            'role' => 1,
            // 'last_seen' => \Carbon\Carbon::now()->subYear(),
            'verify' => \Carbon\Carbon::now()->subYear()
        ]);
    }
}

