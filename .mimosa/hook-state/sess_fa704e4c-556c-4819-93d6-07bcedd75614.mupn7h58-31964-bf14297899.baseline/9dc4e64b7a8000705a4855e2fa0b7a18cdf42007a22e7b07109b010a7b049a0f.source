<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminLoginController extends Controller
{
    public function show()
    {
        if (session('admin_authed')) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.login');
    }

    public function store(Request $request)
    {
        $request->validate(['password' => 'required']);

        if (! hash_equals((string) config('admin.password'), (string) $request->input('password'))) {
            return back()->withErrors(['password' => 'Wrong password — try again.'])->onlyInput('password');
        }

        session(['admin_authed' => true]);

        return redirect()->intended(route('admin.dashboard'));
    }

    public function logout(Request $request)
    {
        $request->session()->forget('admin_authed');

        return redirect()->route('admin.login');
    }
}
