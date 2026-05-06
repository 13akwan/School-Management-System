@extends('layouts.admin')

@section('content')

<h1>Create Teaching</h1>

<a href="{{ route('teachings.index') }}">Back</a>

<form action="{{ route('teachings.store') }}" method="POST">
    @csrf

    <select name="teacher_id">
        <option value="">-- Teacher --</option>
        @foreach ($teachers as $teacher)
            <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
        @endforeach
    </select>

    <select name="subject_id">
        <option value="">-- Subject --</option>
        @foreach ($subjects as $subject)
            <option value="{{ $subject->id }}">{{ $subject->name }}</option>
        @endforeach
    </select>

    <select name="class_id">
        <option value="">-- Class --</option>
        @foreach ($classes as $class)
            <option value="{{ $class->id }}">{{ $class->name }}</option>
        @endforeach
    </select>

    <button type="submit">Save</button>
</form>

@endsection