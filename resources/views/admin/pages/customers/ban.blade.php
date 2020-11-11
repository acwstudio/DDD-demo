@extends('admin.layouts.master')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Set Customer Ban</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Set Customer Ban</li>
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
                            <h3 class="card-title">Set Customer Ban</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" action="{{ route('customer.ban.update', $viewModel->customerItem->id) }}"
                              class="form-horizontal">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <!-- Name field -->
                                <div class="form-group row">
                                    <label for="name" class="col-sm-3 col-form-label">Name</label>
                                    <div class="col-sm-9">
                                        <input id="name" type="text" class="form-control @error('name')
                                            is-invalid @enderror" name="name"
                                               value="{{ $viewModel->customerItem->name }}"
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
                                            is-invalid @enderror" name="email"
                                               value="{{ $viewModel->customerItem->email }}"
                                               required autocomplete="name" placeholder="Email">
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
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
                                <!-- Ban admin field -->
                                <div class="form-group row">
                                    <label for="password" class="col-sm-3 col-form-label">Set / unset ban</label>
                                    <div class="col-sm-9">
                                        <div class="custom-control custom-checkbox" style="padding-top: .375rem">
                                            <input type="checkbox" class="custom-control-input" name="ban" id="ban">
                                            <label class="custom-control-label" for="ban">ban</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-info">Sign in</button>
                                <a href="{{ route('customer.list') }}" type="button"
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

