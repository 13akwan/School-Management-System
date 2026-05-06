@extends('layouts.admin')

@section('content')

<h1>Teachings</h1>

<a href="{{ route('teachings.create') }}">Tambah Teaching</a>

@foreach ($teachings as $t)
    <p>
        {{ $t->teacher->name }} |
        {{ $t->subject->name }} |
        {{ $t->class->name }}

        <form action="{{ route('teachings.destroy', $t->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
        </form>
    </p>
@endforeach

@endsection