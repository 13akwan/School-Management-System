@extends('layouts.admin')

@section('title', 'Dashboard')

@section('breadcrumbs')

<li class="breadcrumb-item active">
    Tasks
</li>

@endsection

@section('content')

<div class="mb-3">
    <a href="{{ route('teacher.tasks.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Tambah Task
    </a>
</div>

<form method="GET" class="mb-3 d-flex">

    <select name="class_id" class="form-control mr-2">
        <option value="">-- Semua Kelas --</option>

        @foreach($classes as $class)
            <option value="{{ $class->id }}" 
                {{ request('class_id') == $class->id ? 'selected' : '' }}>
                {{ $class->name }}
            </option>
        @endforeach
    </select>

    <button class="btn btn-primary">Filter</button>
</form>

<div class="row">

@foreach($tasks as $task)
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card shadow h-100">

            <div class="card-body">

                {{-- Judul --}}
                <h5 class="font-weight-bold text-primary">
                    {{ $task->title }}
                </h5>

                <hr>

                {{-- Subject --}}
                <p class="mb-1">
                    <strong>Subject:</strong> 
                    {{ $task->teaching->subject->name ?? '-' }}
                </p>

                {{-- Teacher --}}
                <p class="mb-1">
                    <strong>Teacher:</strong> 
                    {{ $task->teaching->teacher->name ?? '-' }}
                </p>

                {{-- Class --}}
                <p class="mb-1">
                    <strong>Class:</strong> 
                    {{ $task->teaching->class->name ?? '-' }}
                </p>

                {{-- TYPE --}}
                <p class="mb-1">
                    <strong>Type:</strong> 
                    <span class="badge badge-info">
                        {{ $task->type ?? '-' }}
                    </span>
                </p>

                {{-- DESCRIPTION --}}
                @if($task->description)
                    <hr>
                    <div class="small text-gray-700">
                        {!! $task->description !!}
                    </div>

                @endif

                {{-- DEADLINE --}}
                @if($task->due_date)
                    <p class="mb-0 text-danger">
                        Deadline: {{ $task->due_date }}
                    </p>
                @endif

                <div class="mt-3 d-flex justify-content-between">

                {{-- EDIT --}}
                <a href="{{ route('teacher.tasks.edit', $task->id) }}" 
                class="btn btn-sm btn-warning">
                    Edit
                </a>

                {{-- DELETE --}}
                <form action="{{ route('teacher.tasks.destroy', $task->id) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-sm btn-danger"
                        onclick="return confirm('Yakin mau hapus?')">
                        Hapus
                    </button>
                </form>

            </div>

            </div>

        </div>
    </div>
@endforeach

</div>

@endsection