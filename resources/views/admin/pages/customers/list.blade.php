@extends('admin.layouts.master')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>List of Customers</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">Home</a></li>
                        <li class="breadcrumb-item active">List of Customers</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-10">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Customers</h3>

                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="table_search"
                                           class="form-control float-right"
                                           placeholder="Search">

                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0" style="height: 500px;">
                            <table class="table table-head-fixed text-nowrap">
                                <thead>
                                <tr class="text-center">
                                    <th>ID</th>
                                    <th>Customer</th>
                                    <th>Email</th>
                                    <th>Ban</th>
                                    <th>Date reg.</th>
                                    <th>Reset Pass</th>
                                    <th>Set Ban</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($viewModel->customers as $customer)
                                    <tr class="text-center">
                                        <td>{{ $customer->id }}</td>
                                        <td>{{ $customer->name }}</td>
                                        <td>{{ $customer->email }}</td>
                                        <td>
                                            @if($customer->ban)
                                                <span class="badge badge-danger">BAN</span>
                                            @else
                                                <span class="badge badge-success">OK</span>
                                            @endif
                                        </td>
                                        <td>{{ $customer->created_at }}</td>
                                        <td>
                                            @if($viewModel->canResetPassword)
                                                <a href="{{ route('admin.password.reset', $customer->id) }}"
                                                   type="button" class="badge badge-success">RESET PASS</a>
                                            @else
                                                <span class="badge badge-danger">NO ACCESS</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($viewModel->canResetPassword)
                                                <a href="{{ route('admin.ban.show', $customer->id) }}"
                                                   type="button" class="badge badge-success">SET BAN</a>
                                            @else
                                                <span class="badge badge-danger">NO ACCESS</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
@endsection
