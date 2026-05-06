@extends('layouts.admin')

@section('content')

<h1>Give Grade</h1>

<a href="{{ route('grades.index') }}">Back</a>

<form action="{{ route('grades.store') }}" method="POST">
    @csrf

    <select name="submission_id">
        <option value="">-- Select Submission --</option>
        @foreach ($submissions as $s)
            <option value="{{ $s->id }}">
                {{ $s->student->name }} -
                {{ $s->task->title ?? '-' }}
            </option>
        @endforeach
    </select>

    <input type="number" name="score" placeholder="Score (0-100)">

    <button type="submit">Save</button>
</form>

@endsection