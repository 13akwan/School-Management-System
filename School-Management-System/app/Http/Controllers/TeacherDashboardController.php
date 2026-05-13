<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Submission;
use App\Models\Attendance;
use App\Models\Teaching;
use App\Models\User;

class TeacherDashboardController extends Controller
{
    public function index()
    {
        $teacherId = auth()->id();

        $teachings = Teaching::where('teacher_id', $teacherId)->get();

        $teachingIds = $teachings->pluck('id');

        $classIds = $teachings->pluck('class_id')->unique();

        $totalStudents = User::where('role', 'student')
            ->whereIn('class_id', $classIds)
            ->count();

        $totalTasks = Task::whereIn('teaching_id', $teachingIds)
            ->count();

        $totalSubmissions = Submission::whereHas('task', function ($query) use ($teachingIds) {
            $query->whereIn('teaching_id', $teachingIds);
        })->count();

        $totalAttendances = Attendance::whereIn('teaching_id', $teachingIds)
            ->count();

        $attendanceChart = [
            'hadir' => Attendance::whereIn('teaching_id', $teachingIds)
                ->where('status', 'hadir')
                ->count(),

            'izin' => Attendance::whereIn('teaching_id', $teachingIds)
                ->where('status', 'izin')
                ->count(),

            'sakit' => Attendance::whereIn('teaching_id', $teachingIds)
                ->where('status', 'sakit')
                ->count(),

            'alpha' => Attendance::whereIn('teaching_id', $teachingIds)
                ->where('status', 'alpha')
                ->count(),
        ];

        $latestTasks = Task::with([
                'teaching.subject',
                'teaching.class'
            ])
            ->whereIn('teaching_id', $teachingIds)
            ->latest()
            ->take(5)
            ->get();

        return view('teachers.dashboard', compact(
            'totalStudents',
            'totalTasks',
            'totalSubmissions',
            'totalAttendances',
            'attendanceChart',
            'latestTasks'
        ));
    }
}
