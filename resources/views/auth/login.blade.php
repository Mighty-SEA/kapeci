<!DOCTYPE html>
<html lang="id">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Masuk</title>
		@vite(['resources/css/app.css','resources/js/app.js'])
	</head>
	<body class="min-h-dvh grid place-items-center bg-gradient-to-br from-sky-50 to-indigo-50">
		<div class="w-full max-w-md rounded-2xl bg-white/80 p-8 shadow-xl ring-1 ring-gray-200 backdrop-blur">
			<div class="flex flex-col items-center mb-8">
				<img src="{{ asset('logo.png') }}" alt="Logo" class="h-20 w-20 mb-4">
				<h2 class="text-xl font-bold text-gray-900">SMA KP CIWIDEY</h2>
			</div>
			@if ($errors->any())
				<div class="mb-4 rounded-md bg-red-50 p-3 text-sm text-red-700">
					{{ $errors->first() }}
				</div>
			@endif
			<form method="POST" action="{{ route('login.attempt') }}" class="space-y-4">
				@csrf
				<div>
					<label class="mb-1 block text-sm font-medium">Username</label>
					<input type="text" name="username" value="{{ old('username') }}" placeholder="Username atau Email" autocomplete="username" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 text-lg py-3" required />
				</div>
				<div>
					<label class="mb-1 block text-sm font-medium">Password</label>
					<input type="password" name="password" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 text-lg py-3" required />
				</div>
				<div class="flex items-center justify-between">
					<label class="flex items-center gap-2 text-sm">
						<input type="checkbox" name="remember" class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
						<span>Ingat saya</span>
					</label>
					<button class="rounded-lg bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-700">Masuk</button>
				</div>
			</form>
		</div>
	</body>
</html> 