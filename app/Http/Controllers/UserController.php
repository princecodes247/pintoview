<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //

    public function settings(Request $request)
    {
        $user = $request->user();

        return view('posts.settings', compact('user'));
    }

    public function updateSettings(Request $request)
    {
        $data = $request->validate([
            'default_post_theme' => 'nullable|string|max:255',
            'show_date' => 'nullable|boolean',
        ]);

        $user = $request->user();
        $user->default_post_theme = $request->input('default_post_theme');
        $user->show_date = $data['show_date'] ?? 0;
        $user->save();

        return redirect()->back()->with('success', 'Default post theme updated successfully.');
    }

    public function profile($username)
    {
        $user = User::where('slug', $username)->firstOrFail();

        if ($user->custom_domain) {
            return redirect()->to($user->custom_domain);
        }

        // Fetch free posts (without a password)
        $freePosts = Post::where('user_id', $user->id)
            ->whereNull('password')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        // Fetch locked posts (with a password)
        $lockedPosts = Post::where('user_id', $user->id)
            ->whereNotNull('password')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        return view('profile.show_public', compact('user', 'freePosts', 'lockedPosts'));
    }

    public function update(Request $request)
    {
        $user = $request->user();

        $validator = Validator::make($request->all(), [
            'facebook' => 'nullable|url|max:255',
            'twitter' => 'nullable|url|max:255',
            'whatsapp' => 'nullable|url|max:255',
            'telegram' => 'nullable|url|max:255',
            'custom_domain' => 'nullable|url|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Update the user's profile information
        $user->update([
            'facebook' => $request->input('facebook'),
            'twitter' => $request->input('twitter'),
            'whatsapp' => $request->input('whatsapp'),
            'telegram' => $request->input('telegram'),
            'custom_domain' => $request->input('custom_domain'),
        ]);

        return redirect()->back()->with('status', 'Profile updated successfully.');
    }
}
