@extends('layouts.admin')

@section('content')

<h1 class="h3 mb-4 text-gray-800">
    Create User
</h1>

<div class="card shadow">

    <div class="card-body">

        <form action="{{ route('admin.users.store') }}"
              method="POST">

            @csrf

            <div class="mb-3">

                <label>Name</label>

                <input type="text"
                       name="name"
                       class="form-control"
                       required>

            </div>

            <div class="mb-3">

                <label>Email</label>

                <input type="email"
                       name="email"
                       class="form-control"
                       required>

            </div>

            <div class="mb-3">

                <label>Password</label>

                <input type="password"
                       name="password"
                       class="form-control"
                       required>

            </div>

            <div class="mb-3">

                <label>Role</label>

                <select name="role"
                        id="role"
                        class="form-control">

                    <option value="admin">
                        Admin
                    </option>

                    <option value="teacher">
                        Teacher
                    </option>

                    <option value="student">
                        Student
                    </option>

                </select>

            </div>

            <div class="mb-3"
                 id="class-group">

                <label>Class</label>

                <select name="class_id"
                        class="form-control">

                    <option value="">
                        Pilih Class
                    </option>

                    @foreach($classes as $class)

                    <option value="{{ $class->id }}">
                        {{ $class->name }}
                    </option>

                    @endforeach

                </select>

            </div>

            <button class="btn btn-primary">

                Save

            </button>

            <a href="{{ route('admin.users.index') }}"
               class="btn btn-secondary">

                Back

            </a>

        </form>

    </div>

</div>

<script>

const role = document.getElementById('role');
const classGroup = document.getElementById('class-group');

function toggleClass()
{
    if(role.value == 'student'){
        classGroup.style.display = 'block';
    }else{
        classGroup.style.display = 'none';
    }
}

toggleClass();

role.addEventListener('change', toggleClass);

</script>

@endsection