@extends('layouts.admin')

@section('content')

<h1>Subjects</h1>

<a href="{{ route('subjects.create') }}">Tambah</a>

@foreach ($subjects as $subject)
<p>
    {{ $subject->name }}

    <a href="{{ route ('subjects.edit', $subject->id) }}">Edit</a>

    <form action="{{ route ('subjects.destroy', $subject->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit">Delete</button>
    </form>
</p>
@endforeach

@endsection