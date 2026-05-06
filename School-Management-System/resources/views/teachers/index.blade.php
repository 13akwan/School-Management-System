@extends('layouts.admin')

@section('content')
    
    <h1>Teachers</h1>

    @foreach ($teachers as $teacher)
        <p>{{ $teacher->name }} - {{ $teacher->email }}

        <a href="{{ route('teachers.create') }}">Tambah</a>

        <a href="{{ route('teachers.edit', $teacher->id) }}">Edit</a>               

        <form action="{{ route('teachers.destroy', $teacher->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
        </form>
    </p>
    @endforeach

@endsection