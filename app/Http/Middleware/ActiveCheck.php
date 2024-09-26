<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ActiveCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::guard('user')->check()) {
            toast('Akses anda ditolak! Silakan login terlebih dahulu.','error')->timerProgressBar()->autoClose(5000);
            return redirect()->route('user.showLogin');
        }

        if (!Auth::guard('user')->check()) {
            toast('Akses anda ditolak! Silakan login terlebih dahulu.','error')->timerProgressBar()->autoClose(5000);
            return redirect()->route('user.showLogin');
        }

        $user = Auth::guard('user')->user();

        if (!$user->isActive) {
            Auth::guard('user')->logout();
            toast('Akun anda tidak aktif. Silakan menghubungi admin.','error')->timerProgressBar()->autoClose(5000);
            return redirect()->route('user.showLogin');
        } elseif ($user->verified_by == null && $user->email_verified_at == null) {
            toast('Akun anda belum diverifikasi.','error')->timerProgressBar()->autoClose(5000);
            return redirect()->route('user.showLogin');
        }

        return $next($request);        
    }
}
