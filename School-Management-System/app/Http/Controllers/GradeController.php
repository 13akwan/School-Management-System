<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grade;
use App\Models\Submission;

class GradeController extends Controller
{
    public function index(){
        
        $user = auth()->user();

        if ($user->role === 'admin'){
            $grades = Grade::all();
        } elseif ($user->role === 'teacher'){
            $grades = Grade::whereHas('task.teaching', function($q){
                $q->where('teacher_id', auth()->id());
            })->get();
        } elseif ($user->role === 'student'){
            $grades = Grade::whereHas('student_id', auth()->id())->get();
        }

        return view('grades.index', compact('grades'));
    }

    public function create(){
        $submissions = Submission::with(['task', 'student'])->get();
        return view('grades.create', compact('submissions'));
    }

    public function store(Request $request){
        $request->validate([
            'submission_id' => 'required',
            'score' => 'required|integer|min:0|max:100'
        ]);

        $submission = Submission::findOrFail($request->submission_id);

        Grade::create([
            'student_id' => $submission->student_id,
            'task_id' => $submission->task_id,
            'submission_id' => $submission->id,
            'score' => $request->score
        ]);

    }

        public function destroy(Grade $grade){
            $grade->delete();
            return redirect()->route('grade.index');
        }
}


