@extends('layouts.admin')

@section('title', 'Dashboard')

@section('breadcrumbs')

<li class="breadcrumb-item active">
    Subjects
</li>

@endsection

@section('content')

<div class="d-flex justify-content-between mb-3">

    <a href="{{ route('admin.subjects.create') }}"
       class="btn btn-primary">

        <i class="fas fa-plus"></i>
        Tambah Subject

    </a>

</div>

@if(session('success'))

<div class="alert alert-success">
    {{ session('success') }}
</div>

@endif

<div class="card shadow mb-4">

    <div class="card-body">

        <form method="GET">

            <div class="row">

                <div class="col-md-4 mb-3">

                    <input type="text"
                           name="search"
                           class="form-control"
                           placeholder="Search subject..."
                           value="{{ request('search') }}">

                </div>

                <div class="col-md-3 mb-3">

                    <button class="btn btn-primary">
                        Search
                    </button>

                    <a href="{{ route('admin.subjects.index') }}"
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
            Subject List
        </h6>

    </div>

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-bordered">

                <thead>

                    <tr>

                        <th>No</th>
                        <th>Subject Name</th>
                        <th width="180">Action</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($subjects as $subject)

                    <tr>

                        <td>
                            {{ $loop->iteration + ($subjects->currentPage() - 1) * $subjects->perPage() }}
                        </td>

                        <td>
                            {{ $subject->name }}
                        </td>

                        <td>

                            <a href="{{ route('admin.subjects.edit', $subject->id) }}"
                               class="btn btn-warning btn-sm">

                                Edit

                            </a>

                            <form action="{{ route('admin.subjects.destroy', $subject->id) }}"
                                  method="POST"
                                  class="d-inline">

                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin hapus subject?')">

                                    Delete

                                </button>

                            </form>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="3"
                            class="text-center">

                            No subjects found

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="mt-3">

            {{ $subjects->withQueryString()->links() }}

        </div>

    </div>

</div>

@endsection