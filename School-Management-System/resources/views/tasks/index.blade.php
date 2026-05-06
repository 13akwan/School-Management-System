@extends('layouts.admin')

@section('content')

<h1>Tasks</h1>

<a href="{{ route('tasks.create') }}">Tambah Task</a>

@foreach ($tasks as $t)
    <p>
        {{ $t->title ?? '-' }} |
        {{ $t->teaching->teacher->name ?? '-' }} |
        {{ $t->teaching->subject->name ?? '-' }} |
        {{ $t->teaching->class->name ?? '-' }}

        <form action="{{ route('tasks.destroy', $t->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
        </form>
    </p>
@endforeach

@endsection