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
        $postsWithPassword = Post::where('user_id', $user->id)
            ->whereNotNull('password')
            ->latest()
            ->paginate(10);
        $viewsOverTime = $this->postService->getViewsOverTime($user->id);
        $topPosts = $this->postService->getTopPosts($user->id);
        \Illuminate\Support\Facades\Log::info('User viewed dashboard', ['user_id' => $user->id, 'viewsOverTime' => $viewsOverTime, 'topPosts' => $topPosts]);

        return view('dashboard', compact('posts', 'user', 'viewsOverTime', 'topPosts', 'postsWithPassword'));
    }


    public function create()
    {
        $templates = Template::where('user_id', auth()->id())->get();
        return view('posts.create', compact('templates'));
    }
    public function store(Request $request)
    {
        $user = auth()->user();
    
        // Check if the user exists
        if (!$user) {
            return abort(404);
        }
    
        // Check if the user has an active subscription
        $subscription = $user->subscriptions()->where('ends_at', '>', now())->first();
        
        // Check if the user already has 3 posts and no active subscription
        if ($user->posts()->count() >= 3 && !$subscription) {
            return redirect()->route('subscription.index')->with('error', 'You need to subscribe to create more than 3 posts.');
        }
    
        // Validate the request data
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'short_link' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('posts', 'short_link')->where(function ($query) use ($user) {
                    return $query->where('user_id', $user->id);
                })
            ],
            'password' => 'nullable|string',
            'expiration_time' => 'nullable|date',
            'view_limit' => 'nullable|integer|min:1',
            'hidden_until' => 'nullable|date',
            'unlock_after' => 'nullable|integer|min:1',
            'unlock_price' => 'nullable|integer|min:1',
        ]);
    
        // Create the post using the post service
        $post = $this->postService->createPost($request, $user);
    
        // Redirect to the public view of the post
        return redirect()->route('posts.show_public', [
            'user_slug' => $user->slug,
            'short_link' => $post->short_link,
        ])->with('success', 'Post created successfully.');
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
    
        // Retrieve user's posts sorted by oldest first
        $userPosts = Post::where('user_id', $user->id)
            ->orderBy('created_at', 'asc')
            ->get();
    
        // Check if user is on a free plan and restrict to only the 3 oldest posts
        if (!$user->isPremium() && $userPosts->count() > 3) {
            $allowedPosts = $userPosts->take(3)->pluck('id')->toArray();
    
            // If the post is not one of the 3 oldest, show the subscription expired page
            if (!in_array($post->id ?? Post::where('short_link', $short_link)->first()->id, $allowedPosts)) {
                return view('subscription.expired')->with('error', 'You need a premium subscription to access more than 3 posts.');
            }
        }
    
        $embedCodes = EmbedCode::where('user_id', $user->id)->first();
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
    
        if ($post->view_limit !== null && $post->view_limit <= $post->views) {
            abort(403, 'This post has reached its view limit.');
        }
    
        // Check expiration time
        if ($post->expiration_time && now()->isAfter($post->expiration_time)) {
            abort(403, 'This post has expired.');
        }
    
        $post->increment('views');
    
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
