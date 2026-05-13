@extends('layouts.admin')

@section('title', 'Profile')

@section('breadcrumbs')

<li class="breadcrumb-item active">
    Profile
</li>

@endsection

@section('content')

@if(session('success'))

<div class="alert alert-success">
    {{ session('success') }}
</div>

@endif

<div class="row">

    {{-- PROFILE --}}
    <div class="col-lg-5">

        <div class="card shadow mb-4">

            <div class="card-header py-3">

                <h6 class="m-0 font-weight-bold text-primary">
                    Profile Information
                </h6>

            </div>

            <div class="card-body text-center">

                @if(auth()->user()->photo)

                    <img src="{{ asset('storage/' . auth()->user()->photo) }}"
                         width="120"
                         height="120"
                         class="rounded-circle mb-3"
                         style="object-fit: cover;">

                @else

                    <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}"
                         class="rounded-circle mb-3">

                @endif

                <form method="POST"
                      action="{{ route('profile.update') }}"
                      enctype="multipart/form-data">

                    @csrf

                    <div class="form-group text-left">

                        <label>Name</label>

                        <input type="text"
                               name="name"
                               class="form-control"
                               value="{{ auth()->user()->name }}">

                    </div>

                    <div class="form-group text-left">

                        <label>Photo</label>

                        <input type="file"
                               name="photo"
                               class="form-control">

                    </div>

                    <button class="btn btn-primary">
                        Update Profile
                    </button>

                </form>

            </div>

        </div>

    </div>

    {{-- PASSWORD --}}
    <div class="col-lg-7">

        <div class="card shadow">

            <div class="card-header py-3">

                <h6 class="m-0 font-weight-bold text-primary">
                    Change Password
                </h6>

            </div>

            <div class="card-body">

                <form method="POST"
                      action="{{ route('profile.password') }}">

                    @csrf

                    <div class="form-group">

                        <label>Current Password</label>

                        <input type="password"
                               name="current_password"
                               class="form-control">

                    </div>

                    <div class="form-group">

                        <label>New Password</label>

                        <input type="password"
                               name="new_password"
                               class="form-control">

                    </div>

                    <div class="form-group">

                        <label>Confirm Password</label>

                        <input type="password"
                               name="new_password_confirmation"
                               class="form-control">

                    </div>

                    <button class="btn btn-primary">
                        Change Password
                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection