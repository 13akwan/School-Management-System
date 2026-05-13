<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            SchoolClassSeeder::class,
            SubjectSeeder::class,
            TeacherSeeder::class,
            StudentSeeder::class,
            TeachingSeeder::class,

            TaskSeeder::class,
            SubmissionSeeder::class,
            AttendanceSeeder::class,
            GradeSeeder::class,
        ]);
    }
}