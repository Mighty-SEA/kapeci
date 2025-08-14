<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountController extends Controller
{
	public function edit(Request $request)
	{
		$user = $request->user();
		return view('profile.settings', compact('user'));
	}

	public function update(Request $request)
	{
		$user = $request->user();

		$validated = $request->validate([
			'name' => ['required', 'string', 'max:255'],
			'username' => ['required', 'string', 'alpha_dash', 'max:255', 'unique:users,username,' . $user->id],
			'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
			'password' => ['nullable', 'confirmed', 'min:8'],
		]);

		$user->fill([
			'name' => $validated['name'],
			'username' => $validated['username'],
			'email' => $validated['email'],
		]);

		if (!empty($validated['password'])) {
			$user->password = $validated['password'];
		}

		$user->save();

		return back()->with('status', 'Pengaturan akun berhasil diperbarui.');
	}
} 