<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <title>
        School Management System
    </title>

    <link href="{{ asset('sbadmin/vendor/fontawesome-free/css/all.min.css') }}"
          rel="stylesheet">

    <link href="{{ asset('sbadmin/css/sb-admin-2.min.css') }}"
          rel="stylesheet">

</head>

<body id="page-top">

<div id="wrapper">

    @include('layouts.partials.sidebar')

    <div id="content-wrapper"
         class="d-flex flex-column">

        <div id="content">

            @include('layouts.partials.navbar')

            <div class="container-fluid">

                {{-- Page Title --}}
                <h1 class="h3 mb-2 text-gray-800">
                    @yield('title')
                </h1>

                {{-- Breadcrumb --}}
                <nav aria-label="breadcrumb">

                    <ol class="breadcrumb mb-4">

                        @if(auth()->user()->role == 'admin')
                        <li class="breadcrumb-item">

                            <a href="{{ route('admin.dashboard') }}">
                                Dashboard
                            </a>

                        </li>
                        @endif

                        @if(auth()->user()->role == 'teacher')
                        <li class="breadcrumb-item">

                            <a href="{{ route('teacher.dashboard') }}">
                                Dashboard
                            </a>

                        </li>
                        @endif

                        @if(auth()->user()->role == 'student')
                        <li class="breadcrumb-item">

                            <a href="{{ route('student.dashboard') }}">
                                Dashboard
                            </a>

                        </li>
                        @endif

                        @yield('breadcrumbs')

                    </ol>

                </nav>

                {{-- Content --}}
                @yield('content')

            </div>

        </div>

        @include('layouts.partials.footer')

    </div>

</div>

<script src="{{ asset('sbadmin/vendor/jquery/jquery.min.js') }}"></script>

<script src="{{ asset('sbadmin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<script src="{{ asset('sbadmin/js/sb-admin-2.min.js') }}"></script>

<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

<script>

    ClassicEditor
        .create(document.querySelector('.ckeditor'))
        .then(editor => {

            editor.editing.view.change(writer => {

                writer.setStyle(
                    'height',
                    '300px',
                    editor.editing.view.document.getRoot()
                );

            });

        })
        .catch(error => {
            console.error(error);
        });

</script>

</body>

</html>