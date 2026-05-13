@extends('layouts.admin')

@section('title', 'Dashboard')

@section('breadcrumbs')

<li class="breadcrumb-item active">
    Submissions
</li>

@endsection

@section('content')

@if(auth()->user()->role == 'student')
    <div class="mb-3">
        <a href="{{ route('student.submissions.create') }}" 
           class="btn btn-primary">
            <i class="fas fa-plus"></i>
            Submit Task
        </a>
    </div>
@endif

<div class="card shadow">

    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            Submission List
        </h6>
    </div>

    <div class="card-body">

        <div class="table-responsive">

        <form method="GET" class="mb-3">

            <div class="row">

                {{-- STUDENT FILTER --}}
                @if(auth()->user()->role == 'student')

                    <div class="col-md-3 mb-3">

                        <select name="subject_id"
                                class="form-control">

                            <option value="">
                                Semua Mata Pelajaran
                            </option>

                            @foreach($subjects as $subject)

                                <option value="{{ $subject->id }}"
                                    {{ request('subject_id') == $subject->id ? 'selected' : '' }}>

                                    {{ $subject->name }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                @endif

                {{-- TEACHER FILTER --}}
                @if(auth()->user()->role == 'teacher')

                    <div class="col-md-3 mb-3">

                        <select name="class_id"
                                class="form-control">

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

                @endif

                {{-- DATE FILTER --}}
                <div class="col-md-3 mb-3">

                    <input type="date"
                        name="date"
                        class="form-control"
                        value="{{ request('date') }}">

                </div>

                <div class="col-md-3 mb-3">

                    <button class="btn btn-primary">
                        Filter
                    </button>

                    @if(auth()->user()->role == 'teacher')

                        <a href="{{ route('teacher.submissions.index') }}"
                        class="btn btn-secondary">

                            Reset

                        </a>

                    @else

                        <a href="{{ route('student.submissions.index') }}"
                        class="btn btn-secondary">

                            Reset

                        </a>

                    @endif

                </div>

            </div>

        </form>

            <table class="table table-bordered">

                <thead>
                    <tr>
                        <th>Student</th>
                        <th>Task</th>
                        <th>Subject</th>
                        <th>Class</th>
                        <th>Submitted At</th>
                        <th>Content</th>
                        <th>File</th>
                        <th>Score</th>
                        @if(in_array(auth()->user()->role, ['admin', 'teacher']))
                        <th>Action</th>
                    @endif
                    </tr>
                </thead>

                <tbody>

                    @forelse($submissions as $submission)
                        <tr>

                            <td>
                                {{ $submission->student->name ?? '-' }}
                            </td>

                            <td>
                                {{ $submission->task->title ?? '-' }}
                            </td>

                            <td>
                                {{ $submission->task->teaching->subject->name ?? '-' }}
                            </td>

                            <td>
                                {{ $submission->task->teaching->class->name ?? '-' }}
                            </td>

                            <td>
                                {{ $submission->submitted_at ?? '-' }}
                            </td>

                            <td>
                                {!! $submission->content !!}
                            </td>

                            <td>
                                @if($submission->file)
                                    <a href="{{ asset('storage/' . $submission->file) }}"
                                    target="_blank"
                                    class="btn btn-sm btn-info">
                                        Download
                                    </a>
                                @else
                                    -
                                @endif
                            </td>

                            <td>
                                @if($submission->grade)
                                    <span class="badge badge-success">
                                        {{ $submission->grade->score }}
                                    </span>
                                @else
                                    <span class="badge badge-secondary">
                                        Belum Dinilai
                                    </span>
                                @endif
                            </td>

                           @if(in_array(auth()->user()->role, ['admin', 'teacher']))
                            <td>

                                <a href="{{ route('teacher.grades.create', [
                                    'submission_id' => $submission->id
                                ]) }}"
                                class="btn btn-sm btn-primary">

                                    @if($submission->grade)
                                        Edit Nilai
                                    @else
                                        Grade
                                    @endif

                                </a>

                            <form action="{{ route('teacher.submissions.destroy', $submission->id) }}"
                                method="POST"
                                class="d-inline">

                                @csrf
                                @method('DELETE')

                                <button class="btn btn-sm btn-danger"
                                        onclick="return confirm('Yakin hapus submission?')">

                                    Delete

                                </button>

                            </form>

                            </td>
                            @endif

                        </tr>
                    @empty

                        <tr>
                            <td colspan="6" class="text-center">
                                Belum ada submission
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

            <div class="mt-4">
                {{ $submissions->links() }}
            </div>

        </div>

    </div>

</div>

@endsection