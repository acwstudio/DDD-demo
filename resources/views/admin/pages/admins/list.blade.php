@extends('admin.layouts.master')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>List of Admins</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">Home</a></li>
                        <li class="breadcrumb-item active">List of Admins</li>
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
                            <h3 class="card-title">Administrators</h3>

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
                                    <th>Admin</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Ban</th>
                                    <th>Date reg.</th>
                                    <th>Reset Pass</th>
                                    <th>Set Ban</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($viewModel->admins as $admin)
                                <tr class="text-center">
                                    <td>{{ $admin->id }}</td>
                                    <td>{{ $admin->name }}</td>
                                    <td>{{ $admin->email }}</td>
                                    <td>{{ $admin->roles()->first()->name }}</td>
                                    <td>
                                        @if($admin->ban)
                                            <span class="badge badge-danger">BAN</span>
                                        @else
                                            <span class="badge badge-success">OK</span>
                                        @endif
                                    </td>
                                    <td>{{ $admin->created_at }}</td>
                                    <td>
                                        @if($viewModel->canResetPassword)
                                            <a href="{{ route('admin.password.reset', $admin->id) }}" type="button"
                                               class="badge badge-success">RESET PASS</a>
                                        @else
                                            <span class="badge badge-danger">NO ACCESS</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($viewModel->canResetPassword)
                                            <a href="{{ route('admin.ban.show', $admin->id) }}" type="button"
                                               class="badge badge-success">SET BAN</a>
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
