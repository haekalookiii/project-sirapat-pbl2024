<?php

namespace Database\Factories;

use App\Models\Schedule;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

class ScheduleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        static $subjectId = 101;
        return [
            'subject_id' => $subjectId++,
            'hari' => $this->faker->randomElement(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat']),
            'jam_mulai' => $this->faker->randomElement(['07:00', '08:00', '09:00', '10:00', '11:00', '12:00', '13:00', '14:00']),
            'jam_selesai' => $this->faker->randomElement(['07:00', '08:00', '09:00', '10:00', '11:00', '12:00', '13:00', '14:00']),
            'ruangan' => $this->faker->randomElement(['A1', 'A2', 'A3', 'A4', 'A5', 'A6']),
            'kode_absensi' => $this->faker->randomElement(['A1', 'A2', 'A3', 'A4', 'A5', 'A6']),
            'tahun_akademik' => $this->faker->randomElement(['2021/2022', '2022/2023', '2023/2024']),
            'semester' => $this->faker->randomElement(['Ganjil', 'Genap']),
            'created_by' => $this->faker->numberBetween(1, 3),
            'updated_by' => $this->faker->numberBetween(1, 3),
            'deleted_by' => null,
        ];
    }
}
