@extends('layouts.admin')

@section('content')
    
    <h1>Edit Teacher</h1>

    <form action="{{ route('teachers.update', $teacher->id) }}" method="POST">
        @csrf
        @method('PUT')

        <input type="text" name="name" value="{{ $teacher->name }}">
        <input type="email" name="email" value="{{ $teacher->email }}">
   
        <button type="submit">Update</button>
    </form>

@endsection