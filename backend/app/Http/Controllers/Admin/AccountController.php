<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AccountController extends Controller
{
    public function profile(): View
    {
        return view('admin.account.profile', [
            'user' => Auth::user(),
        ]);
    }

    public function settings(): View
    {
        return view('admin.account.settings');
    }

    public function logout(Request $request): RedirectResponse
    {
        if (Auth::check()) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }

        return redirect()->route('admin.dashboard')->with('success', 'Sesion cerrada correctamente.');
    }
}
