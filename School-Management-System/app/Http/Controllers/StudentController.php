<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\SchoolClass;

class StudentController extends Controller
{
    public function index(){
        $students = User::where('role', 'student')->get();
        return view('students.index', compact('students'));
    }

    public function create(){
        $classes = SchoolClass::all(); 

        return view('students.create', compact('classes'));
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:tbl_users,email',
            'password' => 'required|min:6'
        ]);
    
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'student',
            'class_id' => $request->class_id,
        ]);

        return redirect()->route('students.index');
    }

    public function edit(User $student){
        $classes = SchoolClass::all(); 

        return view('students.edit', compact('student', 'classes'));
    }

    public function update(Request $request, User $student)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:tbl_users,email,' . $student->id,
            'class_id' => 'required|exists:tbl_classes,id', // 🔥 tambah ini
        ]);

        $student->update([
            'name' => $request->name,
            'email' => $request->email,
            'class_id' => $request->class_id,
        ]);

        return redirect()->route('students.index');
    }

    public function destroy(User $student){
        $student->delete();

        return redirect()->route('students.index');
    }
}