@extends('shop.layouts.master')

@section('content')
    <!-- Page Banner Section Start -->
    @include('shop.partials.banners')
    <!-- Page Banner Section End -->

    <!-- Login & Register Section Start -->
    <div class="login-register-section section position-relative pt-90 pb-60 pt-lg-80 pb-lg-50 pt-md-70
            pb-md-40 pt-sm-60 pb-sm-30 pt-xs-50 pb-xs-20 fix">
        <div class="container">
            <div class="row justify-content-center">
                <!-- Login Form Start -->
                <div class="col-lg-7 col-md-6 col-12 mb-30">
                    <div class="login-register-form">
                        <h3>Register Form</h3>
                        <form method="POST" action="{{ url('/register') }}">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6 col-12 mb-20">
                                    <input id="name" type="text" class="@error('name')
                                        is-invalid @enderror" name="name" value="{{ old('name') }}"
                                           required autocomplete="name" autofocus placeholder="Name">

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>

                                <div class="col-lg-6 col-12 mb-20">
                                    <input id="email" type="email" class="@error('email')
                                        is-invalid @enderror" name="email" value="{{ old('email') }}"
                                           required autocomplete="email" placeholder="Enter your email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>

                                <div class="col-lg-6 col-12 mb-20">
                                    <input id="password" type="password" class="@error('password')
                                        is-invalid @enderror" name="password" required
                                           autocomplete="new-password" placeholder="Password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>

                                <div class="col-lg-6 col-12 mb-20">
                                    <input id="password-confirm" type="password" class=""
                                           name="password_confirmation" required autocomplete="new-password"
                                           placeholder="Repeat Password">
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="btn btn-round btn-lg">Register</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Login Form End -->

            </div>
        </div>
    </div>
    <!-- Login & Register Section End -->

@endsection
