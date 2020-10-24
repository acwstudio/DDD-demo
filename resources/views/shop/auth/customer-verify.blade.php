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
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                        <div class="card-body">
                            @if (session('resent'))
                                <div class="alert alert-success" role="alert">
                                    {{ __('A fresh verification link has been sent to your email address.') }}
                                </div>
                            @endif

                            {{ __('Before proceeding, please check your email for a verification link.') }}
                            {{ __('If you did not receive the email') }},
                            <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                                @csrf
                                <button type="submit" class="btn btn-link p-0 m-0 align-baseline">
                                    {{ __('click here to request another') }}</button>
                                .
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
