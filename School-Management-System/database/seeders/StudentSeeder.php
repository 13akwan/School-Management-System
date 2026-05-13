<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\SchoolClass;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        $classes = SchoolClass::all();

        for ($i = 1; $i <= 100; $i++) {

            User::create([
                'name' => 'Student ' . $i,
                'email' => 'student'.$i.'@gmail.com',
                'password' => bcrypt('password'),
                'role' => 'student',

                'class_id' => $classes->random()->id,
            ]);
        }
    }
}