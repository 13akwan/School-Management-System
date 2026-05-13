<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion">

    <a class="sidebar-brand d-flex align-items-center justify-content-center">
        <div class="sidebar-brand-text">SMS</div>
    </a>

    <hr class="sidebar-divider">

    {{-- ADMIN --}}
    @if(auth()->user()->role == 'admin')
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>
    @endif

    {{-- TEACHER --}}
    @if(auth()->user()->role == 'teacher')
    <li class="nav-item">
        <a class="nav-link" href="{{ route('teacher.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>
    @endif

    {{-- STUDENT --}}
    @if(auth()->user()->role == 'student')
    <li class="nav-item">
        <a class="nav-link" href="{{ route('student.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>
    @endif

    {{-- ADMIN --}}
    @if(auth()->user()->role == 'admin')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.users.index') }}">
                <i class="fas fa-users"></i>
                <span>Users</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link"
            href="{{ route('admin.classes.index') }}">
                <i class="fas fa-school"></i>
                <span>Classes</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link"
            href="{{ route('admin.subjects.index') }}">
                <i class="fas fa-book"></i>
                <span>Subjects</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link"
            href="{{ route('admin.teachings.index') }}">
                <i class="fas fa-chalkboard-teacher"></i>
                <span>Teachings</span>
            </a>
        </li>

        <li class="nav-item">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="nav-link btn btn-link text-left" style="width:100%;">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </button>
            </form>
        </li>

    @endif

    {{-- TEACHER --}}
    @if(auth()->user()->role == 'teacher')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('teacher.tasks.index') }}">
                <i class="fas fa-book"></i>
                <span>Tasks</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('teacher.submissions.index') }}">
                <i class="fas fa-file-alt"></i>
                <span>Submissions</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link"
            href="{{ route('teacher.attendances.index') }}">
                <i class="fas fa-user-check"></i>
                <span>Attendances</span>
            </a>
        </li>

        <li class="nav-item">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="nav-link btn btn-link text-left" style="width:100%;">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </button>
            </form>
        </li>

    @endif

    {{-- STUDENT --}}
    @if(auth()->user()->role == 'student')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('student.submissions.index') }}">
                <i class="fas fa-upload"></i>
                <span>My Submissions</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link"
            href="{{ route('student.attendances.index') }}">
                <i class="fas fa-user-check"></i>
                <span>Attendances</span>
            </a>
        </li>

        <li class="nav-item">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="nav-link btn btn-link text-left" style="width:100%;">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </button>
            </form>
        </li>

    @endif

</ul>

