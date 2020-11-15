@extends('admin.layouts.master')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>List of Products</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">Home</a></li>
                        <li class="breadcrumb-item active">List of Products</li>
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
                            <h3 class="card-title">Products</h3>

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
                                    <th>Name</th>
                                    <th>Owner</th>
                                    <th>Stock</th>
                                    <th>Archived</th>
                                    <th>Published</th>
                                    <th>Quantity</th>
                                    <th>Set Archive</th>
                                    <th>Show Item</th>
                                    <th>Set Publish</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($viewModel->products as $product)
                                    <tr class="text-center">
                                        <td>{{ $product->id }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->admin->name }}</td>
                                        <td>{{ $product->stock }}</td>
                                        <td>
                                            @if($product->archived)
                                                <span class="badge badge-danger">ARCHIVED</span>
                                            @else
                                                <span class="badge badge-success">ACTIVE</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($product->published)
                                                <span class="badge badge-success">PUBLISHED</span>
                                            @else
                                                <span class="badge badge-warning">MODERATION</span>
                                            @endif
                                        </td>
                                        <td>{{ $product->quantity }}</td>
                                        <td>
                                            @if($viewModel->canArchived)
                                                <a href="#" type="button"
                                                   class="badge badge-success">SET ARCHIVE</a>
                                            @else
                                                <span class="badge badge-danger">NO ACCESS</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($viewModel->canShowItem)
                                                <a href="{{ route('product.item', $product->id ) }}" type="button"
                                                   class="badge badge-success">SHOW ITEM</a>
                                            @else
                                                <span class="badge badge-danger">NO ACCESS</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($viewModel->canPublished)
                                                <a href="#" type="button"
                                                   class="badge badge-success">SET PUBLISH</a>
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
