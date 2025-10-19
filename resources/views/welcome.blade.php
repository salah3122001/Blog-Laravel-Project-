@extends('layouts.app')

@section('content')

@if (session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif
<div class="container mt-5">
    <div class="text-center mb-4">
        <h1 class="fw-bold text-primary">Welcome to My Blog 📝</h1>
        <p class="text-muted">Share your thoughts and read what others have to say!</p>

        @auth
            <a href="{{route('create_post')}}" class="btn btn-success mt-3">+ Create New Post</a>
            <a href="{{route('show_post')}}" class="btn btn-success mt-3">+ Show Posts</a>

        @else
            <a href="{{ route('login') }}" class="btn btn-outline-primary mt-3">Login</a>
            <a href="{{ route('register') }}" class="btn btn-outline-secondary mt-3">Register</a>
            <a href="{{route('show_post')}}" class="btn btn-success mt-3">+ Show Posts</a>
        @endauth
    </div>





</div>
@endsection
