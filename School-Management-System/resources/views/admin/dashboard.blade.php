@extends('layouts.admin')

@section('title', 'Dashboard')

@section('breadcrumbs')

<li class="breadcrumb-item active">
    Dashboard
</li>

@endsection

@section('content')

<div class="row">

    <div class="col-xl-3 col-md-6 mb-4">

        <div class="card border-left-success shadow h-100 py-2">

            <div class="card-body">

                <div class="row no-gutters align-items-center">

                    <div class="col mr-2">

                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Total Students
                        </div>

                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ $totalStudents }}
                        </div>

                    </div>

                    <div class="col-auto">
                        <i class="fas fa-user-graduate fa-2x text-gray-300"></i>
                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="col-xl-3 col-md-6 mb-4">

        <div class="card border-left-primary shadow h-100 py-2">

            <div class="card-body">

                <div class="row no-gutters align-items-center">

                    <div class="col mr-2">

                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Teachers
                        </div>

                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ $totalTeachers }}
                        </div>

                    </div>

                    <div class="col-auto">
                        <i class="fas fa-chalkboard-teacher fa-2x text-gray-300"></i>
                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="col-xl-3 col-md-6 mb-4">

        <div class="card border-left-warning shadow h-100 py-2">

            <div class="card-body">

                <div class="row no-gutters align-items-center">

                    <div class="col mr-2">

                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Total Classes
                        </div>

                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ $totalClasses }}
                        </div>

                    </div>

                    <div class="col-auto">
                        <i class="fas fa-school fa-2x text-gray-300"></i>
                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="col-xl-3 col-md-6 mb-4">

        <div class="card border-left-danger shadow h-100 py-2">

            <div class="card-body">

                <div class="row no-gutters align-items-center">

                    <div class="col mr-2">

                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                            Total Subjects
                        </div>

                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ $totalSubjects }}
                        </div>

                    </div>

                    <div class="col-auto">
                        <i class="fas fa-book fa-2x text-gray-300"></i>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<form method="GET" class="mb-4">

    <div class="row">

        {{-- SEARCH --}}
        <div class="col-md-4 mb-2">

            <input type="text"
                   name="search"
                   class="form-control"
                   placeholder="Search name or email..."
                   value="{{ request('search') }}">

        </div>

        {{-- ROLE --}}
        <div class="col-md-3 mb-2">

            <select name="role" class="form-control">

                <option value="">
                    Semua Role
                </option>

                <option value="admin"
                    {{ request('role') == 'admin' ? 'selected' : '' }}>
                    Admin
                </option>

                <option value="teacher"
                    {{ request('role') == 'teacher' ? 'selected' : '' }}>
                    Teacher
                </option>

                <option value="student"
                    {{ request('role') == 'student' ? 'selected' : '' }}>
                    Student
                </option>

            </select>

        </div>

        {{-- CLASS --}}
        <div class="col-md-3 mb-2">

            <select name="class_id" class="form-control">

                <option value="">
                    Semua Kelas
                </option>

                @foreach($classes as $class)

                    <option value="{{ $class->id }}"
                        {{ request('class_id') == $class->id ? 'selected' : '' }}>

                        {{ $class->name }}

                    </option>

                @endforeach

            </select>

        </div>

        {{-- BUTTON --}}
        <div class="col-md-2 mb-2 d-flex">

            <button class="btn btn-primary mr-2 flex-fill">
                Filter
            </button>

            <a href="{{ route('admin.dashboard') }}"
               class="btn btn-secondary flex-fill">

                Reset

            </a>

        </div>

    </div>

</form>

<div class="card shadow mb-4">

    <div class="card-header py-3">

        <h6 class="m-0 font-weight-bold text-primary">
            User List
        </h6>

    </div>

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-bordered">

                <thead>

                    <tr>

                        <th>No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Class</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($users as $user)

                    <tr>

                        <td>
                            {{ $loop->iteration + ($users->currentPage() - 1) * $users->perPage() }}
                        </td>

                        <td>
                            {{ $user->name }}
                        </td>

                        <td>
                            {{ $user->email }}
                        </td>

                        <td>

                            @if($user->role == 'admin')

                                <span class="badge badge-danger">
                                    Admin
                                </span>

                            @elseif($user->role == 'teacher')

                                <span class="badge badge-primary">
                                    Teacher
                                </span>

                            @else

                                <span class="badge badge-success">
                                    Student
                                </span>

                            @endif

                        </td>

                        <td>
                            {{ $user->class->name ?? '-' }}
                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="5" class="text-center">
                            No users found
                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="mt-3">
            {{ $users->links() }}
        </div>

    </div>

</div>

@endsection