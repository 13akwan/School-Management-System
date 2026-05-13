@extends('layouts.admin')

@section('title', 'Dashboard')

@section('breadcrumbs')

<li class="breadcrumb-item active">
    Classes
</li>

@endsection

@section('content')

<div class="d-flex justify-content-between mb-3">

    <a href="{{ route('admin.classes.create') }}"
       class="btn btn-primary">

        <i class="fas fa-plus"></i>
        Tambah Class

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
                           placeholder="Search class..."
                           value="{{ request('search') }}">

                </div>

                <div class="col-md-2 mb-3">

                    <select name="grade"
                            class="form-control">

                        <option value="">Semua Kelas</option>

                        <option value="X"
                            {{ request('grade') == 'X' ? 'selected' : '' }}>

                            Kelas 10

                        </option>

                        <option value="XI"
                            {{ request('grade') == 'XI' ? 'selected' : '' }}>

                            Kelas 11

                        </option>

                        <option value="XII"
                            {{ request('grade') == 'XII' ? 'selected' : '' }}>

                            Kelas 12

                        </option>

                    </select>

                </div>

                <div class="col-md-3 mb-3">

                    <select name="major"
                            class="form-control">

                        <option value="">Semua Jurusan</option>

                        <option value="RPL"
                            {{ request('major') == 'RPL' ? 'selected' : '' }}>

                            RPL

                        </option>

                        <option value="TKJ"
                            {{ request('major') == 'TKJ' ? 'selected' : '' }}>

                            TKJ

                        </option>

                        <option value="AKL"
                            {{ request('major') == 'AKL' ? 'selected' : '' }}>

                            AKL

                        </option>

                    </select>

                </div>

                <div class="col-md-3 mb-3">

                    <button class="btn btn-primary">
                        Filter
                    </button>

                    <a href="{{ route('admin.classes.index') }}"
                       class="btn btn-secondary">

                        Reset

                    </a>

                </div>

            </div>

        </form>

    </div>

</div>

<div class="card shadow">

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-bordered">

                <thead>

                    <tr>

                        <th>No</th>
                        <th>Name</th>
                        <th width="180">Action</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($classes as $class)

                    <tr>

                        <td>
                            {{ $loop->iteration + ($classes->currentPage() - 1) * $classes->perPage() }}
                        </td>

                        <td>
                            {{ $class->name }}
                        </td>

                        <td>

                            <a href="{{ route('admin.classes.edit', $class->id) }}"
                               class="btn btn-warning btn-sm">

                                Edit

                            </a>

                            <form action="{{ route('admin.classes.destroy', $class->id) }}"
                                  method="POST"
                                  class="d-inline">

                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin hapus class?')">

                                    Delete

                                </button>

                            </form>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="3"
                            class="text-center">

                            No classes found

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="mt-3">

            {{ $classes->withQueryString()->links() }}

        </div>

    </div>

</div>

@endsection