<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Submission;
use App\Models\Task;
use App\Models\Subject;
use App\Models\SchoolClass;

class SubmissionController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        $query = Submission::with([
            'student',
            'task.teaching.subject',
            'task.teaching.class',
            'grade'
        ]);

        if ($user->role == 'student') {

            $query->where(
                'student_id',
                $user->id
            );

            if ($request->subject_id) {

                $query->whereHas('task.teaching', function ($q) use ($request) {

                    $q->where(
                        'subject_id',
                        $request->subject_id
                    );

                });

            }

        }

        if ($user->role == 'teacher') {

            $query->whereHas('task.teaching', function ($q) use ($user, $request) {

                $q->where(
                    'teacher_id',
                    $user->id
                );

                if ($request->class_id) {

                    $q->where(
                        'class_id',
                        $request->class_id
                    );

                }

            });

        }

        if ($request->date) {

            $query->whereDate(
                'submitted_at',
                $request->date
            );

        }

        $submissions = $query
            ->latest()
            ->paginate(10);

        $subjects = Subject::all();

        $classes = SchoolClass::all();

        return view('submissions.index', compact(
            'submissions',
            'subjects',
            'classes'
        ));
    }

    public function create(){

        $user = auth()->user();

        if ($user->role === 'student') {
            $tasks = Task::where(
                'type',
                'assignment'
            )
            ->whereHas('teaching', function($q){

                $q->where(
                    'class_id',
                    auth()->user()->class_id
                );

            })
            ->get();;
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
            'content' => 'nullable',
            'file' => 'nullable|mimes:pdf,doc,docx,zip,jpg,jpeg,png|max:5120'
        ]);

        $exists = Submission::where('task_id', $request->task_id)
            ->where('student_id', auth()->id())
            ->exists();

        if ($exists) {
            return back()->withErrors([
                'task_id' => 'Task sudah pernah disubmit.'
            ]);
        }

        if ($task->type === 'oral') {

            return back()->withErrors([
                'task_id' => 'Task oral tidak memerlukan submission.'
            ]);

        }

        $filePath = null;

        if ($request->hasFile('file')) {

            $filePath = $request->file('file')
                ->store('submissions', 'public');

        }

        Submission::create([
            'task_id' => $request->task_id,
            'student_id' => auth()->id(),
            'content' => $request->content,
            'file' => $filePath,
            'submitted_at' => now()
        ]);

        return redirect()->route('student.submissions.index');
    }

    public function destroy(Submission $submission)
    {
        $user = auth()->user();

        if ($user->role === 'teacher') {

            if (
                $submission->task
                    ->teaching
                    ->teacher_id !== $user->id
            ) {
                abort(403);
            }

            $submission->delete();

            return redirect()
                ->route('teacher.submissions.index')
                ->with('success', 'Submission berhasil dihapus');
        }

        abort(403);
    }
}
