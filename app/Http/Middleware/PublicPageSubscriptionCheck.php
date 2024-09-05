<?php

namespace App\Http\Middleware;

use App\Models\User;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;

class PublicPageSubscriptionCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $slug = $request->route('user_slug');

        // Find the user by slug
        $user = User::where('slug', $slug)->firstOrFail();

        // Check if the user has an active premium subscription
        if (!$user->isSubscriptionActive()) {
            // Show the error page
            return response()->view('subscription.expired', ['slug' => $user->name], 403);
        }
      

        return $next($request);
    }
}
