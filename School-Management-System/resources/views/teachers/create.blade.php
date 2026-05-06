@extends('layouts.admin')

@section('content')
    
    <h1>Create Teacher</h1>

    <form action="{{ route('teachers.store') }}" method="POST">
        @csrf

        <input type="text" name="name" placeholder="Name">
        <input type="email" name="email" placeholder="Email">
        <input type="password" name="password" placeholder="Password">

        <button type="submit">Save</button>
    </form>

@endsection