<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Submission;
use App\Models\Attendance;
use App\Models\Grade;

class StudentDashboardController extends Controller
{
    public function index()
    {
        $student = auth()->user();

        $tasks = Task::whereHas('teaching', function ($query) use ($student) {
            $query->where('class_id', $student->class_id);
        });

        $totalTasks = $tasks->count();

        $totalSubmissions = Submission::where(
            'student_id',
            $student->id
        )->count();

        $totalAttendances = Attendance::where(
            'student_id',
            $student->id
        )->count();

        $averageScore = Grade::where(
            'student_id',
            $student->id
        )->avg('score');

        $attendanceChart = [
            'hadir' => Attendance::where('student_id', $student->id)
                ->where('status', 'hadir')
                ->count(),

            'izin' => Attendance::where('student_id', $student->id)
                ->where('status', 'izin')
                ->count(),

            'sakit' => Attendance::where('student_id', $student->id)
                ->where('status', 'sakit')
                ->count(),

            'alpha' => Attendance::where('student_id', $student->id)
                ->where('status', 'alpha')
                ->count(),
        ];

        $latestTasks = Task::with([
                'teaching.subject',
                'teaching.teacher'
            ])
            ->whereHas('teaching', function ($query) use ($student) {
                $query->where('class_id', $student->class_id);
            })
            ->latest()
            ->take(5)
            ->get();

        return view('students.dashboard', compact(
            'totalTasks',
            'totalSubmissions',
            'totalAttendances',
            'averageScore',
            'attendanceChart',
            'latestTasks'
        ));
    }
}
