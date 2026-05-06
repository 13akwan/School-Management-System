@extends('layouts.admin')

@section('content')
    
    <h1>Students</h1>

    @foreach ($students as $student)
        <p>{{ $student->name }} - {{ $student->email }}

        <a href="{{ route('students.create') }}">Tambah</a>

        <a href="{{ route('students.edit', $student->id) }}">Edit</a>               

        <form action="{{ route('students.destroy', $student->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
        </form>
    </p>
    @endforeach

@endsection
