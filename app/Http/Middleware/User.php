<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class User
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::user()->divisi === 'MANAGER' ||  Auth::user()->divisi === 'ADMIN') {
            return $next($request);
        }
    
        if (Auth::user()->divisi === 'SAFETY') {
            $allowedRoutes = [
                'users.index',
                'users.show',
                'users.create',
                'users.store',
                'users.edit',
                'users.update',
                'users.destroy'
            ];
    
            if (in_array($request->route()->getName(), $allowedRoutes)) {
                return $next($request);
            }
        }
    
        $allowedRoutes = [
            'materials.index',
            'materials.show',
            'stockins.index',
            'stockins.show',
            'stockouts.index',
            'stockouts.show',
        ];
    
        if (!in_array($request->route()->getName(), $allowedRoutes)) {
            $mess = ["type" => "error", "text" => "Anda Tidak Memiliki Akses"];
            return redirect('/')->with($mess);
        }
    
        return $next($request);
    }
    
}