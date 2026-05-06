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
    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'admin'){
            $teachings = Teaching::all();
        } elseif ($user->role === 'teacher'){
            $teachings = Teaching::whereHas('teacher_id', auth()->id())->get();
        } else {
            $teachings = collect();
        }

        return view('teachings.index', compact('teachings'));
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

        Teaching::create($request->all());

        return redirect()->route('teachings.index');
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teaching $teaching)
    {
        $teaching->delete();
        return redirect()->route('teachings.index');
    }
}
