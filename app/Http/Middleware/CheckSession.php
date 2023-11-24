<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckSession {
    public function handle($request, Closure $next) {
        // if (time() - session('last_activity') > config('session.lifetime')) {
        //     // Sesuai dengan konfigurasi timeout sesi, pengguna diarahkan kembali ke halaman login jika sesi habis.
        //     Auth::logout();
        //     return redirect('/login')->with('session_timeout', 'Sesi Anda telah habis. Silakan login kembali.');
        // }

        // session(['last_activity' => time()]);

        // return $next($request);
    }
}
