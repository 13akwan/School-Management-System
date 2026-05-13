@extends('layouts.admin')

@section('content')

<h1 class="h3 mb-4 text-gray-800">
    Create Class
</h1>

<div class="card shadow">

    <div class="card-body">

        <form action="{{ route('admin.classes.store') }}"
              method="POST">

            @csrf

            <div class="mb-3">

                <label>Class Name</label>

                <input type="text"
                       name="name"
                       class="form-control"
                       required>

            </div>

            <button class="btn btn-primary">
                Save
            </button>

            <a href="{{ route('admin.classes.index') }}"
               class="btn btn-secondary">

                Back

            </a>

        </form>

    </div>

</div>

@endsection