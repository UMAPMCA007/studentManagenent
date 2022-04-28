<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        // if not aunticated user  then redirect to login page
        if (auth()->user() == null) {

            return route('login');
        }else{
            // if authenticated user then redirect to dashboard page
            return route('dashboard');
        }

        
    }
}
