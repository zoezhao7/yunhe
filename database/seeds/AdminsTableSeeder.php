<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Carbon;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = [
            'user_name' => 'admin',
            'password' => Hash::make('123123'),
            'real_name' => '超级管理员',
            'role_ids' => json_encode([0]),
            'created_at' => Carbon::now(),
        ];

        Admin::insert($admin);
    }
}
