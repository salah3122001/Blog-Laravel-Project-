@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body p-4">
            <h2 class="fw-bold text-primary mb-4 text-center">✏️ Edit Post</h2>

            @if(session('success'))
                <div class="alert alert-success text-center">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('update_post', $post->id) }}" method="POST">
                @csrf
               

                {{-- Title --}}
                <div class="mb-3">
                    <label for="title" class="form-label fw-semibold">Title</label>
                    <input type="text" id="title" name="title"
                           value="{{ old('title', $post->title) }}"
                           class="form-control @error('title') is-invalid @enderror"
                           placeholder="Enter post title">

                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Content --}}
                <div class="mb-3">
                    <label for="content" class="form-label fw-semibold">Content</label>
                    <textarea id="content" name="content" rows="6"
                              class="form-control @error('content') is-invalid @enderror"
                              placeholder="Write your post here...">{{ old('content', $post->content) }}</textarea>

                    @error('content')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Buttons --}}
                <div class="d-flex justify-content-between align-items-center mt-4">
                    <a href="{{ route('main') }}" class="btn btn-outline-secondary">
                        ⬅️ Back
                    </a>
                    <button type="submit" class="btn btn-primary px-4">
                        💾 Update Post
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
