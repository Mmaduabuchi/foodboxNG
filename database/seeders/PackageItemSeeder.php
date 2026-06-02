<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;


class PackageItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $units = ['pcs', 'kg', 'litres', 'packs', 'bottles', 'bags'];

        $foodItems = [
            'Rice',
            'Beans',
            'Palm Oil',
            'Tomatoes',
            'Onions',
            'Chicken',
            'Fish',
            'Salt',
            'Pepper',
            'Garri',
            'Yam',
            'Plantain',
            'Spaghetti',
            'Milk',
            'Bread',
            'Eggs',
            'Sugar',
            'Flour',
            'Butter',
            'Cheese'
        ];

        $items = [];

        for ($i = 0; $i < 20; $i++) {

            $items[] = [
                'sub_package_id' => DB::table('sub_packages')
                    ->inRandomOrder()
                    ->value('id'),

                'item_name' => $foodItems[$i],

                'quantity' => rand(1, 10),

                'unit' => $units[array_rand($units)],

                'estimated_price' => rand(1000, 20000),

                'created_at' => Carbon::now(),

                'updated_at' => Carbon::now(),
            ];
        }

        DB::table('package_items')->insert($items);
    }
}
