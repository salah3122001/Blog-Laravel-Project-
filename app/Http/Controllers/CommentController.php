<?php

namespace App\Http\Controllers;

use App\Mail\NewCommentNotification;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,$id)
    {
        //
        $request->validate([
            'content'=>['required','min:1'],
        ]);
        $post=Post::find($id);
        $comment=Comment::create([
            'content'=>$request->content,
            'user_id'=> Auth::user()->id,
            'post_id'=>$post->id,
        ]);

        Mail::to($post->user->email)->send(new NewCommentNotification(($comment)));
        return redirect()->route('show_post')->with('success','Comment Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        Comment::find($id)->delete();
         return redirect()->route('show_post')->with('success','Comment Deleted Successfully');

    }
}
