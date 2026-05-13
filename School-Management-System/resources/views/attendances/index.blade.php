@extends('layouts.admin')

@section('title', 'Dashboard')

@section('breadcrumbs')

<li class="breadcrumb-item active">
    Attendances
</li>

@endsection

@section('content')

<form method="GET" class="mb-3">

    <div class="row">

        {{-- FILTER KELAS KHUSUS TEACHER --}}
        @if(auth()->user()->role == 'teacher')

        <div class="col-md-4 mb-3">

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

        {{-- FILTER TANGGAL --}}
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

                <a href="{{ route('teacher.attendances.index') }}"
                   class="btn btn-secondary">

                    Reset

                </a>

            @else

                <a href="{{ route('student.attendances.index') }}"
                   class="btn btn-secondary">

                    Reset

                </a>

            @endif

        </div>

    </div>

</form>

@if(session('success'))

<div class="alert alert-success">
    {{ session('success') }}
</div>

@endif

<div class="card shadow">

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-bordered">

                <thead>

                    <tr>

                        <th>Student</th>
                        <th>Subject</th>
                        <th>Class</th>
                        <th>Date</th>
                        <th>Status</th>

                        @if(auth()->user()->role == 'teacher')
                        <th>Action</th>
                        @endif

                    </tr>

                </thead>

                <tbody>

                    @forelse($attendances as $attendance)

                    <tr>

                        <td>
                            {{ $attendance->student->name ?? '-' }}
                        </td>

                        <td>
                            {{ $attendance->teaching->subject->name ?? '-' }}
                        </td>

                        <td>
                            {{ $attendance->teaching->class->name ?? '-' }}
                        </td>

                        <td>
                            {{ $attendance->date }}
                        </td>

                        <td>

                            @if($attendance->status == 'hadir')

                                <span class="badge badge-success">
                                    Hadir
                                </span>

                            @elseif($attendance->status == 'izin')

                                <span class="badge badge-warning">
                                    Izin
                                </span>

                            @elseif($attendance->status == 'sakit')

                                <span class="badge badge-info">
                                    Sakit
                                </span>

                            @else

                                <span class="badge badge-danger">
                                    Alpha
                                </span>

                            @endif

                        </td>

                        @if(auth()->user()->role == 'teacher')

                        <td>

                            <a href="{{ route('teacher.attendances.edit', $attendance->id) }}"
                               class="btn btn-warning btn-sm">

                                Edit

                            </a>

                            <form action="{{ route('teacher.attendances.destroy', $attendance->id) }}"
                                  method="POST"
                                  class="d-inline">

                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger btn-sm">

                                    Delete

                                </button>

                            </form>

                        </td>

                        @endif

                    </tr>

                    @empty

                    <tr>

                        <td colspan="6"
                            class="text-center">

                            No attendances found

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

            <div class="mt-3">

                {{ $attendances->withQueryString()->links() }}

            </div>

        </div>

    </div>

</div>

@endsection