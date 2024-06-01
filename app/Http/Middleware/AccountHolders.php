<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AccountHolders
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $userAccountType = Auth::user()->account_type;
            if (!in_array($userAccountType, ['super_admin', 'seller'])) {
                return Redirect()->route('index')->with('error', 'You can not access Account Holder Information.');
            }            
        }
        return $next($request);
    }
}
