<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>New Comment</title>
</head>
<body>
    <h2>Hi {{ $comment->post->user->name }},</h2>
    <p><strong>{{ $comment->user->name }}</strong> commented on your post:</p>

    <blockquote>
        "{{ $comment->content }}"
    </blockquote>

    <p>Post title: <strong>{{ $comment->post->title }}</strong></p>
    <p><a href="{{ url('/show') }}">View your post</a></p>

    <hr>
    <small>Sent by {{ config('app.name') }}</small>
</body>
</html>
