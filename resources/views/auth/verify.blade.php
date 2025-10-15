@extends('layouts.app')

@section('content')
<div class="container text-center py-5">
    <h2>Verify Your Email Address</h2>

    @if (session('resent'))
        <div class="alert alert-success mt-3" role="alert">
            A fresh verification link has been sent to your email address.
        </div>
    @endif

    <p class="mt-4">Before proceeding, please check your email for a verification link.</p>
    <p>If you did not receive the email, click below:</p>

    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
        @csrf
        <button type="submit" class="btn btn-primary">Resend Verification Email</button>
    </form>
</div>
@endsection
