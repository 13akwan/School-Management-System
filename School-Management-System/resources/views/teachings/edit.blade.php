@extends('layouts.admin')

@section('content')

<h1 class="h3 mb-4 text-gray-800">
    Edit Teaching
</h1>

<div class="card shadow">

    <div class="card-body">

        <form action="{{ route('admin.teachings.update', $teaching->id) }}"
              method="POST">

            @csrf
            @method('PUT')

            <div class="mb-3">

                <label>Teacher</label>

                <select name="teacher_id"
                        class="form-control"
                        required>

                    <option value="">
                        Pilih Teacher
                    </option>

                    @foreach($teachers as $teacher)

                    <option value="{{ $teacher->id }}"
                        {{ $teaching->teacher_id == $teacher->id ? 'selected' : '' }}>

                        {{ $teacher->name }}

                    </option>

                    @endforeach

                </select>

            </div>

            <div class="mb-3">

                <label>Subject</label>

                <select name="subject_id"
                        class="form-control"
                        required>

                    <option value="">
                        Pilih Subject
                    </option>

                    @foreach($subjects as $subject)

                    <option value="{{ $subject->id }}"
                        {{ $teaching->subject_id == $subject->id ? 'selected' : '' }}>

                        {{ $subject->name }}

                    </option>

                    @endforeach

                </select>

            </div>

            <div class="mb-3">

                <label>Class</label>

                <select name="class_id"
                        class="form-control"
                        required>

                    <option value="">
                        Pilih Class
                    </option>

                    @foreach($classes as $class)

                    <option value="{{ $class->id }}"
                        {{ $teaching->class_id == $class->id ? 'selected' : '' }}>

                        {{ $class->name }}

                    </option>

                    @endforeach

                </select>

            </div>

            <button class="btn btn-primary">

                Update

            </button>

            <a href="{{ route('admin.teachings.index') }}"
               class="btn btn-secondary">

                Back

            </a>

        </form>

    </div>

</div>

@endsection