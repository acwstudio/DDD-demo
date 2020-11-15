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
                            <form method="POST" action="{{ route('product.update', $viewModel->productItem->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-sm-9">
                                        <div class="form-group">
                                            <label for="description" class="col-form-label">Description</label>
                                            <textarea id="description" type="text" class="form-control @error('name')
                                            is-invalid @enderror" name="description"
                                                      rows="2">{{ $viewModel->productItem->description }}</textarea>
                                            @error('description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group pl-2">
                                        <label class="col-form-label">Status</label>
                                        <div class="custom-control custom-checkbox" style="padding-top: .375rem">
                                            <input type="checkbox" class="custom-control-input"
                                                   name="archived" id="archived"
                                                {{ $viewModel->productItem->archived ? 'checked' : ''}}>
                                            <label class="custom-control-label" for="archived">Archived</label>
                                        </div>
                                        <div class="custom-control custom-checkbox" style="padding-top: .375rem">
                                            <input type="checkbox" class="custom-control-input"
                                                   name="published" id="published"
                                                {{ $viewModel->productItem->published ? 'checked' : ''}}>
                                            <label class="custom-control-label" for="published">Published</label>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-sm-5">
                                        <label for="name" class="col-form-label">Name</label>
                                        <input id="name" type="text" class="form-control @error('name')
                                            is-invalid @enderror" name="name"
                                               value="{{ $viewModel->productItem->name }}"
                                               required autocomplete="name" placeholder="Name">
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="vendor_code" class="col-form-label">Vendor Code</label>
                                        <input id="vendor_code" type="text" class="form-control @error('vendor_code')
                                            is-invalid @enderror" name="vendor_code"
                                               value="{{ $viewModel->productItem->vendor_code }}"
                                               required autocomplete="vendor_code" placeholder="Vendor Code">
                                        @error('vendor_code')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="type" class="col-form-label">Type</label>
                                        <input id="type" type="text" class="form-control @error('type')
                                            is_invalid @enderror" name="type"
                                               value="{{ $viewModel->productItem->type }}"
                                               required autocomplete="type" placeholder="Type">
                                        @error('type')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <!-- Role field -->
                                    <div class="col-sm-3">
                                        <label for="admin_id" class="col-form-label">Owner</label>
                                        <select class="form-control" id="admin_id" name="admin_id">
                                            @foreach($viewModel->admins as $admin)
                                                <option value="{{ $admin->id }}"
                                                    {{$admin->id === $viewModel->productItem->admin_id ? 'selected' : '' }}>
                                                    {{ $admin->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="barcode" class="col-form-label">Barcode</label>
                                        <input id="barcode" type="text" class="form-control @error('barcode')
                                            is_invalid @enderror" name="barcode"
                                               value="{{ $viewModel->productItem->barcode }}"
                                               required autocomplete="barcode" placeholder="Barcode">
                                        @error('barcode')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="weight" class="col-form-label">Weight</label>
                                        <input id="weight" type="text" class="form-control @error('weight')
                                            is_invalid @enderror" name="weight"
                                               value="{{ $viewModel->productItem->weight }}"
                                               required autocomplete="weight" placeholder="Weight">
                                        @error('weight')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="volume" class="col-form-label">Volume</label>
                                        <input id="volume" type="text" class="form-control @error('volume')
                                            is_invalid @enderror" name="volume"
                                               value="{{ $viewModel->productItem->volume }}"
                                               required autocomplete="weight" placeholder="Volume">
                                        @error('volume')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-sm-3">
                                        <label for="buy_price" class="col-form-label">Category</label>
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="buy_price" class="col-form-label">Buy Price</label>
                                        <input id="buy_price" type="text" class="form-control @error('buy_price')
                                            is_invalid @enderror" name="buy_price"
                                               value="{{ $viewModel->productItem->buy_price }}"
                                               required autocomplete="buy_price" placeholder="Buy Price">
                                        @error('buy_price')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="sale_price" class="col-form-label">Sale Price</label>
                                        <input id="sale_price" type="text" class="form-control @error('sale_price')
                                            is_invalid @enderror" name="sale_price"
                                               value="{{ $viewModel->productItem->sale_price }}"
                                               required autocomplete="sale_price" placeholder="Sale Price">
                                        @error('sale_price')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="min_price" class="col-form-label">Min Price</label>
                                        <input id="min_price" type="text" class="form-control @error('min_price')
                                            is_invalid @enderror" name="min_price"
                                               value="{{ $viewModel->productItem->min_price }}"
                                               required autocomplete="min_price" placeholder="Min Price">
                                        @error('min_price')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-sm-3">
                                        <label for="stock" class="col-form-label">Stock</label>
                                        <input id="stock" type="text" class="form-control @error('stock')
                                            is_invalid @enderror" name="stock"
                                               value="{{ $viewModel->productItem->stock }}"
                                               required autocomplete="stock" placeholder="Stock">
                                        @error('stock')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="reserve" class="col-form-label">Reserve</label>
                                        <input id="reserve" type="text" class="form-control @error('reserve')
                                            is_invalid @enderror" name="reserve"
                                               value="{{ $viewModel->productItem->reserve }}"
                                               required autocomplete="reserve" placeholder="Reserve">
                                        @error('reserve')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="in_transit" class="col-form-label">In Transit</label>
                                        <input id="in_transit" type="text" class="form-control @error('in_transit')
                                            is_invalid @enderror" name="in_transit"
                                               value="{{ $viewModel->productItem->in_transit }}"
                                               required autocomplete="in_transit" placeholder="In Transit">
                                        @error('in_transit')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="quantity" class="col-form-label">Quantity</label>
                                        <input id="quantity" type="text" class="form-control @error('quantity')
                                            is_invalid @enderror" name="quantity"
                                               value="{{ $viewModel->productItem->quantity }}"
                                               required autocomplete="quantity" placeholder="Quantity">
                                        @error('quantity')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-info">Update</button>
                                    <a href="{{ route('product.list') }}" type="button"
                                       class="btn btn-default float-right">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
