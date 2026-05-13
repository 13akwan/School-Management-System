<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\SchoolClass;
use App\Models\Subject;


class AdminDashboardController extends Controller
{
    public function index(Request $request)
    {
        $totalStudents = User::where('role', 'student')->count();

        $totalTeachers = User::where('role', 'teacher')->count();

        $totalClasses = SchoolClass::count();

        $totalSubjects = Subject::count();

        $query = User::with('class');

        if ($request->search) {

            $query->where(function($q) use ($request){

                $q->where(
                    'name',
                    'like',
                    '%' . $request->search . '%'
                )
                ->orWhere(
                    'email',
                    'like',
                    '%' . $request->search . '%'
                );

            });

        }

        if ($request->role) {

            $query->where(
                'role',
                $request->role
            );

        }

        if ($request->class_id) {

            $query->where(
                'class_id',
                $request->class_id
            );

        }

        $users = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $classes = SchoolClass::all();

        return view('admin.dashboard', compact(
            'totalStudents',
            'totalTeachers',
            'totalClasses',
            'totalSubjects',
            'users',
            'classes'
        ));
    }
}