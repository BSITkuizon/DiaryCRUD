<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Check if the authenticated user has an 'admin' role
        if (auth()->user() && auth()->user()->role !== 'admin') {
            return redirect('/'); // Redirect to home or a different page
        }

        return $next($request);
    }
}
