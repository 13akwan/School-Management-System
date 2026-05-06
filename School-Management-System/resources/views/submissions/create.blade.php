@extends('layouts.admin')

@section('content')

<h1>Submit Task</h1>

<a href="{{ route('submissions.index') }}">Back</a>

<form action="{{ route('submissions.store') }}" method="POST">
    @csrf

    <select name="task_id">
        <option value="">-- Select Task --</option>
        @foreach ($tasks as $task)
            <option value="{{ $task->id }}">
                {{ $task->title ?? '-' }} -
                {{ $task->teaching->subject->name ?? '-' }}
            </option>
        @endforeach
    </select>

    <textarea name="content" placeholder="Your answer"></textarea>

    <button type="submit">Submit</button>
</form>

@endsection