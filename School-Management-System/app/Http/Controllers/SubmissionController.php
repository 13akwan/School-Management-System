<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Submission;
use App\Models\Task;

class SubmissionController extends Controller
{
    public function index(){
        $user = auth()->user();

        if ($user->role === 'admin'){
            $submissions = Submission::all();
        } elseif ($user->role === 'teacher'){
            $submissions = Submission::whereHas('task.teaching', function($q){
                $q->where('teacher_id', auth()->id());
            })->get();
        } elseif ($user->role === 'student'){
            $submissions = Submission::where('student_id', auth()->id())->get();
        }

        return view('submissions.index', compact('submissions'));
    }

    public function create(){

        $user = auth()->user();

        if ($user->role === 'student') {
            $tasks = Task::whereHas('teaching', function($q){
                $q->where('class_id', auth()->user()->class_id);
            })->get();
        } else {
            $tasks = Task::all();
        }

        return view('submissions.create', compact('tasks'));

    }

    public function store(Request $request){
        $task = Task::findOrFail($request->task_id);

        if ($task->teaching->class_id !== auth()->user()->class_id) {
            abort(403);
        }
        
        $request->validate([
            'task_id' => 'required',
            'content' => 'required'
        ]);

        Submission::create([
            'task_id' => $request->task_id,
            'student_id' => auth()->id(),
            'content' => $request->content,
            'submitted_at' => now()
        ]);

        return redirect()->route('submissions.index');
    }

    public function destroy(Submission $submission){
        $submission->delete();
        return redirect()->route('submissions.index');
    }
}
