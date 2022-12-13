<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;

class IsCustomer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */

    protected $auth;
    protected $route;

    public function __construct(Guard $auth, Route $route) {
        $this->auth = $auth;
        $this->route = $route;
    }
    public function handle(Request $request, Closure $next)
    {
        if($this->auth->user()->is_system_admin == 1) {
            return new Response('<div style="margin-top: 130px;"><center><img src="https://t4.ftcdn.net/jpg/03/77/78/17/360_F_377781792_j2jOYENO4CDuw9Y6rmioE1yfE1X5L3sv.jpg"
            alt="login form"/></center></div>', 401);
        }
        return $next($request);
    }
}
