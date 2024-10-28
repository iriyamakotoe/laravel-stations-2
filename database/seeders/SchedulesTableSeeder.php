<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SchedulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('schedules')->insert([
            ['movie_id' => 360, 'start_time' => '2024-10-28 10:00:00', 'end_time' => '2024-10-28 12:00:00'],
            ['movie_id' => 361, 'start_time' => '2024-10-28 12:30:00', 'end_time' => '2024-10-28 14:30:00'],
            ['movie_id' => 362, 'start_time' => '2024-10-28 15:00:00', 'end_time' => '2024-10-28 17:00:00'],
            ['movie_id' => 363, 'start_time' => '2024-10-28 20:00:00', 'end_time' => '2024-10-28 22:00:00'],
        ]);
    }
}
