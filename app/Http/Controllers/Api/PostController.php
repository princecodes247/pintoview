<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use App\Services\PostService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class PostController extends Controller
{
    protected $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function index(Request $request)
    {
        $user = $request->user();
        $posts = Post::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'posts' => $posts
        ], 200);
    }

    public function show(Request $request, $short_link)
    {
        $post = Post::where('short_link', $short_link)->first();
        return response()->json([
            'post' => $post
        ], 200);
    }

    public function store(Request $request)
    {


        $user = User::where('id', $request->user()->id)->first();
        if (!$user) {
            return abort(404);
        }

        $post = $this->postService->createPost($request, $user);

        Log::info($request->user());

        return response()->json([
            'message' => 'Post created successfully',
            'post' => $post,
            'link' => env('APP_URL') . '/' . $request->user()->slug . '/' . $post->short_link,
        ], 201);
    }

    public function update(Request $request, $short_link)
    {
        $user = User::where('id', $request->user()->id)->first();
        if (!$user) {
            return abort(404);
        }

        $post = $this->postService->updatePost($request, $short_link);
        return response()->json([
            'message' => 'Post updated successfully',
            'post' => $post,
            'link' => env('APP_URL') . '/' . $request->user()->slug . '/' . $post->short_link,
        ], 200);
    }
}
