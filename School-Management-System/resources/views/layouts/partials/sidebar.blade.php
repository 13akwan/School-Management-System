<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion">

    <a class="sidebar-brand d-flex align-items-center justify-content-center">
        <div class="sidebar-brand-text">SMS</div>
    </a>

    <hr class="sidebar-divider">

    <li class="nav-item">
        <a class="nav-link" href="/dashboard">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    {{-- ADMIN --}}
    @if(auth()->user()->role == 'admin')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('students.index') }}">
                <i class="fas fa-users"></i>
                <span>Students</span>
            </a>
        </li>
    @endif

    {{-- TEACHER --}}
    @if(auth()->user()->role == 'teacher')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('tasks.index') }}">
                <i class="fas fa-book"></i>
                <span>Tasks</span>
            </a>
        </li>
    @endif

    {{-- STUDENT --}}
    @if(auth()->user()->role == 'student')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('submissions.index') }}">
                <i class="fas fa-upload"></i>
                <span>My Submissions</span>
            </a>
        </li>
    @endif

</ul>