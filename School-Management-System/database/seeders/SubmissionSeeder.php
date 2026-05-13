<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Submission;
use App\Models\Task;
use App\Models\User;

class SubmissionSeeder extends Seeder
{
    public function run(): void
    {
        $tasks = Task::where(
            'type',
            'assignment'
        )->get();

        foreach ($tasks as $task) {

            $students = User::where(
                'role',
                'student'
            )
            ->where(
                'class_id',
                $task->teaching->class_id
            )
            ->inRandomOrder()
            ->take(rand(10, 25))
            ->get();

            foreach ($students as $student) {

                $textContent = [

                    '<p>Saya sudah mengerjakan tugas sesuai instruksi.</p>',

                    '<p>Berikut jawaban saya mengenai materi minggu ini.</p>',

                    '<p>Terlampir hasil pengerjaan tugas.</p>',

                    '<p>Mohon dicek pak, terima kasih.</p>',

                    '<p>Saya mengalami sedikit kesulitan pada nomor 3.</p>'

                ];

                $hasText = rand(0, 1);

                $hasFile = rand(0, 1);

                if(!$hasText && !$hasFile){
                    $hasText = true;
                }

                Submission::create([

                    'task_id' => $task->id,

                    'student_id' => $student->id,

                    'content' => $hasText
                        ? $textContent[array_rand($textContent)]
                        : null,

                    'file' => $hasFile
                        ? 'dummy/sample.pdf'
                        : null,

                    'submitted_at' => now()
                        ->subDays(rand(0, 7))

                ]);

            }

        }
    }
}