<?php

namespace Database\Seeders;

use App\Models\Attendance;
use GuzzleHttp\Promise\Create;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Attendance::create([
            'id' => '1', 
            'status_kehadiran' => 'Alpa'
        ]);

        Attendance::create([
            'id' => '2', 
            'status_kehadiran' => 'Hadir'
        ]);

        Attendance::create([
            'id' => '3', 
            'status_kehadiran' => 'Izin'
        ]);

        Attendance::create([
            'id' => '4', 
            'status_kehadiran' => 'Sakit'
        ]);
    }
}
