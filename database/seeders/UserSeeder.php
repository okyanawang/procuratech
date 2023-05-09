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
            'Pimpinan Proyek',
            'Supervisor',
            'Pelaksana Pengukuran',
            'Pelaksana Analisis',
            'Pelaksana Pekerjaan',
            'Pelaksana Pemeriksa Pekerjaan',
            'Bendahara Peralatan',
            'Petugas Inventori'
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
            'Panca'
        ];

        foreach ($roles as $key => $role) {
            $user = new User;
            $user->name = $names[$key];
            $user->role = $role;
            $user->username = strtolower(str_replace(' ', '_', $role)) . '@example.com';
            $user->password = strtolower(str_replace(' ', '', $role));
            $user->ActiveOnDuty = true;
            
            $user->save();
        }
    }
}
