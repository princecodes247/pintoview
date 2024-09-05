<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class CheckSubscriptionStatus
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
       // Check if the user is authenticated
       if (auth()->check()) {
        $user = User::where('id', auth()->id())->firstOrFail();

        // Check if the user has an active premium subscription
        if (!$user->isSubscriptionActive()) {
            // Redirect to the subscription page with a message
            return redirect()->route('subscription.index')->with('error', 'You need to have an active premium subscription to access this page.');
        }
    }

    // Proceed with the request if the user has an active subscription
    return $next($request);
    }
}
