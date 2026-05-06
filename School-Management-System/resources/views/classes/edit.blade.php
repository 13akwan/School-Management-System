@extends('layouts.admin')

@section('content')

<h1>Edit Class</h1>

<form action="{{ route('classes.update', $class->id) }}" method="POST">
    @csrf
    @method('PUT')

    <input type="text" name="name" value="{{ $class->name }}">

    <button type="submit">Update</button>
</form>

@endsection