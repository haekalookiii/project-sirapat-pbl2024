<?php

namespace Database\Seeders;
use App\Models\Schedule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Schedule::factory(30)->create();
        $days = [[1, 3], 5, 6, 9, [12, 13]];
        $fake = fake('id_ID');
        $today = date('Y-m-d');

        foreach ($days as $day){
            if(is_array($day)) {
                $schedules[]=[
                    'title' => $fake->sentence(2),
                    'start_date' => date('Y-m-d', strtotime($today. '+'.$day[0]. 'days')),
                    'end_date' => date('Y-m-d', strtotime($today. '+'.$day[1]. 'days')),
                    'category' => $fake->randomElement(['success', 'danger', 'warning', 'info']),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            } else {
                $schedules[]=[
                    'title' => $fake->sentence(2),
                    'start_date' => date('Y-m-d', strtotime($today. '+'.$day. 'days')),
                    'end_date' => date('Y-m-d', strtotime($today. '+'.$day. 'days')),
                    'category' => $fake->randomElement(['success', 'danger', 'warning', 'info']),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        Schedule::insert($schedules);
    }
}
