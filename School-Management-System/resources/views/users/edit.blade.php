@extends('layouts.admin')

@section('content')

<h1 class="h3 mb-4 text-gray-800">
    Edit User
</h1>

<div class="card shadow">

    <div class="card-body">

        <form action="{{ route('admin.users.update', $user->id) }}"
              method="POST">

            @csrf
            @method('PUT')

            <div class="mb-3">

                <label>Name</label>

                <input type="text"
                       name="name"
                       class="form-control"
                       value="{{ old('name', $user->name) }}"
                       required>

            </div>

            <div class="mb-3">

                <label>Email</label>

                <input type="email"
                       name="email"
                       class="form-control"
                       value="{{ old('email', $user->email) }}"
                       required>

            </div>

            <div class="mb-3">

                <label>Password</label>

                <input type="password"
                       name="password"
                       class="form-control">

                <small class="text-muted">
                    Kosongkan jika tidak ingin mengganti password
                </small>

            </div>

            <div class="mb-3">

                <label>Role</label>

                <select class="form-control" disabled>

                    <option value="admin"
                        {{ $user->role == 'admin' ? 'selected' : '' }}>
                        Admin
                    </option>

                    <option value="teacher"
                        {{ $user->role == 'teacher' ? 'selected' : '' }}>
                        Teacher
                    </option>

                    <option value="student"
                        {{ $user->role == 'student' ? 'selected' : '' }}>
                        Student
                    </option>

                </select>

                {{-- hidden input supaya role tetap terkirim --}}
                <input type="hidden"
                       name="role"
                       value="{{ $user->role }}">

            </div>

            <div class="mb-3"
                 style="{{ $user->role == 'student' ? '' : 'display:none;' }}">

                <label>Class</label>

                <select name="class_id"
                        class="form-control">

                    <option value="">
                        Pilih Class
                    </option>

                    @foreach($classes as $class)

                    <option value="{{ $class->id }}"
                        {{ $user->class_id == $class->id ? 'selected' : '' }}>

                        {{ $class->name }}

                    </option>

                    @endforeach

                </select>

            </div>

            <button class="btn btn-primary">

                Update

            </button>

            <a href="{{ route('admin.users.index') }}"
               class="btn btn-secondary">

                Back

            </a>

        </form>

    </div>

</div>

@endsection