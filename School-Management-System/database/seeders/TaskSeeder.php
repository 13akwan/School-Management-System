<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Task;
use App\Models\Teaching;

class TaskSeeder extends Seeder
{
    public function run(): void
    {
        $teachings = Teaching::all();

        $assignmentDescriptions = [

            '
            <h4>Tugas Essay</h4>

            <p>
                Jelaskan materi berikut secara lengkap.
            </p>

            <ul>
                <li>Minimal 300 kata</li>
                <li>Boleh upload file</li>
            </ul>
            ',

            '
            <h4>Project</h4>

            <p>
                Buat project sesuai instruksi guru.
            </p>
            ',

            '
            <h4>Laporan Praktikum</h4>

            <p>
                Upload hasil praktikum minggu ini.
            </p>
            '
        ];

        $oralDescriptions = [

            '
            <h4>Ujian Lisan</h4>

            <p>
                Presentasikan materi di depan kelas.
            </p>
            ',

            '
            <h4>Interview Session</h4>

            <p>
                Guru akan memberikan pertanyaan langsung.
            </p>
            ',

            '
            <h4>Speaking Test</h4>

            <p>
                Praktik speaking di depan guru.
            </p>
            '
        ];

        foreach ($teachings as $teaching) {

            for ($i = 1; $i <= rand(3, 6); $i++) {

                $type = fake()->randomElement([
                    'assignment',
                    'oral'
                ]);

                Task::create([

                    'teaching_id' => $teaching->id,

                    'title' => $type === 'assignment'
                        ? 'Tugas ' . $i
                        : 'Ujian Lisan ' . $i,

                    'description' => $type === 'assignment'
                        ? $assignmentDescriptions[array_rand($assignmentDescriptions)]
                        : $oralDescriptions[array_rand($oralDescriptions)],

                    'type' => $type,

                    'due_date' => now()
                        ->addDays(rand(3, 14))

                ]);

                $tasks = Task::where(
                    'type',
                    'assignment'
                )->get();

            }

        }
    }
}