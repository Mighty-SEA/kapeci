<!DOCTYPE html>
<html lang="id">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>{{ $title ?? 'Admin Panel' }}</title>
		@vite(['resources/css/app.css','resources/js/app.js'])
	</head>
	<body class="bg-gray-50 text-gray-900">
		<div class="min-h-dvh">
			<nav class="border-b bg-white/70 backdrop-blur supports-[backdrop-filter]:bg-white/60">
				<div class="mx-auto max-w-7xl px-4 py-3 flex items-center justify-between">
					<a href="{{ route('admin.dashboard') }}" class="font-semibold">Sekolah • Admin</a>
					<form method="POST" action="{{ route('logout') }}">
						@csrf
						<button class="rounded-md bg-red-500 text-white px-3 py-1.5 text-sm hover:bg-red-600">Keluar</button>
					</form>
				</div>
			</nav>
			<main class="mx-auto max-w-7xl p-4">
				{{ $slot }}
			</main>
		</div>
	</body>
</html> 