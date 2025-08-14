<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
	public function showLogin()
	{
		if (Auth::check()) {
			return redirect()->route('admin.dashboard');
		}

		return view('auth.login');
	}

	public function login(Request $request)
	{
		$validated = $request->validate([
			'username' => ['required', 'string'],
			'password' => ['required'],
		]);

		$loginInput = $validated['username'];
		$credentials = ['password' => $validated['password']];

		if (filter_var($loginInput, FILTER_VALIDATE_EMAIL)) {
			$credentials['email'] = $loginInput;
		} else {
			$credentials['username'] = $loginInput;
		}

		if (Auth::attempt($credentials, $request->boolean('remember'))) {
			$request->session()->regenerate();
			return redirect()->intended(route('admin.dashboard'));
		}

		return back()->withErrors([
			'username' => 'Kredensial tidak valid.',
		])->onlyInput('username');
	}

	public function logout(Request $request)
	{
		Auth::logout();
		$request->session()->invalidate();
		$request->session()->regenerateToken();
		return redirect()->route('login');
	}
} 