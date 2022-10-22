<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthorityCheck
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
        $user = Auth::user();
        if($user->role == 2)
            return abort(403);
//        $employer = $user->info()->get()->first();
//        if ($user->id == ) {
//
//            if(!Auth::user()->info()->exists()){
//                return redirect(route('account.info', 'activist'));
//            }
//            return $next($request);
//
//        }
        return $next($request);
    }
}
