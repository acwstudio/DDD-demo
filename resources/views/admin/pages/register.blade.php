@extends('admin.layouts.master')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Register Admin</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Register Admin</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <!-- left column -->
                <div class="col-md-6">
                    <!-- Horizontal Form -->
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Regiser Admin</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" action="{{ route('admin.register') }}" class="form-horizontal">
                            @csrf
                            <div class="card-body">
                                <!-- Name field -->
                                <div class="form-group row">
                                    <label for="name" class="col-sm-3 col-form-label">Name</label>
                                    <div class="col-sm-9">
                                        <input id="name" type="text" class="form-control @error('name')
                                            is-invalid @enderror" name="name" value="{{ old('name') }}"
                                               required autocomplete="name" placeholder="Name" autofocus>
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- Email field -->
                                <div class="form-group row">
                                    <label for="email" class="col-sm-3 col-form-label">Email</label>
                                    <div class="col-sm-9">
                                        <input id="email" type="email" class="form-control @error('email')
                                            is-invalid @enderror" name="email" value="{{ old('email') }}"
                                               required autocomplete="name" placeholder="Email">
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- Role field -->
                                <div class="form-group row">
                                    <label for="role" class="col-sm-3 col-form-label">Role</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" id="role" name="role">
                                            <option value="" disabled selected>Select Role</option>
                                            @foreach($viewModel as $role)
                                                <option value="{{ $role->name }}"
                                                    {{ old('role') == $role->name ? 'selected' : '' }}>
                                                    {{ $role->name }}</option>
                                            @endforeach
{{--                                            @foreach($viewModel->roles as $role)--}}
{{--                                                <option value="{{ $role->name }}"--}}
{{--                                                    {{ old('role') == $role->name ? 'selected' : '' }}>--}}
{{--                                                    {{ $role->name }}</option>--}}
{{--                                            @endforeach--}}
                                        </select>
                                    </div>
                                </div>
                                <!-- Password field -->
                                <div class="form-group row">
                                    <label for="password" class="col-sm-3 col-form-label">Password</label>
                                    <div class="col-sm-9">
                                        <input id="password" type="password" class="form-control
                                               @error('password') is-invalid @enderror" name="password"
                                               required autocomplete="new-password" placeholder="Password">
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- Confirm Password field -->
                                <div class="form-group row">
                                    <label for="password-confirm" class="col-sm-3 col-form-label">
                                        Confirm Password</label>

                                    <div class="col-sm-9">
                                        <input id="password-confirm" type="password" class="form-control"
                                               name="password_confirmation" required autocomplete="new-password"
                                               placeholder="Confirm Password">
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-info">Sign in</button>
                                <a href="#" type="button"
                                   class="btn btn-default float-right">Cancel</a>
                            </div>
                            <!-- /.card-footer -->
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
@endsection
