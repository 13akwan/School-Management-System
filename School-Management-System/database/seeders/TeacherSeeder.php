<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class TeacherSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {

            User::create([
                'name' => 'Teacher ' . $i,
                'email' => 'teacher'.$i.'@gmail.com',
                'password' => bcrypt('password'),
                'role' => 'teacher',
            ]);
        }
    }
}