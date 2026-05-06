@extends('layouts.admin')

@section('content')

<h1>Classes</h1>

<a href="{{ route('classes.create') }}">Tambah</a>

@foreach ($classes as $class)
<p>
    {{ $class->name }}

    <a href="{{ route ('classes.edit', $class->id) }}">Edit</a>

    <form action="{{ route ('classes.destroy', $class->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit">Delete</button>
    </form>
</p>
@endforeach

@endsection