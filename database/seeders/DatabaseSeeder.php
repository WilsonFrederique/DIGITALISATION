<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        DB::table('users')->insert([
            'numEmp' => '010111011111',
            'email' => 'jeanclaude@gmail.com',
            'password' => Hash::make('jean123'),
        ]);
    }
}
