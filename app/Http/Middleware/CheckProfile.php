<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Auth;
use App\Profile;
use Closure;


class CheckProfile
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
        $profiles = Profile::where('user_id', Auth::id())->first();
        if(empty($profiles)) {
            return redirect('auth/profile/create');
        }
        
            return $next($request);
    }
}
