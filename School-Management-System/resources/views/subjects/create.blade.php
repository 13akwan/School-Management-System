@extends('layouts.admin')

@section('content')

<h1>Create Subject</h1>

<form action="{{ route('subjects.store') }}" method="POST">
    @csrf

    <input type="text" name="name" placeholder="Subject Name">

    <button type="submit">Save</button>
</form>

@endsection