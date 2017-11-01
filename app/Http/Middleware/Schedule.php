<?php

namespace App\Http\Middleware;

use Closure;

class Schedule
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Check if user has a schedule. If not -> redirect to schedule select
        $user = auth()->user();
        if($user->schedule == null) {
            return redirect('/schedule');
        }

        return $next($request);
    }
}
