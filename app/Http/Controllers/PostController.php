<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    public function main()
    {
        return view('welcome');
    }
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
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'title' => ['required', 'min:1'],
            'content' => ['required', 'min:1'],
        ]);

        $post = new Post();
        $post->title = $request->title;
        $post->content = $request->content;
        $post->user_id = Auth::user()->id;

        $post->save();

        return redirect()->route('show_post')->with('success', 'Post Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        //
        $posts = Post::with('comments', 'user')->get();

        return view('post.show', compact('posts'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $post = Post::where('id',$id)->where('user_id',Auth::user()->id)->first();
        if ($post) {
            return view('post.edit', compact('post'));
        }
        return redirect()->route('show_post')->with('error', "The Post You Want To Edit Isn't Yours");

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'title' => ['required', 'min:1'],
            'content' => ['required', 'min:1'],
        ]);

        $post = Post::find($id);

        $post->title = $request->title;
        $post->content = $request->content;

        $post->save();
        return redirect()->route('show_post')->with('success', 'Post Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $post = Post::where('id', $id)->where('user_id', Auth::user()->id);
        $deletedPost = $post->delete();

        if ($deletedPost) {
            return redirect()->route('show_post')->with('success', "Post Deleted Successfully");
        }
        return redirect()->route('show_post')->with('error', "The Post You Want To Delete Isn't Yours");
    }
}
