<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Item;
use Illuminate\Support\Facades\DB;
use App\Models\Task;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $names = [
            'Bolt',
            'Nut',
            'Washer',
            'Screw',
            'Nail',
            'Pin',
            'Rivet',
            'Wrench',
            'Screwdriver',
            'Pliers',
            'Chisel',
        ];
        $types = [
            'Parts',
            'Parts',
            'Parts',
            'Parts',
            'Parts',
            'Parts',
            'Parts',
            'Parts',
            'Parts',
            'Parts',
            'Parts',
        ];
        $brands = [
            'generic_bolt',
            'generic_nut',
            'generic_washer',
            'generic_screw',
            'generic_nail',
            'generic_pin',
            'generic_rivet',
            'generic_wrench',
            'generic_screwdriver',
            'generic_pliers',
            'generic_chisel',
        ];
        $produsens = [
            'Manufacturer',
            'Manufacturer',
            'Manufacturer',
            'Manufacturer',
            'Manufacturer',
            'Manufacturer',
            'Manufacturer',
            'Manufacturer',
            'Manufacturer',
            'Manufacturer',
            'Manufacturer',
        ];
        $stocks = [
            2000,
            2000,
            2000,
            2000,
            2000,
            2000,
            2000,
            2000,
            2000,
            2000,
            2000,
        ];
        $units = [
            'single_unit',
            'single_unit',
            'single_unit',
            'single_unit',
            'single_unit',
            'single_unit',
            'single_unit',
            'single_unit',
            'single_unit',
            'single_unit',
            'single_unit',
        ];

        $items = [];

        foreach ($names as $key => $name) {
            $item = new Item();
            $item->name = $name;
            $item->type = $types[$key];
            $item->brand = $brands[$key];
            $item->produsen = $produsens[$key];
            $item->stock = $stocks[$key];
            $item->unit = $units[$key];
            $item->image_path = 'placeholder.jpg';
            $item->save();

            $items[] = $item;
        }

        $tasks = Task::all();
        foreach ($tasks as $task) {
            foreach ($items as $item) {
                DB::table('tasks_has_items')->insert([
                    'tasks_id' => $task->id,
                    'items_id' => $item->id,
                    'amount' => 100,
                ]);
            }
        }
    }
}
