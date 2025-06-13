<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class LoginAdmin
{

    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('admin.login');
        }
        $user = Auth::User();
        if($user->roles!='admin'){
            return redirect()->route('admin.login')->with('error','Không có quyền vào admin');

        }
        return $next($request);
    }
}
