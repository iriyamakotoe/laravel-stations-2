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
            ['movie_id' => 242, 'start_time' => '2024-09-20 10:00:00', 'end_time' => '2024-09-20 12:00:00'],
            ['movie_id' => 242, 'start_time' => '2024-09-20 12:30:00', 'end_time' => '2024-09-20 14:30:00'],
            ['movie_id' => 242, 'start_time' => '2024-09-20 15:00:00', 'end_time' => '2024-09-20 17:00:00'],
            ['movie_id' => 242, 'start_time' => '2024-09-20 20:00:00', 'end_time' => '2024-09-20 22:00:00'],
        ]);
    }
}
