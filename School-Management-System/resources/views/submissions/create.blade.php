@extends('layouts.admin')

@section('content')

<h1 class="h3 mb-4 text-gray-800">Submit Task</h1>

<div class="card shadow">

    <div class="card-header">
        <h6 class="m-0 font-weight-bold text-primary">
            Form Submission
        </h6>
    </div>

    <div class="card-body p-4">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

            <form action="{{ route('student.submissions.store') }}"
                method="POST"
                enctype="multipart/form-data">

            @csrf

            {{-- TASK --}}
            <div class="form-group">
                <label class="font-weight-bold">Task</label>

                <select name="task_id"
                    id="taskSelect"
                    class="form-control">

                    <option value="">-- Pilih Task --</option>

                    @foreach ($tasks as $task)
                        <option value="{{ $task->id }}"
                            data-type="{{ $task->type}}"
                            data-description="{{ strip_tags($task->description) }}"
                            data-deadline="{{ $task->due_date }}">

                            {{ $task->title }}
                            -
                            {{ $task->teaching->subject->name ?? '-' }}
                            -
                            {{ $task->teaching->class->name ?? '-' }}

                        </option>
                    @endforeach

                </select>
            </div>

            {{-- DESCRIPTION --}}
            <div id="taskDetail"
                class="alert alert-info mt-4 mb-4 d-none">

                <h6 class="font-weight-bold">
                    Deskripsi Task
                </h6>

                <p id="taskDescription" class="mb-2"></p>

                <small class="text-danger">
                    Deadline:
                    <span id="taskDeadline">-</span>
                </small>

            </div>

            {{-- ORAL --}}
            <div id="oralAlert"
                class="alert alert-warning mb-4 d-none">

                Task ini bertipe <strong>Oral/Lisan</strong>.

                Submission text dan upload file dinonaktifkan karena penilaian dilakukan langsung oleh guru.

            </div>

            {{-- CONTENT --}}
            <div class="form-group mt-4">
                <label class="font-weight-bold">Jawaban / Content</label>

                <textarea name="content"
                    id="contentField"
                    rows="5"
                    class="form-control ckeditor"
                    placeholder="Masukkan jawaban tugas..."></textarea>
                
                <div class="form-group mt-4">
                    <label class="font-weight-bold">
                        Upload File
                    </label>

                    <input type="file"
                        id="fileField"
                        name="file"
                        class="form-control">

                    <small class="text-muted">
                        PDF, DOCX, ZIP, JPG, PNG (Max 5MB)
                    </small>
                </div>
            </div>

            {{-- BUTTON --}}
            <div class="d-flex justify-content-between mt-5 pt-2">

                <a href="{{ route('student.submissions.index') }}"
                   class="btn btn-secondary">
                    ← Kembali
                </a>

                <button type="submit" class="btn btn-primary">
                    Submit
                </button>

            </div>

        </form>

    </div>

</div>

<script>

    const taskSelect = document.getElementById('taskSelect');

    const taskDetail = document.getElementById('taskDetail');

    const taskDescription = document.getElementById('taskDescription');

    const taskDeadline = document.getElementById('taskDeadline');

    const contentField = document.getElementById('contentField');

    const fileField = document.getElementById('fileField');

    const oralAlert = document.getElementById('oralAlert');

    taskSelect.addEventListener('change', function(){

        const selected = this.options[this.selectedIndex];

        const description = selected.dataset.description;

        const deadline = selected.dataset.deadline;

        const type = selected.dataset.type;

        if(description){

            taskDetail.classList.remove('d-none');

            taskDescription.innerHTML = description;

            taskDeadline.innerHTML = deadline ?? '-';

        }else{

            taskDetail.classList.add('d-none');

        }

        // ORAL TASK
        if(type === 'oral'){

            contentField.disabled = true;

            fileField.disabled = true;

            oralAlert.classList.remove('d-none');

        }else{

            contentField.disabled = false;

            fileField.disabled = false;

            oralAlert.classList.add('d-none');

        }

    });

</script>

@endsection