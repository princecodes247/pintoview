<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostService
{
    public function createPost(Request $request, $user)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'content' => 'required',
            'password' => 'nullable|string',
            'expiration_time' => 'nullable|date',
            'view_limit' => 'nullable|integer',
            'is_hidden' => 'boolean',
            'hidden_until' => 'nullable|date',
            'template_id' => 'nullable|exists:templates,id',
        ]);

        \Illuminate\Support\Facades\Log::info('User creating post:', ['user_id' => $user->id]);

        $post = new Post();
        $post->user_id = $user->id;
        $post->title = $request->title ?? \Carbon\Carbon::now()->format('F j');
        $post->content = $request->content;
        $post->password = $request->password;
        $post->expiration_time = $request->expiration_time;
        $post->view_limit = $request->view_limit;
        $post->is_hidden = $request->is_hidden ?? false;
        $post->hidden_until = $request->hidden_until;
        $post->template_id = $request->template_id;
        $post->short_link = $user->isPremium() && $request->input('slug') ? Str::slug($request->input('slug')) : Str::random(6);
        $post->save();

        return $post;
    }

    public function updatePost(Request $request, $short_link)
    {
        $post = Post::where('short_link', $short_link)->first();
        if ($request->has('title')) {
            $post->title = $request->title;
        }
        if ($request->has('content')) {
            $post->content = $request->content;
        }
        if ($request->has('password')) {
            $post->password = $request->password;
        }
        $post->save();
        return $post;
    }

    public function getViewsOverTime($userId)
    {
        $viewsOverTime = ['labels' => [], 'data' => []];
        $posts = Post::where('user_id', $userId)->get();
        if (!$posts->isEmpty()) {
            foreach ($posts as $post) {
                $viewsOverTime['labels'][] = $post->created_at->format('F j');
                $viewsOverTime['data'][] = $post->views;
            }
        }
        return $viewsOverTime;
    }

    public function getTopPosts($userId)
    {
        $posts = Post::where('user_id', $userId)->orderBy('views', 'desc')->take(5)->get();
        $topPosts = ['labels' => $posts->pluck('title'), 'data' => $posts->pluck('views')];
        return $topPosts;
    }
}
