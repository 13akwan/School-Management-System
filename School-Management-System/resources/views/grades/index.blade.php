@extends('layouts.admin')

@section('content')

<h1>Grades</h1>

<a href="{{ route('grades.create') }}">Beri Nilai</a>

@foreach ($grades as $g)
    <p>
        {{ $g->student->name }} |
        {{ $g->task->title ?? '-' }} |
        Score: {{ $g->score }}

        <form action="{{ route('grades.destroy', $g->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
        </form>
    </p>
@endforeach

@endsection