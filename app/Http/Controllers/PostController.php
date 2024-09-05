<?php

namespace App\Http\Controllers;

use App\Models\BannerAd;
use App\Models\ButtonAd;
use App\Models\EmbedCode;
use App\Models\Post;
use App\Models\Template;
use App\Models\User;
use App\Services\PostService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

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
        $posts = Post::where('user_id', $user->id)->latest()->paginate(10);
        $viewsOverTime = $this->postService->getViewsOverTime($user->id);
        $topPosts = $this->postService->getTopPosts($user->id);
        \Illuminate\Support\Facades\Log::info('User viewed dashboard', ['user_id' => $user->id, 'viewsOverTime' => $viewsOverTime, 'topPosts' => $topPosts]);

        return view('dashboard', compact('posts', 'user', 'viewsOverTime', 'topPosts'));
    }


    public function create()
    {
        $templates = Template::where('user_id', auth()->id())->get();
        return view('posts.create', compact('templates'));
    }

    public function store(Request $request)
    {
        $userId = auth()->id();
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'short_link' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('posts', 'short_link')->where(function ($query) use ($userId) {
                    return $query->where('user_id', $userId);
                })
            ],
            'password' => 'nullable|string',
            'expiration_time' => 'nullable|date',
            'view_limit' => 'nullable|integer|min:1',
            'hidden_until' => 'nullable|date',
            'unlock_after' => 'nullable|integer|min:1',
            'unlock_price' => 'nullable|integer|min:1',
        ]);


        $user = User::where('id', auth()->id())->first();
        if (!$user) {
            return abort(404);
        }

        $post = $this->postService->createPost($request, auth()->user());
        return redirect()->route('posts.show_public', ['user_slug' => $user->slug, 'short_link' => $post->short_link]);
    }

    public function show($short_link)
    {
        $post = Post::where('short_link', $short_link)->first();
        if (!$post) {
            return abort(404);
        }
        return view('posts.show', compact('post'));
    }

    public function showPublic(Request $request, $user_slug, $short_link, $post = null)
    {
        $user = User::where('slug', $user_slug)->first();
        if (!$user) {
            return abort(404);
        }

        $embedCodes = EmbedCode::where('user_id', $user->id)->get()->first();
        $headerBannerAd = BannerAd::where('user_id', $user->id)->where('placement', 'header')->orderBy('created_at', 'desc')->first();
        $footerBannerAd = BannerAd::where('user_id', $user->id)->where('placement', 'footer')->orderBy('created_at', 'desc')->first();
        $topButtonAd = ButtonAd::where('user_id', $user->id)->where('placement', 'top')->where('is_paused', false)->orderBy('created_at', 'desc')->first();
        $bottomButtonAd = ButtonAd::where('user_id', $user->id)->where('placement', 'bottom')->where('is_paused', false)->orderBy('created_at', 'desc')->first();

        if (is_null($post)) {
            $post = Post::where('short_link', $short_link)->first();
        }
        if (!$post) {
            return abort(404);
        }

        if ($post->password && !$request->session()->has('post_' . $post->id . '_access_granted')) {
            return view('posts.password', compact('user', 'post'));
        }

        // Decrement view limit if it exists and check if it's still valid
        if ($post->view_limit !== null) {

            if ($post->view_limit <= $post->views) {
                abort(403, 'This post has reached its view limit.');
            }
        }

        // Check expiration time
        if ($post->expiration_time && now()->isAfter($post->expiration_time)) {
            abort(403, 'This post has expired.');
        }

        $post->views++;
        $post->save();
        return view('posts.show_public', [
            'post' => $post,
            'user' => $user,
            'embedCodes' => $embedCodes,
            'headerBannerAd' => $headerBannerAd,
            'footerBannerAd' => $footerBannerAd,
            'topButtonAd' => $topButtonAd,
            'bottomButtonAd' => $bottomButtonAd,
        ]);
    }

    public function checkPassword(Request $request, $user_slug, $short_link,)
    {
        $user = User::where('slug', $user_slug)->first();
        if (!$user) {
            return abort(404);
        }

        $post = Post::where('short_link', $short_link)->first();
        if (!$post) {
            return abort(404);
        }

        $request->validate([
            'password' => 'required|string',
        ]);

        if ($request->password === $post->password) {
            $request->session()->put('post_' . $post->id . '_access_granted', true);
            return redirect()->route('posts.show_public', ['user_slug' => $user->slug, 'short_link' => $post->short_link]);
        }

        return redirect()->route('posts.show_public', ['user_slug' => $user->slug, 'short_link' => $post->short_link])->withErrors(['password' => 'Incorrect password.']);
    }


    // Show the form for editing the specified resource
    public function edit($id)
    {
        $post = Post::find($id);
        $templates = Template::all();
        return view('posts.create', compact('templates', 'post'));
    }

    // Update the specified resource in storage
    public function update(Request $request, $id)
    {
        $userId = auth()->id();
        $post = Post::find($id);
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'short_link' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('posts', 'short_link')->ignore($post->id)->where(function ($query) use ($userId) {
                    return $query->where('user_id', $userId);
                })
            ],
            'password' => 'nullable|string',
            'expiration_time' => 'nullable|date',
            'view_limit' => 'nullable|integer|min:1',
            'hidden_until' => 'nullable|date',
            'unlock_after' => 'nullable|integer|min:1',
            'unlock_price' => 'nullable|integer|min:1',
        ]);

        $post->update($data);
        return redirect()->route('dashboard');
    }

    // Remove the specified resource from storage
    public function destroy($id)
    {
        $post = Post::find($id);
        if ($post) {
            $post->delete();
            return redirect()->back()->with('success', 'Post deleted successfully!');
        } else {
            return redirect()->back()->with('failure', 'Post not found!');
        }
    }
}
