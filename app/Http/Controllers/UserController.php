<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //

    public function settings(Request $request)
    {
        $user = $request->user();

        return view('posts.settings', compact('user'));
    }

    public function updateTheme(Request $request)
    {
        $request->validate([
            'default_post_theme' => 'nullable|string|max:255',
        ]);

        $user = $request->user();
        $user->default_post_theme = $request->input('default_post_theme');
        $user->save();

        return redirect()->back()->with('success', 'Default post theme updated successfully.');
    }
}
