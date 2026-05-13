@extends('layouts.admin')

@section('content')

<h1 class="h3 mb-4 text-gray-800">Grade Submission</h1>

<div class="card shadow">

    <div class="card-header">
        <h6 class="m-0 font-weight-bold text-primary">
            Input Nilai
        </h6>
    </div>

    <div class="card-body">

        <form action="{{ route('teacher.grades.store') }}" method="POST">

            @csrf

            <input type="hidden"
                   name="submission_id"
                   value="{{ $submission->id }}">

            {{-- STUDENT --}}
            <div class="form-group">
                <label>Student</label>

                <input type="text"
                       class="form-control"
                       value="{{ $submission->student->name }}"
                       disabled>
            </div>

            {{-- TASK --}}
            <div class="form-group">
                <label>Task</label>

                <input type="text"
                       class="form-control"
                       value="{{ $submission->task->title }}"
                       disabled>
            </div>

            {{-- SCORE --}}
            <div class="form-group">
                <label>Score</label>

                <input type="number"
                       name="score"
                       class="form-control"
                       min="0"
                       max="100"
                       value="{{ $submission->grade->score ?? '' }}">
            </div>

            <div class="d-flex justify-content-between mt-4">

                <a href="{{ route('teacher.submissions.index') }}"
                   class="btn btn-secondary">

                    ← Kembali

                </a>

                <button type="submit"
                        class="btn btn-primary">

                    Simpan Nilai

                </button>

            </div>

        </form>

    </div>

</div>

@endsection