@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold text-primary">📝 My Posts</h2>
            <a href="{{ route('create_post') }}" class="btn btn-success">+ Create New Post</a>
        </div>


        @if (session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        @endif
         @if (session('error'))
            <div class="alert alert-danger text-center">
                {{ session('error') }}
            </div>
        @endif

        @if ($posts->count() > 0)
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle shadow-sm">
                    <thead class="table-primary text-center">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Title</th>
                            <th>Content</th>
                            <th>comments</th>
                            <th>Created At</th>
                            @if(auth()->check())
<th>Actions</th>
                            @endif

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $post)
                            <tr>
                                <td>{{$post->user->name}}</td>
                                <td>{{$post->user->email}}</td>
                                <td class="fw-semibold">{{ $post->title }}</td>
                                <td>{{ Str::limit($post->content, 80) }}</td>
                                <td>
                                    @forelse($post->comments as $comment)
                    <div class="border rounded p-2 mb-2 bg-light">
                        <strong>{{ $comment->user->name }}</strong> said:
                        <p class="mb-1">{{ $comment->content }}</p>
                        <small class="text-muted">{{ $comment->created_at ? $comment->created_at->diffForHumans() : '-' }}</small>

                        @if($comment->user_id == Auth::id())
                            <form action="{{route('destroy_comment',$comment->id)}}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger">🗑 Delete</button>
                            </form>
                        @endif
                    </div>
                @empty
                    <p class="text-muted">No comments yet.</p>
                @endforelse

                {{-- إضافة تعليق --}}
                @if(auth()->check())
 <form action="{{route('store_comment',$post->id)}}" method="POST" class="mt-3">
                    @csrf
                    <textarea name="content" class="form-control mb-2" rows="2" placeholder="Write a comment..."></textarea>
                    @error('content')
                    {{$message}}
                    @enderror
                    <button class="btn btn-sm btn-primary">💬 Add Comment</button>
                </form>
                @endif

                                </td>
                                <td>{{ $post->created_at->format('d M Y - h:i A') }}</td>
                                @if(auth()->check())
 <td class="text-center">
                                    <a href="{{ route('edit_post', $post->id) }}"
                                        class="btn btn-sm btn-outline-primary me-1">
                                        ✏️ Edit
                                    </a>

                                    <form action="{{ route('destroy_post', $post->id) }}" method="POST" class="d-inline">
                                        @csrf

                                        <button class="btn btn-sm btn-outline-danger"
                                            onclick="return confirm('Are you sure you want to delete this post?')">
                                            🗑 Delete
                                        </button>
                                    </form>
                                </td>
                                @endif

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-info text-center fs-5 mt-4">
                🚫 No posts yet. Create your first one now!
            </div>
        @endif
    </div>
@endsection
