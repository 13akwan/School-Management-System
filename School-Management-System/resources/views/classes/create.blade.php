@extends('layouts.admin')

@section('content')

<h1>Create Class</h1>

<form action="{{ route('classes.store') }}" method="POST">
    @csrf

    <input type="text" name="name" placeholder="Class Name">

    <button type="submit">Save</button>
</form>

@endsection