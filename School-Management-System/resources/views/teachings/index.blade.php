@extends('layouts.admin')

@section('title', 'Dashboard')

@section('breadcrumbs')

<li class="breadcrumb-item active">
    Teachings
</li>

@endsection

@section('content')

<div class="d-flex justify-content-between mb-3">

    <a href="{{ route('admin.teachings.create') }}"
       class="btn btn-primary">

        <i class="fas fa-plus"></i>
        Tambah Teaching

    </a>

</div>

@if(session('success'))

<div class="alert alert-success">
    {{ session('success') }}
</div>

@endif

@if($errors->has('duplicate'))

<div class="alert alert-danger">
    {{ $errors->first('duplicate') }}
</div>

@endif

<div class="card shadow mb-4">

    <div class="card-body">

        <form method="GET">

            <div class="row">

                <div class="col-md-3 mb-3">

                    <input type="text"
                           name="search"
                           class="form-control"
                           placeholder="Search..."
                           value="{{ request('search') }}">

                </div>

                <div class="col-md-2 mb-3">

                    <select name="teacher_id"
                            class="form-control">

                        <option value="">All Teachers</option>

                        @foreach($teachers as $teacher)

                        <option value="{{ $teacher->id }}"
                            {{ request('teacher_id') == $teacher->id ? 'selected' : '' }}>

                            {{ $teacher->name }}

                        </option>

                        @endforeach

                    </select>

                </div>

                <div class="col-md-2 mb-3">

                    <select name="subject_id"
                            class="form-control">

                        <option value="">All Subjects</option>

                        @foreach($subjects as $subject)

                        <option value="{{ $subject->id }}"
                            {{ request('subject_id') == $subject->id ? 'selected' : '' }}>

                            {{ $subject->name }}

                        </option>

                        @endforeach

                    </select>

                </div>

                <div class="col-md-2 mb-3">

                    <select name="class_id"
                            class="form-control">

                        <option value="">All Classes</option>

                        @foreach($classes as $class)

                        <option value="{{ $class->id }}"
                            {{ request('class_id') == $class->id ? 'selected' : '' }}>

                            {{ $class->name }}

                        </option>

                        @endforeach

                    </select>

                </div>

                <div class="col-md-3 mb-3">

                    <button class="btn btn-primary">
                        Filter
                    </button>

                    <a href="{{ route('admin.teachings.index') }}"
                       class="btn btn-secondary">

                        Reset

                    </a>

                </div>

            </div>

        </form>

    </div>

</div>

<div class="card shadow">

    <div class="card-header py-3">

        <h6 class="m-0 font-weight-bold text-primary">
            Teaching List
        </h6>

    </div>

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-bordered">

                <thead>

                    <tr>

                        <th>No</th>
                        <th>Teacher</th>
                        <th>Subject</th>
                        <th>Class</th>
                        <th width="180">Action</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($teachings as $teaching)

                    <tr>

                        <td>
                            {{ $loop->iteration + ($teachings->currentPage() - 1) * $teachings->perPage() }}
                        </td>

                        <td>
                            {{ $teaching->teacher->name ?? '-' }}
                        </td>

                        <td>
                            {{ $teaching->subject->name ?? '-' }}
                        </td>

                        <td>
                            {{ $teaching->class->name ?? '-' }}
                        </td>

                        <td>

                            <a href="{{ route('admin.teachings.edit', $teaching->id) }}"
                               class="btn btn-warning btn-sm">

                                Edit

                            </a>

                            <form action="{{ route('admin.teachings.destroy', $teaching->id) }}"
                                  method="POST"
                                  class="d-inline">

                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin hapus teaching?')">

                                    Delete

                                </button>

                            </form>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="5"
                            class="text-center">

                            No teachings found

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="mt-3">

            {{ $teachings->withQueryString()->links() }}

        </div>

    </div>

</div>

@endsection