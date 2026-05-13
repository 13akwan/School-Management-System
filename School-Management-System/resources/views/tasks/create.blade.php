@extends('layouts.admin')

@section('content')

<h1 class="h3 mb-4 text-gray-800">Tambah Task</h1>

<div class="card shadow">
    <div class="card-header">
        <h6 class="m-0 font-weight-bold text-primary">Form Tambah Task</h6>
    </div>

    <div class="card-body">

        <form action="{{ route('teacher.tasks.store') }}" method="POST">
            @csrf

            {{-- TEACHING --}}
            <div class="form-group">
                <label class="font-weight-bold">Teaching</label>

                <select name="teaching_id" 
                    class="form-control @error('teaching_id') is-invalid @enderror">

                    <option value="">-- Pilih Teaching --</option>

                    @foreach ($teachings as $teaching)
                        <option value="{{ $teaching->id }}">
                            {{ $teaching->teacher->name }} -
                            {{ $teaching->subject->name }} -
                            {{ $teaching->class->name }}
                        </option>
                    @endforeach
                </select>

                @error('teaching_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- TITLE --}}
            <div class="form-group">
                <label class="font-weight-bold">Judul Task</label>
                <input type="text" name="title" 
                    value="{{ old('title') }}"
                    class="form-control @error('title') is-invalid @enderror"
                    placeholder="Masukkan judul task">

                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- DESCRIPTION --}}
            <div class="form-group">
                <label class="font-weight-bold">
                    Description
                </label>

                <textarea name="description"
                        class="form-control ckeditor"
                        rows="5"></textarea>
            </div>

            {{-- TYPE --}}
            <div class="form-group">
                <label class="font-weight-bold">Tipe</label>
                <select name="type" class="form-control">
                    <option value="assignment">Assignment</option>
                    <option value="oral">Oral</option>
                </select>
            </div>

            {{-- DEADLINE --}}
            <div class="form-group">
                <label class="font-weight-bold">Deadline</label>
                <input type="date" name="due_date" class="form-control">
            </div>

            {{-- BUTTON --}}
            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('teacher.tasks.index') }}" class="btn btn-secondary">
                    ← Kembali
                </a>

                <button type="submit" class="btn btn-primary">
                    Simpan Task
                </button>
            </div>

        </form>

    </div>
</div>

@endsection