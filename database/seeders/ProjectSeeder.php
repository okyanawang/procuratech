<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Project;



class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $project = new Project();
        $project->name = 'Fixing ships in the harbor';
        $project->description = 'Initial Project Description';
        // Set other project attributes
        $project->project_manager_id = 2;
        $project->registration_date = '2023-05-17';
        $project->start_date = '2023-05-20';
        $project->end_date = '2023-08-17';
        $project->status = 'active';

        $project->save();
    }
}