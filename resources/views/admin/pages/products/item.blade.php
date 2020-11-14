@extends('admin.layouts.master')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>E-commerce</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">E-commerce</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">ID-{{ $viewModel->productItem->id }}</h3>
                        </div>
                        <div class="card-body">
                            <p>
                                <label class="col-sm-2">Description:</label>
                                {{ $viewModel->productItem->description }}
                            </p>
                            <form>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" class="form-control"
                                                   value="{{ $viewModel->productItem->name }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Vendor Code</label>
                                            <input type="text" class="form-control"
                                                   value="{{ $viewModel->productItem->vendor_code }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Type</label>
                                            <input type="text" class="form-control"
                                                   value="{{ $viewModel->productItem->type }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Barcode</label>
                                            <input type="text" class="form-control"
                                                   value="{{ $viewModel->productItem->barcode }}" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Stock</label>
                                            <input type="text" class="form-control"
                                                   value="{{ $viewModel->productItem->stock }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Buy Price</label>
                                            <input type="text" class="form-control"
                                                   value="{{ $viewModel->productItem->buy_price }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Sale Price</label>
                                            <input type="text" class="form-control"
                                                   value="{{ $viewModel->productItem->sale_price }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Min Sale Price</label>
                                            <input type="text" class="form-control"
                                                   value="{{ $viewModel->productItem->min_price }}" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <div>
                                                <span>
                                                    @if($viewModel->productItem->archived)
                                                        <span class="badge badge-danger">ARCHIVED</span>
                                                    @else
                                                        <span class="badge badge-success">ACTIVE</span>
                                                    @endif
                                                </span>
                                                <span>
                                                    @if($viewModel->productItem->published)
                                                        <span class="badge badge-success">PUBLISHED</span>
                                                    @else
                                                        <span class="badge badge-danger">MODERATION</span>
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Weight</label>
                                            <input type="text" class="form-control"
                                                   value="{{ $viewModel->productItem->weight }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Volume</label>
                                            <input type="text" class="form-control"
                                                   value="{{ $viewModel->productItem->volume }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Quantity</label>
                                            <input type="text" class="form-control"
                                                   value="{{ $viewModel->productItem->quantity }}" disabled>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
