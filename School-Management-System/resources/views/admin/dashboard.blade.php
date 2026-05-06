@extends('layouts.admin')

@section('content')
    
    <h1>Admin Dashboard</h1>
    
    <p>Students: {{ $countStudents }}</p>
    <p>Teachers: {{ $countTeachers }}</p>
    <p>Classes: {{ $countClasses }}</p>
    <p>Subjects: {{ $countSubjects }}</p>

@endsection