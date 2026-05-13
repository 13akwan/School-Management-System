@extends('layouts.admin')

@section('content')

<h1 class="h3 mb-4 text-gray-800">
    Edit Subject
</h1>

<div class="card shadow">

    <div class="card-body">

        <form action="{{ route('admin.subjects.update', $subject->id) }}"
              method="POST">

            @csrf
            @method('PUT')

            <div class="mb-3">

                <label>Subject Name</label>

                <input type="text"
                       name="name"
                       class="form-control"
                       value="{{ old('name', $subject->name) }}"
                       required>

            </div>

            <button class="btn btn-primary">

                Update

            </button>

            <a href="{{ route('admin.subjects.index') }}"
               class="btn btn-secondary">

                Back

            </a>

        </form>

    </div>

</div>

@endsection