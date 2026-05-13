@extends('layouts.admin')

@section('content')

<h1 class="h3 mb-4 text-gray-800">
    Create Attendance
</h1>

<div class="card shadow">

    <div class="card-body">

        <form action="{{ route('teacher.attendances.store') }}"
              method="POST">

            @csrf

            <div class="mb-3">

                <label>Teaching</label>

                <select name="teaching_id"
                        class="form-control"
                        required>

                    <option value="">
                        Pilih Teaching
                    </option>

                    @foreach($teachings as $teaching)

                    <option value="{{ $teaching->id }}">

                        {{ $teaching->subject->name }}
                        -
                        {{ $teaching->class->name }}

                    </option>

                    @endforeach

                </select>

            </div>

            <div class="mb-3">

                <label>Student</label>

                <select name="student_id"
                        class="form-control"
                        required>

                    <option value="">
                        Pilih Student
                    </option>

                    @foreach($students as $student)

                    <option value="{{ $student->id }}">

                        {{ $student->name }}

                    </option>

                    @endforeach

                </select>

            </div>

            <div class="mb-3">

                <label>Date</label>

                <input type="date"
                       name="date"
                       class="form-control"
                       required>

            </div>

            <div class="mb-3">

                <label>Status</label>

                <select name="status"
                        class="form-control"
                        required>

                    <option value="hadir">Hadir</option>
                    <option value="izin">Izin</option>
                    <option value="sakit">Sakit</option>
                    <option value="alpha">Alpha</option>

                </select>

            </div>

            <button class="btn btn-primary">
                Save
            </button>

        </form>

    </div>

</div>

@endsection