<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teaching;
use App\Models\Task;

class TaskController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'admin'){
            $tasks = Task::with('teaching')->get();
        } elseif ($user->role === 'teacher'){
            $tasks = Task::whereHas('teaching', function($q){
                $q->where('teacher_id', auth()->id());
            })->get();
        } elseif ($user->role === 'student'){
            $tasks = Task::whereHas('teaching', function($q){
                $q->where('class_id', auth()->user()->class_id);
            })->get();
        }

        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        $user = auth()->user();

        if ($user->role === 'teacher') {
            $teachings = Teaching::where('teacher_id', auth()->id())->get();
        } else {
            $teachings = Teaching::all();
        }

        return view('tasks.create', compact('teachings'));
    }

    public function store(Request $request)
    {
        $teaching = Teaching::findOrFail($request->teaching_id);

        if ($teaching->teacher_id !== auth()->id()) {
            abort(403);
        }
        
        $request->validate([
            'teaching_id' => 'required',
        ]);

        Task::create($request->all());

        return redirect()->route('tasks.index');
    }

    public function update(Request $request, string $id)
    {

    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index');
    }
}
