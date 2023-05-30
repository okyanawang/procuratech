<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Project;
use Illuminate\Support\Facades\DB;



class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    

    public function run(): void
    {
        $names = [
            'PT. Kapal Indo Baru',
            'PT. Kapal Indo Lama',
            'PT. Kapal Indo Tua',
        ];

        $descriptions = [
            'Initial Project Description',
            'Initial Project Description',
            'Initial Project Description',
        ];

        $registration_dates = [
            '2023-05-25',
            '2023-05-25',
            '2023-05-25',
        ];

        $start_dates = [
            '2023-05-30',
            '2023-05-30',
            '2023-05-30',
        ];

        $end_dates = [
            '2023-08-30',
            '2023-08-30',
            '2023-08-30',
        ];

        $statuses = [
            '1',
            '2',
            '3',
        ];
        foreach ($names as $key => $name) {
            $project = new Project();
            $project->name = $name;
            $project->description = $descriptions[$key];
            // Set other project attributes]
            $project->registration_date = $registration_dates[$key];
            $project->start_date = $start_dates[$key];
            $project->end_date = $end_dates[$key];
            $project->status = $statuses[$key];
            $project->image_path = '1685417912-projects.jpg';

            $project->save();

            $projects[] = $project;
        }

        $user = User::where('role', 'Project Manager')->select('id')->first();
        $user_id = $user->id;

        // Attach users to projects
        foreach ($projects as $project) {
            // Create a new entry in the users_has_projects table
            DB::table('users_has_projects')->insert([
                'projects_id' => $project->id,
                'users_id' => $user_id,
            ]);
        }
    }
}