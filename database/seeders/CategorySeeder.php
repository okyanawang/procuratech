<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $names=[
            'Electrical',
            'Mechanical',
            'Piping',
            'Hull',
            'Outfitting',
        ];
        $location_ids=[
            1,
            2,
            2,
            3,
            3,
        ];

        $users_ids =[
            3,
            3,
            3,
            3,
            3,
        ];

        foreach ($names as $key => $name) {
            $category = new Category();
            $category->name = $name;
            $category->locations_id = $location_ids[$key];
            $category->users_id = $users_ids[$key];
            $category->save();
        }
    }
}
