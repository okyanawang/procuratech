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
            'Material',
            'Material',
            'Material',
            'Material',
            'Material',
            'Material',
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
            'PCS',
            'PCS',
            'PCS',
            'PCS',
            'PCS',
            'PCS',
            'PCS',
            'PCS',
            'PCS',
            'PCS',
            'PCS',
        ];

        $sku = [
            'BOLT-001',
            'NUT-001',
            'WASHER-001',
            'SCREW-001',
            'NAIL-001',
            'PIN-001',
            'RIVET-001',
            'WRENCH-001',
            'SCREWDRIVER-001',
            'PLIERS-001',
            'CHISEL-001',
        ];

        $items = [];

        foreach ($names as $key => $name) {
            $item = new Item();
            $item->name = $name;
            $item->type = $types[$key];
            $item->brand = $brands[$key];
            $item->sku = $sku[$key];
            $item->produsen = $produsens[$key];
            $item->stock = $stocks[$key];
            $item->unit = $units[$key];
            $item->image_path = 'placeholder.jpg';
            $item->save();

            $items[] = $item;
        }
    }
}
