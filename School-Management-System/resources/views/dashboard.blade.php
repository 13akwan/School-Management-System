@extends('layouts.admin')

@section('content')

<h1 class="h3 mb-4 text-gray-800">Admin Dashboard</h1>

<div class="row">

    {{-- Students --}}
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                        Students
                    </div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                        {{ $countStudents }}
                    </div>
                </div>
                <i class="fas fa-users fa-2x text-gray-300"></i>
            </div>
        </div>
    </div>

    {{-- Teachers --}}
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                        Teachers
                    </div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                        {{ $countTeachers }}
                    </div>
                </div>
                <i class="fas fa-chalkboard-teacher fa-2x text-gray-300"></i>
            </div>
        </div>
    </div>

    {{-- Classes --}}
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                        Classes
                    </div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                        {{ $countClasses }}
                    </div>
                </div>
                <i class="fas fa-school fa-2x text-gray-300"></i>
            </div>
        </div>
    </div>

    {{-- Subjects --}}
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                        Subjects
                    </div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                        {{ $countSubjects }}
                    </div>
                </div>
                <i class="fas fa-book fa-2x text-gray-300"></i>
            </div>
        </div>
    </div>

</div>

@endsection