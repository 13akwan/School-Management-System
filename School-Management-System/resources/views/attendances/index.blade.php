@extends('layouts.admin')

@section('content')

<h1>Attendance</h1>

<a href="{{ route('attendances.create') }}">Input Absensi</a>

@foreach ($attendances as $a)
    <p>
        {{ $a->student->name }} |
        {{ $a->teaching->subject->name ?? '-' }} |
        {{ $a->date }} |
        {{ $a->status }}

        <form action="{{ route('attendances.destroy', $a->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
        </form>
    </p>
@endforeach

@endsection