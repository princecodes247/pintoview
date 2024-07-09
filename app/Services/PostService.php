<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostService
{
    public function createPost(Request $request, $userId)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'password' => 'nullable|string',
            'expiration_time' => 'nullable|date',
            'view_limit' => 'nullable|integer',
            'is_hidden' => 'boolean',
            'hidden_until' => 'nullable|date',
            'template_id' => 'nullable|exists:templates,id',
        ]);

        \Illuminate\Support\Facades\Log::info('User creating post:', ['user_id' => $userId]);

        $post = new Post();
        $post->user_id = $userId;
        $post->title = $request->title;
        $post->content = $request->content;
        $post->password = $request->password;
        $post->expiration_time = $request->expiration_time;
        $post->view_limit = $request->view_limit;
        $post->is_hidden = $request->is_hidden ?? false;
        $post->hidden_until = $request->hidden_until;
        $post->template_id = $request->template_id;
        $post->short_link = Str::random(6);
        $post->save();

        return $post;
    }
}
