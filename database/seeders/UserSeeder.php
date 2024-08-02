<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'password' => Hash::make('admin123'),
                'is_admin' => 1
            ],
            [
                'name' => 'Tahsinul',
                'email' => 'tahsinul@gmail.com',
                'password' => Hash::make('tahsinul123'),
                'is_admin' => 0
            ],
            [
                'name' => 'Amir',
                'email' => 'amir@gmail.com',
                'password' => Hash::make('amir123'),
                'is_admin' => 0
            ],
        ];

        foreach ($data as $key => $value) {
            DB::table('users')->insert([
                'name' => $value['name'],
                'email' => $value['email'],
                'password' => $value['password'],
                'is_admin' => $value['is_admin'],
            ]);
        }
    }
}
