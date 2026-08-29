<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use RuntimeException;

class AuthController extends Controller
{
    public function showLogin(): View|RedirectResponse
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.auth.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email:rfc'],
            'password' => ['required', 'string'],
        ]);

        try {
            if (! Auth::attempt($credentials, $request->boolean('remember'))) {
                return back()
                    ->withErrors(['email' => 'Las credenciales no coinciden con nuestros registros.'])
                    ->onlyInput('email');
            }
        } catch (RuntimeException $exception) {
            if (! str_contains($exception->getMessage(), 'Bcrypt algorithm')) {
                throw $exception;
            }

            $user = User::query()->where('email', $credentials['email'])->first();

            if (! $user || ! hash_equals($user->password, $credentials['password'])) {
                return back()
                    ->withErrors(['email' => 'Las credenciales no coinciden con nuestros registros.'])
                    ->onlyInput('email');
            }

            $user->forceFill([
                'password' => $credentials['password'],
            ])->save();

            Auth::login($user, $request->boolean('remember'));
        }

        $request->session()->regenerate();

        return redirect()->intended(route('admin.dashboard'));
    }
}
