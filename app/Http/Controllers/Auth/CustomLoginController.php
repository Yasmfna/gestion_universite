<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CustomLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login'); // ta vue avec bulles
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $role = Auth::user()->role;

            $redirectRoutes = [
                'admin'   => 'admin.dashboard',
                'secre1'  => 'secre1.dashboard',
                'secre2'  => 'secre2.dashboard',
                'dirc1'   => 'dirc1.dashboard',
                'dirc2'   => 'dirc2.dashboard',
                'respo1'  => 'respo1.dashboard',
            ];

            if (array_key_exists($role, $redirectRoutes)) {
                return redirect()->route($redirectRoutes[$role]);
            }

            return redirect('/'); // fallback
        }

        return back()->withErrors([
            'email' => 'Email ou mot de passe invalide.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('status', 'Déconnexion réussie.');
    }

}
