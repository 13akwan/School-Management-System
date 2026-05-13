<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Grade;
use App\Models\Submission;

class GradeSeeder extends Seeder
{
    public function run(): void
    {
        $submissions = Submission::all();

        foreach ($submissions as $submission) {

            Grade::create([
                'student_id' => $submission->student_id,
                'task_id' => $submission->task_id,
                'submission_id' => $submission->id,

                'score' => rand(70, 100),
            ]);
        }
    }
}