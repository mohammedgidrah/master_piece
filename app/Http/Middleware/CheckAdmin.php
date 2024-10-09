<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAdmin
{
    public function handle(Request $request, Closure $next)
    {
        // Check if the authenticated user is an admin
        if (auth()->check() && !auth()->user()->isAdmin()) {
            // If the user is not an admin, redirect them to the homepage or a different page
            return redirect('/unauthorized');
        }

        // If the user is an admin, allow them to proceed to the dashboard
        return $next($request);
    }
}
