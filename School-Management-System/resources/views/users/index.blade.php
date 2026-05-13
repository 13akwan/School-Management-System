@extends('layouts.admin')

@section('title', 'Dashboard')

@section('breadcrumbs')

<li class="breadcrumb-item active">
    Users
</li>

@endsection

@section('content')

<div class="d-flex justify-content-between mb-3">

    <a href="{{ route('admin.users.create') }}"
       class="btn btn-primary">

        <i class="fas fa-plus"></i>
        Tambah User

    </a>

</div>

@if(session('success'))

<div class="alert alert-success">
    {{ session('success') }}
</div>

@endif

<div class="card shadow mb-4">

    <div class="card-body">

        <form method="GET">

            <div class="row">

                <div class="col-md-4 mb-3">

                    <input type="text"
                           name="search"
                           class="form-control"
                           placeholder="Search user..."
                           value="{{ request('search') }}">

                </div>

                <div class="col-md-3 mb-3">

                    <select name="role"
                            class="form-control">

                        <option value="">All Role</option>

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

                <div class="col-md-3 mb-3">

                    <button class="btn btn-primary">
                        Filter
                    </button>

                    <a href="{{ route('admin.users.index') }}"
                       class="btn btn-secondary">

                        Reset

                    </a>

                </div>

            </div>

        </form>

    </div>

</div>

<div class="card shadow">

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
                        <th width="180">Action</th>

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

                        <td>

                            <a href="{{ route('admin.users.edit', $user->id) }}"
                               class="btn btn-warning btn-sm">

                                Edit

                            </a>

                            <form action="{{ route('admin.users.destroy', $user->id) }}"
                                  method="POST"
                                  class="d-inline">

                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin hapus user?')">

                                    Delete

                                </button>

                            </form>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="6"
                            class="text-center">

                            No users found

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="mt-3">

            {{ $users->withQueryString()->links() }}

        </div>

    </div>

</div>

@endsection