@extends('layouts.admin')

@section('content')

<h1>Edit Subject</h1>

<form action="{{ route('subjects.update', $subject->id) }}" method="POST">
    @csrf
    @method('PUT')

    <input type="text" name="name" value="{{ $subject->name }}">

    <button type="submit">Update</button>
</form>

@endsection