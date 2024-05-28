<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@hme.poliban.ac.id',
            'password' => bcrypt('123'),
        ]);

        $admin->assignRole('admin');

        // $admin = User::create([
        //     'name' => 'Mimin',
        //     'email' => 'mimin@hme.poliban.ac.id',
        //     'password' => bcrypt('admin123'),
        // ]);

        // $admin->assignRole('admin');

        // $user = User::create([
        //     'name' => 'Bima Haekal Akbar',
        //     'email' => 'c030322108@mahasiswa.poliban.ac.id',
        //     'password' => bcrypt('c030322108'),
        // ]);

        // $user->assignRole('user');
    }
}
