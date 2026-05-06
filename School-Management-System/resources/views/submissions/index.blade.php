@extends('layouts.admin')

@section('content')

<h1>Submissions</h1>

<a href="{{ route('submissions.create') }}">Submit Task</a>

@foreach ($submissions as $s)
    <p>
        {{ $s->student->name }} |
        {{ $s->task->title ?? '-' }} |
        {{ $s->task->teaching->subject->name ?? '-' }}

        <form action="{{ route('submissions.destroy', $s->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
        </form>
    </p>
@endforeach

@endsection