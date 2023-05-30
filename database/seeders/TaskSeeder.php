<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Task;

class TaskSeeder extends Seeder
{
    public function run()
    {
        $tasks = [
            [
                'name' => 'Ship Painting',
                'description' => 'Paint the exterior of the ship',
                'status' => 'Pending',
                'type' => 'Painting',
                'start_date' => '2023-05-20',
                'end_date' => '2023-05-25',
                'categories_id' => 5,
                'image_path' => 'placeholder.jpg',
            ],
            [
                'name' => 'Engine Overhaul',
                'description' => 'Perform a complete overhaul of the ship engine',
                'status' => 'Pending',
                'type' => 'Overhaul',
                'start_date' => '2023-06-01',
                'end_date' => '2023-06-10',
                'categories_id' => 2,
                'image_path' => 'placeholder.jpg',
            ],
            [
                'name' => 'Hull Repair',
                'description' => 'Repair any damages to the ship hull',
                'status' => 'Pending',
                'type' => 'Repair',
                'start_date' => '2023-06-15',
                'end_date' => '2023-06-20',
                'categories_id' => 4,
                'image_path' => 'placeholder.jpg',
            ],
        ];

        foreach ($tasks as $task) {
            DB::table('tasks')->insert($task);
        }

        $workers = User::where('role', 'Job Executor')->get();
        $measurers = User::where('role', 'Measurement Executor')->get();
        $analysts = User::where('role', 'Analyst')->get();

        $users = $workers->concat($measurers)->concat($analysts);

        foreach ($users as $user) {
            foreach ($tasks as $task) {
                DB::table('users_has_tasks')->insert([
                    'users_id' => $user->id,
                    'tasks_id' => DB::table('tasks')->where('name', $task['name'])->value('id'),
                ]);
            }
        }
    }
}
