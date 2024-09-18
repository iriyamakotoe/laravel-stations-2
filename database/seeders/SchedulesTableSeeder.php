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
            ['movie_id' => 120, 'start_time' => '17:30:00', 'end_time' => '19:30:00'],
            ['movie_id' => 120, 'start_time' => '10:00:00', 'end_time' => '12:00:00'],
            ['movie_id' => 121, 'start_time' => '12:30:00', 'end_time' => '14:30:00'],
            ['movie_id' => 120, 'start_time' => '15:00:00', 'end_time' => '17:00:00'],
            ['movie_id' => 121, 'start_time' => '20:00:00', 'end_time' => '22:00:00'],
        ]);
    }
}
