@extends('layouts.admin')

@section('content')

<h1>Input Attendance</h1>

<a href="{{ route('attendances.index') }}">Back</a>

<form action="{{ route('attendances.store') }}" method="POST">
    @csrf

    <select name="teaching_id">
        @foreach ($teachings as $t)
            <option value="{{ $t->id }}">
                {{ $t->subject->name }} - {{ $t->class->name }}
            </option>
        @endforeach
    </select>

    <select name="student_id">
        @foreach ($students as $s)
            <option value="{{ $s->id }}">{{ $s->name }}</option>
        @endforeach
    </select>

    <input type="date" name="date">

    <select name="status">
        <option value="hadir">Hadir</option>
        <option value="izin">Izin</option>
        <option value="sakit">Sakit</option>
        <option value="alpha">Alpha</option>
    </select>

    <button type="submit">Save</button>
</form>
@endsection