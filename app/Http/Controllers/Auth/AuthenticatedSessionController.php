<?php

namespace App\Http\Controllers\Auth;
use Illuminate\View\View;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View  // Ubah tipe return jika perlu, atau hapus ': Response'
    {
        // Memaksa Laravel menggunakan file resources/views/auth/login.blade.php
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        // Redirect user after login based on role: admin -> dashboard, others -> landing
        $user = Auth::user();
        if ($user && $user->role === 'admin') {
            return redirect()->route('dashboard');
        }

        return redirect()->route('landing');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
