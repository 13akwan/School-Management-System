<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Teaching;
use App\Models\User;
use App\Models\SchoolClass;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        $query = Attendance::with([
            'student',
            'teaching.subject',
            'teaching.class'
        ]);

        if ($user->role === 'admin') {

        }

        elseif ($user->role === 'teacher') {

            $query->whereHas('teaching', function ($q) {

                $q->where(
                    'teacher_id',
                    auth()->id()
                );

            });

            if ($request->class_id) {

                $query->whereHas('teaching', function ($q) use ($request) {

                    $q->where(
                        'class_id',
                        $request->class_id
                    );

                });

            }

        }

        elseif ($user->role === 'student') {

            $query->where(
                'student_id',
                auth()->id()
            );

        }

        if ($request->date) {

            $query->whereDate(
                'date',
                $request->date
            );

        }

        $attendances = $query
            ->latest()
            ->paginate(10);

        $classes = SchoolClass::all();

        return view('attendances.index', compact(
            'attendances',
            'classes'
        ));
    }

    public function create()
    {
        $teachings = Teaching::where('teacher_id', auth()->id())
            ->with(['subject', 'class'])
            ->get();

        $students = User::where('role', 'student')->get();

        return view('attendances.create', compact(
            'teachings',
            'students'
        ));
    }

    public function update(Request $request, Attendance $attendance)
    {
        $request->validate([
            'status' => 'required'
        ]);

        $attendance->update([
            'status' => $request->status
        ]);

        return redirect()
            ->route('teacher.attendances.index')
            ->with('success', 'Attendance berhasil diupdate');
    }

    public function edit(Attendance $attendance)
    {
        return view('attendances.edit', compact('attendance'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'teaching_id' => 'required',
            'student_id' => 'required',
            'date' => 'required|date',
            'status' => 'required'
        ]);

        $exists = Attendance::where('student_id', $request->student_id)
            ->where('teaching_id', $request->teaching_id)
            ->where('date', $request->date)
            ->exists();

        if ($exists) {
            return redirect()->back()
                ->with('error', 'Siswa sudah melakukan absensi pada mapel ini.');
        }

        Attendance::create([
            'teaching_id' => $request->teaching_id,
            'student_id' => $request->student_id,
            'date' => $request->date,
            'status' => $request->status,
        ]);

        return redirect()->back()
            ->with('success', 'Absensi berhasil ditambahkan.');
    }

    public function destroy(Attendance $attendance){
        $attendance->delete();
        return redirect()
            ->route('teacher.attendances.index')
            ->with('success', 'Attendances berhasil dihapus');
    }
}
