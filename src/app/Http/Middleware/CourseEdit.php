<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\DB;
use Auth;
use Closure;

class CourseEdit
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
        $auth = Auth::guard('admin')->user()->id();
        if()
        return $next($request);
    }
}
