<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\SchoolClass;
use App\Models\Subject;

class AdminDashboardController extends Controller
{
    public function index(){

        $countStudents = User::where('role', 'student')->count();
        $countTeachers = User::where('role', 'teacher')->count();
        $countClasses = SchoolClass::count();
        $countSubjects = Subject::count();

        return view('admin.dashboard', compact(
            'countStudents',
            'countTeachers',
            'countClasses',
            'countSubjects'
        ));

    }

}
