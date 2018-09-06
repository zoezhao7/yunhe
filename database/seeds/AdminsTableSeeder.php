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
        $admins = [
            [
                'user_name' => 'admin',
                'password' => Hash::make('123123'),
                'real_name' => '老大',
                'role_ids' => json_encode([1]),
                'created_at' => Carbon::now(),
            ],
            [
                'user_name' => 'padmin',
                'password' => Hash::make('123123'),
                'real_name' => '管产品的',
                'role_ids' => json_encode([2]),
                'created_at' => Carbon::now(),
            ],
            [
                'user_name' => 'sadmin',
                'password' => Hash::make('123123'),
                'real_name' => '管店的',
                'role_ids' => json_encode([3]),
                'created_at' => Carbon::now(),
            ]
        ];

        Admin::insert($admins);
    }
}
