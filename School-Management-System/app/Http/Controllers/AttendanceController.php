<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Teaching;
use App\Models\User;

class AttendanceController extends Controller
{
    public function index(){

        $user = auth()->user();

        if ($user->role === 'admin'){
            $attendances = Attendance::all();
        } elseif ($user->role === 'teacher'){
            $attendances = Attendance::whereHas('teaching', function($q){
                $q->where('teacher_id', auth()->id());
            })->get();
        } elseif ($user->role === 'student'){
            $attendances = Attendance::whereHas('student_id', auth()->id())->get();
        }

        return view('attendances.index', compact('attendances'));
    }

    public function create(){
        $teachings = Teaching::all();
        $students = User::where('role', 'student')->get();

        return view('attendances.create', compact('teachings', 'students'));
    }

    public function store(Request $request){
        $request->validate([
            'teaching_id' => 'required',
            'student_id' => 'required',
            'date' => 'required|date',
            'status' => 'required'
        ]);

        Attendance::create($request->all());

        return redirect()->route('attendances.index');
    }

    public function destroy(Attendance $attendance){
        $attendance->delete();
        return redirect()->route('attendances.index');
    }
}
