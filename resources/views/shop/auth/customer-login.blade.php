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
                <div class="col-lg-4 col-md-6 col-12 mb-30">
                    <div class="login-register-form">
                        <h3>Already a Member?</h3>
                        <form method="POST" action="{{ route('shop.login') }}">
                            @csrf
                            <div class="row">
                                <div class="col-12 mb-20">
                                    <input id="email" type="email" class="@error('email') is-invalid @enderror"
                                           name="email" value="{{ old('email') }}"
                                           required autocomplete="email" autofocus
                                           placeholder="Email or Username">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>

                                <div class="col-12 mb-20">
                                    <input id="password" type="password" class="@error('password')
                                        is-invalid @enderror" name="password" required
                                           autocomplete="current-password" placeholder="Password">

                                    @error('password')
                                    <span class="invalid-feedback" style="display: block" role="alert">
                                            <strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>

                                <div class="col-12 mb-20 checkout-form">
                                    <div class="check-box">
                                        <input class="" type="checkbox" name="remember"
                                               id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <button class="btn btn-round btn-lg">Login</button>
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link ml-50" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif

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
