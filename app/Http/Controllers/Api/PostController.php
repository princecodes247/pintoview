<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
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

        $post = $this->postService->createPost($request, $request->user()->id);

        Log::info($request->user());

        return response()->json([
            'message' => 'Post created successfully',
            'post' => $post,
            'link' => env('APP_URL') . '/' . $request->user()->slug . '/' . $post->short_link,
        ], 201);
    }
}
