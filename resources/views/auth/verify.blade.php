@extends('layouts.app')

@section('content')
    <div class="container py-5 d-flex justify-content-center">
        <div class="card shadow-lg border-0 rounded-4 col-md-6">
            <div class="card-header text-center bg-primary text-white fs-4 fw-bold rounded-top-4">
                {{ __('Verify Your Email Address') }}
            </div>

            <div class="card-body p-4 text-center">
                @if (session('resent'))
                    <div class="alert alert-success" role="alert">
                        {{ __('A fresh verification link has been sent to your email address.') }}
                    </div>
                @endif

                <p class="mt-3">{{ __('Before proceeding, please check your email for a verification link.') }}</p>
                <p>{{ __('If you did not receive the email, click below:') }}</p>

                <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                    @csrf
                    <button type="submit" class="btn btn-primary btn-lg mt-2">
                        {{ __('Resend Verification Email') }}
                    </button>
                </form>
            </div>

            <div class="card-footer text-center text-muted">
                {{ __('Please verify your email to access all features.') }}
            </div>
        </div>
    </div>
@endsection
