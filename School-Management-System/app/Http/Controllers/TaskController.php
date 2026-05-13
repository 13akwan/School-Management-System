<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teaching;
use App\Models\Task;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        $query = Task::with([
            'teaching.class',
            'teaching.subject',
            'teaching.teacher'
        ]);

        if ($user->role === 'teacher') {

            $query->whereHas('teaching', function($q){
                $q->where('teacher_id', auth()->id());
            });

        } elseif ($user->role === 'student') {

            $query->whereHas('teaching', function($q){
                $q->where('class_id', auth()->user()->class_id);
            });

        }

        if ($request->class_id) {

            $query->whereHas('teaching', function($q) use ($request){

                $q->where('class_id', $request->class_id);

            });

        }

        $tasks = $query->get();

        if ($user->role === 'teacher') {

            $classes = \App\Models\SchoolClass::whereHas('teachings', function($q){
                $q->where('teacher_id', auth()->id());
            })->get();

        } else {

            $classes = \App\Models\SchoolClass::all();

        }

        return view('tasks.index', compact('tasks', 'classes'));
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
        $request->validate([
            'teaching_id' => 'required',
            'title' => 'required',
            'description' => 'nullable',
            'type' => 'required',
            'due_date' => 'nullable|date'
        ]);

        $teaching = Teaching::findOrFail($request->teaching_id);

        if ($teaching->teacher_id !== auth()->id()) {
            abort(403);
        }

        Task::create([
            'teaching_id' => $request->teaching_id,
            'title' => $request->title,
            'description' => $request->description,
            'type' => $request->type,
            'due_date' => $request->due_date,
        ]);

        return redirect()
            ->route('teacher.tasks.index')
            ->with('success', 'Task berhasil dibuat');
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'type' => 'required',
            'due_date' => 'nullable|date'
        ]);

        if ($task->teaching->teacher_id !== auth()->id()) {
            abort(403);
        }

        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'type' => $request->type,
            'due_date' => $request->due_date,
        ]);

        return redirect()
            ->route('teacher.tasks.index')
            ->with('success', 'Task berhasil diupdate');
    }

    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('teacher.tasks.index');
    }
}
