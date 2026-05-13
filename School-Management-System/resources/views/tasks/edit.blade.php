@extends('layouts.admin')

@section('content')

<h1 class="h3 mb-4 text-gray-800">Edit Task</h1>

<div class="card shadow">
    <div class="card-header">
        <h6 class="m-0 font-weight-bold text-primary">Form Edit Task</h6>
    </div>

    <div class="card-body">

        <form action="{{ route('teacher.tasks.update', $task->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- TITLE --}}
            <div class="form-group">
                <label class="font-weight-bold">Judul Task</label>
                <input type="text" name="title" value="{{ $task->title }}" 
                    class="form-control" placeholder="Masukkan judul task">
            </div>

            {{-- TEACHING INFO (READ ONLY) --}}
            <div class="form-group">
                <label class="font-weight-bold">Mata Pelajaran</label>
                <input type="text" 
                    value="{{ $task->teaching->subject->name ?? '-' }}" 
                    class="form-control" disabled>
            </div>

            <div class="form-group">
                <label class="font-weight-bold">Kelas</label>
                <input type="text" 
                    value="{{ $task->teaching->class->name ?? '-' }}" 
                    class="form-control" disabled>
            </div>

            {{-- DESCRIPTION --}}
            <div class="form-group">
                <label class="font-weight-bold">
                    Description
                </label>

                <textarea name="description"
                        class="form-control ckeditor"
                        rows="5">{!! $task->description !!}
                </textarea>           
            </div>

            {{-- TYPE --}}
            <div class="form-group">
                <label class="font-weight-bold">Type</label>

                <select name="type" class="form-control">
                    <option value="assignment" 
                        {{ $task->type == 'assignment' ? 'selected' : '' }}>
                        Assignment
                    </option>

                    <option value="oral"
                        {{ $task->type == 'oral' ? 'selected' : '' }}>
                        Oral
                    </option>
                </select>
            </div>

            {{-- DEADLINE --}}
            <div class="form-group">
                <label class="font-weight-bold">Deadline</label>
                <input type="date" name="due_date" 
                    value="{{ $task->due_date }}" 
                    class="form-control">
            </div>

            {{-- BUTTON --}}
            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('teacher.tasks.index') }}" class="btn btn-secondary">
                    ← Kembali
                </a>

                <button type="submit" class="btn btn-warning">
                    Update Task
                </button>
            </div>

        </form>

    </div>
</div>

@endsection