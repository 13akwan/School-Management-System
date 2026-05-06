@extends('layouts.admin')

@section('content')
    
    <h1>Edit Student</h1>

    <form action="{{ route('students.update', $student->id) }}" method="POST">
        @csrf
        @method('PUT')

        <input type="text" name="name" value="{{ $student->name }}">
        <input type="email" name="email" value="{{ $student->email }}">
       <select name="class_id">
            @foreach($classes as $class)
                <option value="{{ $class->id }}"
                    {{ $student->class_id == $class->id ? 'selected' : '' }}>
                    {{ $class->name }}
                </option>
            @endforeach
        </select>
   
        <button type="submit">Update</button>
    </form>

@endsection