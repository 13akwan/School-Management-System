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
            $grades = Grade::where('student_id', auth()->id())->get();
        }

        return view('grades.index', compact('grades'));
    }

    public function create(Request $request)
    {
        $submission = Submission::with([
            'student',
            'task'
        ])->findOrFail($request->submission_id);

        return view('grades.create', compact('submission'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'submission_id' => 'required',
            'score' => 'required|integer|min:0|max:100'
        ]);

        $submission = Submission::findOrFail($request->submission_id);

        if ($submission->task->teaching->teacher_id !== auth()->id()) {
            abort(403);
        }

        Grade::updateOrCreate(

            [
                'student_id' => $submission->student_id,
                'task_id' => $submission->task_id,
            ],

            [
                'submission_id' => $submission->id,
                'score' => $request->score
            ]
        );

            return redirect()
                ->route('teacher.submissions.index')
                ->with('success', 'Nilai berhasil disimpan');
        }


        public function destroy(Grade $grade){
            $grade->delete();
            return redirect()->route('grade.index');
        }
}


