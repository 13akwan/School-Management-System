<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\User;
use App\Models\SchoolClass;
use App\Models\Teaching;

class TeachingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = auth()->user();

        $query = Teaching::with([
            'teacher',
            'subject',
            'class'
        ]);

        if ($user->role === 'teacher') {

            $query->where('teacher_id', auth()->id());

        }

        if ($request->search) {

            $query->where(function ($q) use ($request) {

                $q->whereHas('teacher', function ($teacher) use ($request) {

                    $teacher->where(
                        'name',
                        'like',
                        '%' . $request->search . '%'
                    );

                })

                ->orWhereHas('subject', function ($subject) use ($request) {

                    $subject->where(
                        'name',
                        'like',
                        '%' . $request->search . '%'
                    );

                })

                ->orWhereHas('class', function ($class) use ($request) {

                    $class->where(
                        'name',
                        'like',
                        '%' . $request->search . '%'
                    );

                });

            });
        }

        if ($request->teacher_id) {

            $query->where(
                'teacher_id',
                $request->teacher_id
            );

        }

        if ($request->subject_id) {

            $query->where(
                'subject_id',
                $request->subject_id
            );

        }

        if ($request->class_id) {

            $query->where(
                'class_id',
                $request->class_id
            );

        }

        $teachings = $query
            ->latest()
            ->paginate(10);

        $teachers = User::where('role', 'teacher')->get();

        $subjects = Subject::all();

        $classes = SchoolClass::all();

        return view('teachings.index', compact(
            'teachings',
            'teachers',
            'subjects',
            'classes'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
   public function create()
    {
        $teachers = User::where('role', 'teacher')->get();
        $subjects = Subject::all();
        $classes = SchoolClass::all();

        return view('teachings.create', compact('teachers', 'subjects', 'classes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'teacher_id' => 'required',
            'subject_id' => 'required',
            'class_id' => 'required',
        ]);

        $exists = Teaching::where([
            'teacher_id' => $request->teacher_id,
            'subject_id' => $request->subject_id,
            'class_id' => $request->class_id,
        ])->exists();

        if($exists){
            return back()
                ->withErrors([
                    'duplicate' => 'Teaching sudah ada'
                ])
                ->withInput();
        }

        Teaching::create([
            'teacher_id' => $request->teacher_id,
            'subject_id' => $request->subject_id,
            'class_id' => $request->class_id,
        ]);

        return redirect()
            ->route('admin.teachings.index')
            ->with('success', 'Teaching berhasil dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Teaching $teaching)
    {
        $teachers = User::where('role', 'teacher')->get();

        $subjects = Subject::all();

        $classes = SchoolClass::all();

        return view('teachings.edit', compact(
            'teaching',
            'teachers',
            'subjects',
            'classes'
        ));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, Teaching $teaching)
    {
        $request->validate([
            'teacher_id' => 'required',
            'subject_id' => 'required',
            'class_id' => 'required',
        ]);

        $teaching->update([
            'teacher_id' => $request->teacher_id,
            'subject_id' => $request->subject_id,
            'class_id' => $request->class_id,
        ]);

        return redirect()
            ->route('admin.teachings.index')
            ->with('success', 'Teaching berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teaching $teaching)
    {
        $teaching->delete();
        return redirect()
            ->route('admin.teachings.index')
            ->with('success', 'Teaching berhasil dihapus');
    }
}
