<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    //
    public function index()
    {
        $posts=Post::with('user:name,email')->get();
         if($posts->isEmpty())
        {
            return response()->json([
                'status'=>'error',
                'data'=>'No Cart Found'
            ],404);

        }
        return response()->json([
            'status'=>'success',
            'count'=>$posts->count(),
            'data'=>$posts,
        ]);
    }

    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'title' => ['required', 'min:1'],
            'content' => ['required', 'min:1'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'=>'error',
                'data'=>$validator->errors(),

            ],422);

        }
        $data=$validator->validated();

        $post=Post::create([
            'user_id'=>Auth::user()->id,
            'title'=>$data['title'],
            'content'=>$data['content'],
        ]);

        return response()->json([
            'status'=>'success',
            'message'=>'Post Created Successfully',
            'data'=>$post,
        ],200);
    }

    public function show($id)
    {
        $post=Post::with('user:name,email')->where('id',$id)->first();

        if (!$post) {
            return response()->json([
                'status'=>'error',
                'data'=>'No Post Found'
            ],404);
        }
        return response()->json([
            'status'=>'success',
            'data'=>$post,
        ],200);
    }
    public function update(Request $request,$id)
    {
        $validator=Validator::make($request->all(),[
            'title'=>['sometimes','required','min:1'],
            'content'=>['sometimes','required','min:1'],
        ]);
        $post=Post::find($id);

    }

    public function destroy($id)
    {
        $post=Post::find($id);

        if (!$post) {
             return response()->json([
                'status'=>'error',
                'data'=>'No Post Found'
            ],404);
        }
        $post->delete();
        return response()->json([
            'status'=>'success',
            'message'=>'Post Deleted Successfully',

        ],200);
    }
}
