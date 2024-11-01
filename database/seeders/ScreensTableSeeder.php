<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ScreensTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seeds = [
            ['id' => 1, 'screen' => 1],
            ['id' => 2, 'screen' => 2],
            ['id' => 3, 'screen' => 3],
        ];

        foreach ($seeds as $seed) {
            DB::table('screens')->insert($seed);
        }
    }
}
