<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $roles = [
            'Admin IT',
            'Project Manager',
            'Supervisor',
            'Measurement Executor',
            'Analyst',
            'Job Executor',
            'Job Inspector',
            'Inventory Officer',
            // 'Inventory Treasurer',
        ];

        $names = [
            'Muhammad Ijat',
            'Ihsan Alfarisi',
            'Hanifah',
            'Rizky',
            'Rizal',
            'Yaqin Ainul',
            'Ahmad Fauzan',
            'Aryo Pratama',
            // 'Panca'
        ];

        $status_kepegawaian = [
            'Out-sourcing', 'Contract', 'Intern', 'Full Time', 'Out-sourcing', 'Contract', 'Intern', 'Full Time'
            // , 'Intern'
        ];

        $availability_status = [
            'on duty', 'on duty', 'on duty', 'on duty', 'on duty', 'on duty', 'on duty', 'on duty'
            // , 'on duty'
        ];

        foreach ($roles as $key => $role) {
            $user = new User;
            $user->name = $names[$key];
            $user->role = $role;
            $user->email = strtolower(str_replace(' ', '_', $role)) . '@example.com';
            $user->status_kepegawaian = $status_kepegawaian[$key];
            $user->phone_number = '081234567890';
            $user->address = 'Jl. Jalan Ke Kota Tua';
            $user->registration_number = mt_rand(100000, 999999);
            $user->username = strtolower(str_replace(' ', '_', $role));
            $user->password = bcrypt(strtolower(str_replace(' ', '', $role)));
            $user->availability_status = $availability_status[$key];

            $user->save();
        }
    }
}
