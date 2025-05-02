<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SheetsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seeds = [
            ['id' => 1, 'screen_id' => 1, 'column' => 1, 'row' => 'a'],
            ['id' => 2, 'screen_id' => 1, 'column' => 2, 'row' => 'a'],
            ['id' => 3, 'screen_id' => 1, 'column' => 3, 'row' => 'a'],
            ['id' => 4, 'screen_id' => 1, 'column' => 4, 'row' => 'a'],
            ['id' => 5, 'screen_id' => 1, 'column' => 5, 'row' => 'a'],
            ['id' => 6, 'screen_id' => 1, 'column' => 1, 'row' => 'b'],
            ['id' => 7, 'screen_id' => 1, 'column' => 2, 'row' => 'b'],
            ['id' => 8, 'screen_id' => 1, 'column' => 3, 'row' => 'b'],
            ['id' => 9, 'screen_id' => 1, 'column' => 4, 'row' => 'b'],
            ['id' => 10, 'screen_id' => 1, 'column' => 5, 'row' => 'b'],
            ['id' => 11, 'screen_id' => 1, 'column' => 1, 'row' => 'c'],
            ['id' => 12, 'screen_id' => 1, 'column' => 2, 'row' => 'c'],
            ['id' => 13, 'screen_id' => 1, 'column' => 3, 'row' => 'c'],
            ['id' => 14, 'screen_id' => 1, 'column' => 4, 'row' => 'c'],
            ['id' => 15, 'screen_id' => 1, 'column' => 5, 'row' => 'c'],
            ['id' => 16, 'screen_id' => 2, 'column' => 1, 'row' => 'a'],
            ['id' => 17, 'screen_id' => 2, 'column' => 2, 'row' => 'a'],
            ['id' => 18, 'screen_id' => 2, 'column' => 3, 'row' => 'a'],
            ['id' => 19, 'screen_id' => 2, 'column' => 4, 'row' => 'a'],
            ['id' => 20, 'screen_id' => 2, 'column' => 5, 'row' => 'a'],
            ['id' => 21, 'screen_id' => 2, 'column' => 1, 'row' => 'b'],
            ['id' => 22, 'screen_id' => 2, 'column' => 2, 'row' => 'b'],
            ['id' => 23, 'screen_id' => 2, 'column' => 3, 'row' => 'b'],
            ['id' => 24, 'screen_id' => 2, 'column' => 4, 'row' => 'b'],
            ['id' => 25, 'screen_id' => 2, 'column' => 5, 'row' => 'b'],
            ['id' => 26, 'screen_id' => 2, 'column' => 1, 'row' => 'c'],
            ['id' => 27, 'screen_id' => 2, 'column' => 2, 'row' => 'c'],
            ['id' => 28, 'screen_id' => 2, 'column' => 3, 'row' => 'c'],
            ['id' => 29, 'screen_id' => 2, 'column' => 4, 'row' => 'c'],
            ['id' => 30, 'screen_id' => 2, 'column' => 5, 'row' => 'c'],
            ['id' => 31, 'screen_id' => 3, 'column' => 1, 'row' => 'a'],
            ['id' => 32, 'screen_id' => 3, 'column' => 2, 'row' => 'a'],
            ['id' => 33, 'screen_id' => 3, 'column' => 3, 'row' => 'a'],
            ['id' => 34, 'screen_id' => 3, 'column' => 4, 'row' => 'a'],
            ['id' => 35, 'screen_id' => 3, 'column' => 5, 'row' => 'a'],
            ['id' => 36, 'screen_id' => 3, 'column' => 1, 'row' => 'b'],
            ['id' => 37, 'screen_id' => 3, 'column' => 2, 'row' => 'b'],
            ['id' => 38, 'screen_id' => 3, 'column' => 3, 'row' => 'b'],
            ['id' => 39, 'screen_id' => 3, 'column' => 4, 'row' => 'b'],
            ['id' => 40, 'screen_id' => 3, 'column' => 5, 'row' => 'b'],
            ['id' => 41, 'screen_id' => 3, 'column' => 1, 'row' => 'c'],
            ['id' => 42, 'screen_id' => 3, 'column' => 2, 'row' => 'c'],
            ['id' => 43, 'screen_id' => 3, 'column' => 3, 'row' => 'c'],
            ['id' => 44, 'screen_id' => 3, 'column' => 4, 'row' => 'c'],
            ['id' => 45, 'screen_id' => 3, 'column' => 5, 'row' => 'c'],
        ];

        foreach ($seeds as $seed) {
            DB::table('sheets')->insert($seed);
        }
    }
}
