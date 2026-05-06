@extends('layouts.admin')

@section('content')

<h1>Create Task</h1>

<a href="{{ route('tasks.index') }}">Back</a>

<form action="{{ route('tasks.store') }}" method="POST">
    @csrf

    <select name="teaching_id">
        <option value="">-- Pilih Teaching --</option>

        @foreach ($teachings as $teaching)
            <option value="{{ $teaching->id }}">
                {{ $teaching->teacher->name }} -
                {{ $teaching->subject->name }} -
                {{ $teaching->class->name }}
            </option>
        @endforeach
    </select>

    <input type="text" name="title" placeholder="Task Title">
    
    <select name="type">
        <option value="assignment">Assignment</option>
        <option value="oral">Oral</option>
    </select>

    <button type="submit">Save</button>
</form>

@endsection