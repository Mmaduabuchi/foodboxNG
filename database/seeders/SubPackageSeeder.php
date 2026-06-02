<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class SubPackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subPackages = [];

        $billingCycles = ['monthly', 'quarterly', 'yearly'];
        $statuses = ['active', 'inactive', 'draft'];

        for ($i = 1; $i <= 20; $i++) {

            $subPackages[] = [
                'package_id' => DB::table('packages')->inRandomOrder()->value('id'),
                'name' => 'Sub Package ' . $i,
                'price' => rand(5000, 50000),
                'image' => 'sub-package-' . $i . '.jpg',
                'short_description' => 'Short description for Sub Package ' . $i,
                'description' => 'This is the full description for Sub Package ' . $i . '. It contains more details about the package features and benefits.',
                'billing_cycle' => $billingCycles[array_rand($billingCycles)],
                'status' => $statuses[array_rand($statuses)],
                'is_available' => rand(0, 1),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'deleted_at' => null,
            ];
        }

        DB::table('sub_packages')->insert($subPackages);
    }
}
