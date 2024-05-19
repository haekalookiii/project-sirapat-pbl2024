<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $prefix = 'C030322';
        $randomDigits = \Faker\Factory::create()->unique()->numberBetween(100, 999);
        return [
            'nama_lengkap' => fake()->name(),
            'nim' => $prefix . $randomDigits,
            'tanggal_lahir' => $this->faker->date,
            'jenis_kelamin' => $this->faker->randomElement(['L', 'P']),
            'foto_profil' => null,
            'angkatan_mahasiswa' => $this->faker->randomElement(['2021', '2022', '2023']),
            'hobby' => $this->faker->randomElement(['Bola', 'Baca', 'Menyanyi']),
        ];
    }
}
