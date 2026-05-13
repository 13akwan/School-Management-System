<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Attendance;
use App\Models\Teaching;
use App\Models\User;

class AttendanceSeeder extends Seeder
{
    public function run(): void
    {
        $teachings = Teaching::all();

        $statuses = [
            'hadir',
            'izin',
            'sakit',
            'alpha'
        ];

        foreach ($teachings as $teaching) {

            $students = User::where('role', 'student')
                ->where('class_id', $teaching->class_id)
                ->get();

            foreach ($students as $student) {

                for ($day = 1; $day <= 7; $day++) {

                    Attendance::create([
                        'teaching_id' => $teaching->id,
                        'student_id' => $student->id,
                        'date' => now()->subDays($day),

                        'status' => collect($statuses)
                            ->random(),
                    ]);
                }
            }
        }
    }
}