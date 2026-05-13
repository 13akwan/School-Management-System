@extends('layouts.admin')

@section('content')

<h1 class="h3 mb-4 text-gray-800">
    Edit Attendance
</h1>

<div class="card shadow">

    <div class="card-body">

        <form action="{{ route('teacher.attendances.update', $attendance->id) }}"
              method="POST">

            @csrf
            @method('PUT')

            <div class="mb-3">

                <label>Status</label>

                <select name="status"
                        class="form-control">

                    <option value="hadir"
                        {{ $attendance->status == 'hadir' ? 'selected' : '' }}>

                        Hadir

                    </option>

                    <option value="izin"
                        {{ $attendance->status == 'izin' ? 'selected' : '' }}>

                        Izin

                    </option>

                    <option value="sakit"
                        {{ $attendance->status == 'sakit' ? 'selected' : '' }}>

                        Sakit

                    </option>

                    <option value="alpha"
                        {{ $attendance->status == 'alpha' ? 'selected' : '' }}>

                        Alpha

                    </option>

                </select>

            </div>

            <button class="btn btn-primary">
                Update
            </button>

        </form>

    </div>

</div>

@endsection