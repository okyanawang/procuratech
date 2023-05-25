<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Location;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $project_ids = [
            1,
            1,
            1,
        ];

        $names = [
            'Main Deck',
            'Main Deck',
            'Main Deck',
        ];

        foreach ($names as $key=> $name){
            $location = new Location();
            $location->name = $name;
            $location->projects_id = $project_ids[$key];
            $location->save();
        }
    }
}
