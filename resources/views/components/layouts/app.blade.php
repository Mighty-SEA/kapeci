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
			<div class="flex min-h-dvh">
				<!-- Sidebar -->
				<aside class="hidden w-64 shrink-0 bg-gradient-to-b from-slate-900 to-slate-800 shadow-xl md:block">
					<div class="flex h-full flex-col">
						<!-- Logo/Brand -->
						<div class="flex items-center gap-3 px-6 py-6">
							<div class="flex h-10 w-10 items-center justify-center rounded-lg bg-indigo-500 shadow-lg">
								<svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
								</svg>
							</div>
							<div>
								<div class="text-lg font-bold text-white">Sekolah</div>
								<div class="text-sm text-slate-300">Admin Panel</div>
							</div>
						</div>

						<!-- Navigation -->
						<nav class="flex-1 px-4 pb-4">
							<div class="space-y-2">
								<a href="{{ route('admin.dashboard') }}" class="group flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition-all duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-500 text-white shadow-lg' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }}">
									<svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6H8V5z"></path>
									</svg>
									<span>Dashboard</span>
									@if(request()->routeIs('admin.dashboard'))
										<div class="ml-auto h-2 w-2 rounded-full bg-white"></div>
									@endif
								</a>

								<a href="{{ route('admin.siswa.index') }}" class="group flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition-all duration-200 {{ request()->routeIs('admin.siswa.*') ? 'bg-indigo-500 text-white shadow-lg' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }}">
									<svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
									</svg>
									<span>Manajemen Siswa</span>
									@if(request()->routeIs('admin.siswa.*'))
										<div class="ml-auto h-2 w-2 rounded-full bg-white"></div>
									@endif
								</a>
							</div>
						</nav>
					</div>
				</aside>

				<!-- Main Content -->
				<div class="flex min-w-0 flex-1 flex-col">
					<!-- Top Bar -->
					<header class="sticky top-0 z-10 bg-white/95 backdrop-blur supports-[backdrop-filter]:bg-white/90 border-b border-gray-200/60 shadow-sm">
						<div class="mx-auto flex max-w-7xl items-center justify-between gap-4 px-6 py-4">
							<!-- Mobile Menu Button + Title -->
							<div class="flex items-center gap-4">
								<button class="rounded-lg p-1.5 text-gray-400 hover:bg-gray-100 hover:text-gray-600 md:hidden">
									<svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
									</svg>
								</button>
								<div class="hidden md:block">
									<h1 class="text-lg font-semibold text-gray-900">{{ $title ?? 'Dashboard' }}</h1>
									<p class="text-sm text-gray-500">{{ now()->format('l, d F Y') }}</p>
								</div>
								<div class="md:hidden">
									<div class="text-lg font-semibold text-gray-900">Sekolah</div>
								</div>
							</div>

							<!-- Quick Actions + User Menu -->
							<div class="flex items-center gap-3">
								<!-- Notifications -->
								<button class="rounded-lg p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-600">
									<svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
									</svg>
								</button>

								<a href="{{ route('account.settings') }}" class="rounded-lg bg-slate-50 px-3 py-2 text-sm font-medium text-slate-700 ring-1 ring-slate-200 transition-all hover:bg-slate-100">Pengaturan</a>

								<!-- User Avatar & Logout -->
								<div class="flex items-center gap-3 pl-3 border-l border-gray-200">
									<div class="hidden sm:block text-right">
										<div class="text-sm font-medium text-gray-900">{{ auth()->user()->name }}</div>
										<div class="text-xs text-gray-500">Administrator</div>
									</div>
									<form method="POST" action="{{ route('logout') }}">
										@csrf
										<button class="flex items-center gap-2 rounded-lg bg-red-50 px-3 py-2 text-sm font-medium text-red-700 ring-1 ring-red-200 transition-all hover:bg-red-100 hover:ring-red-300">
											<svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
												<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
											</svg>
											<span class="hidden sm:inline">Keluar</span>
										</button>
									</form>
								</div>
							</div>
						</div>
					</header>

					<!-- Main Content Area -->
					<main class="mx-auto w-full max-w-7xl flex-1 px-6 py-6">
						{{ $slot }}
					</main>
				</div>
			</div>
		</div>
	</body>
</html> 