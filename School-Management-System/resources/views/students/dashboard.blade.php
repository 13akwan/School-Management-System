@extends('layouts.admin')

@section('title', 'Student Dashboard')

@section('breadcrumbs')

<li class="breadcrumb-item active">
    Student Dashboard
</li>

@endsection

@section('content')

<div class="row">

    <div class="col-xl-3 col-md-6 mb-4">

        <div class="card border-left-primary shadow h-100 py-2">

            <div class="card-body">

                <div class="row no-gutters align-items-center">

                    <div class="col mr-2">

                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Tasks
                        </div>

                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ $totalTasks }}
                        </div>

                    </div>

                    <div class="col-auto">
                        <i class="fas fa-tasks fa-2x text-gray-300"></i>
                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="col-xl-3 col-md-6 mb-4">

        <div class="card border-left-success shadow h-100 py-2">

            <div class="card-body">

                <div class="row no-gutters align-items-center">

                    <div class="col mr-2">

                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Total Submissions
                        </div>

                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ $totalSubmissions }}
                        </div>

                    </div>

                    <div class="col-auto">
                        <i class="fas fa-file-upload fa-2x text-gray-300"></i>
                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="col-xl-3 col-md-6 mb-4">

        <div class="card border-left-warning shadow h-100 py-2">

            <div class="card-body">

                <div class="row no-gutters align-items-center">

                    <div class="col mr-2">

                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Total Attendance
                        </div>

                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ $totalAttendances }}
                        </div>

                    </div>

                    <div class="col-auto">
                        <i class="fas fa-calendar-check fa-2x text-gray-300"></i>
                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="col-xl-3 col-md-6 mb-4">

        <div class="card border-left-danger shadow h-100 py-2">

            <div class="card-body">

                <div class="row no-gutters align-items-center">

                    <div class="col mr-2">

                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                            Average Score
                        </div>

                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ number_format($averageScore ?? 0, 1) }}
                        </div>

                    </div>

                    <div class="col-auto">
                        <i class="fas fa-star fa-2x text-gray-300"></i>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<div class="row">

    <div class="col-lg-5 mb-4">

        <div class="card shadow">

            <div class="card-header py-3">

                <h6 class="m-0 font-weight-bold text-primary">
                    Attendance Statistics
                </h6>

            </div>

            <div class="card-body">

                <canvas id="attendanceChart"></canvas>

            </div>

        </div>

    </div>

    <div class="col-lg-7 mb-4">

        <div class="card shadow">

            <div class="card-header py-3">

                <h6 class="m-0 font-weight-bold text-primary">
                    Latest Tasks
                </h6>

            </div>

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-bordered">

                        <thead>

                            <tr>

                                <th>Title</th>
                                <th>Subject</th>
                                <th>Teacher</th>
                                <th>Due Date</th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($latestTasks as $task)

                            <tr>

                                <td>
                                    {{ $task->title }}
                                </td>

                                <td>
                                    {{ $task->teaching->subject->name ?? '-' }}
                                </td>

                                <td>
                                    {{ $task->teaching->teacher->name ?? '-' }}
                                </td>

                                <td>
                                    {{ $task->due_date }}
                                </td>

                            </tr>

                            @empty

                            <tr>

                                <td colspan="4" class="text-center">
                                    No tasks found
                                </td>

                            </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const ctx = document.getElementById('attendanceChart');

new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: [
            'Hadir',
            'Izin',
            'Sakit',
            'Alpha'
        ],
        datasets: [{
            data: [
                {{ $attendanceChart['hadir'] }},
                {{ $attendanceChart['izin'] }},
                {{ $attendanceChart['sakit'] }},
                {{ $attendanceChart['alpha'] }}
            ],
            backgroundColor: [
                '#1cc88a',
                '#36b9cc',
                '#f6c23e',
                '#e74a3b'
            ]
        }]
    }
});

</script>

@endsection