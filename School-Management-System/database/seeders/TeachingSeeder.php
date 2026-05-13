<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Teaching;
use App\Models\User;
use App\Models\Subject;
use App\Models\SchoolClass;

class TeachingSeeder extends Seeder
{
    public function run(): void
    {
        $teachers = User::where('role', 'teacher')->get();

        $subjects = Subject::all();

        $classes = SchoolClass::all();

        foreach ($teachers as $index => $teacher) {

            $subject = $subjects[$index % $subjects->count()];

            foreach ($classes as $class) {

                Teaching::create([
                    'teacher_id' => $teacher->id,
                    'subject_id' => $subject->id,
                    'class_id' => $class->id,
                ]);
            }
        }
    }
}