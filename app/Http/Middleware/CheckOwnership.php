<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckOwnership
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $model)
    {
        $modelClass = "App\\Models\\" . ucfirst($model);
        $item = $modelClass::findOrFail($request->route('id'));

        if ($item->business->user_id !== auth('user')->id()) {
            toast('Akses anda ditolak! Anda tidak memiliki izin untuk mengakses data ini.', 'error')->timerProgressBar()->autoClose(5000);
            return redirect()->route('user.dashboard');
        }

        return $next($request);
    }
}
