<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        // Ambil role user yang baru saja login
        $role = $request->user()->role;

        // Alur redirect sesuai Flowchart Admin, Petugas, dan Peminjam
        switch ($role) {
            case 'admin':
                return redirect()->intended(route('admin.dashboard'));
            case 'petugas':
                return redirect()->intended(route('petugas.dashboard'));
            case 'peminjam':
                return redirect()->intended(route('peminjam.dashboard'));
            default:
                return redirect()->intended(route('dashboard'));
        }
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
