<?php

namespace Database\Seeders;
use App\Models\Timetable;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TimetableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('timetables')->insert([
            [
                'day_of_week' => 1,
                'start_time' => '09:00',
                'end_time' => '18:00',
                'classroom_id' => 1,
            ],
            [
                'day_of_week' => 3,
                'start_time' => '09:00',
                'end_time' => '18:00',
                'classroom_id' => 1,
            ],

            [
                'day_of_week' => 1,
                'start_time' => '08:00',
                'end_time' => '18:00',
                'classroom_id' => 2,
            ],
            [
                'day_of_week' => 4,
                'start_time' => '08:00',
                'end_time' => '18:00',
                'classroom_id' => 2,
            ],
            [
                'day_of_week' => 6,
                'start_time' => '08:00',
                'end_time' => '18:00',
                'classroom_id' => 2,
            ],

            [
                'day_of_week' => 2,
                'start_time' => '15:00',
                'end_time' => '22:00',
                'classroom_id' => 3,
            ],
            [
                'day_of_week' => 5,
                'start_time' => '15:00',
                'end_time' => '22:00',
                'classroom_id' => 3,
            ],
            [
                'day_of_week' => 6,
                'start_time' => '15:00',
                'end_time' => '22:00',
                'classroom_id' => 3,
            ],
        ]);
    }
}
