<x-layouts.app :title="'Dashboard'">
	<div class="space-y-6">
		<!-- Header -->
		<div class="mb-8">
			<h1 class="text-2xl font-bold text-gray-900">Dashboard</h1>
			<p class="text-gray-600">Selamat datang di sistem manajemen data siswa</p>
		</div>

		<!-- Statistik Cards -->
		<div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
			<div class="group relative overflow-hidden rounded-xl bg-gradient-to-br from-blue-500 to-blue-600 p-6 text-white shadow-lg transition-all hover:scale-105 hover:shadow-xl">
				<div class="absolute -right-4 -top-4 h-16 w-16 rounded-full bg-white/20"></div>
				<div class="relative">
					<div class="mb-2 text-sm font-medium opacity-90">Total Siswa</div>
					<div class="text-3xl font-bold">{{ $studentCount }}</div>
					<div class="mt-1 text-xs opacity-75">Siswa terdaftar</div>
				</div>
			</div>

			<div class="group relative overflow-hidden rounded-xl bg-gradient-to-br from-emerald-500 to-emerald-600 p-6 text-white shadow-lg transition-all hover:scale-105 hover:shadow-xl">
				<div class="absolute -right-4 -top-4 h-16 w-16 rounded-full bg-white/20"></div>
				<div class="relative">
					<div class="mb-2 text-sm font-medium opacity-90">Siswa Laki-laki</div>
					<div class="text-3xl font-bold">{{ \App\Models\Student::where('jk', 'L')->count() }}</div>
					<div class="mt-1 text-xs opacity-75">Total siswa L</div>
				</div>
			</div>

			<div class="group relative overflow-hidden rounded-xl bg-gradient-to-br from-pink-500 to-pink-600 p-6 text-white shadow-lg transition-all hover:scale-105 hover:shadow-xl">
				<div class="absolute -right-4 -top-4 h-16 w-16 rounded-full bg-white/20"></div>
				<div class="relative">
					<div class="mb-2 text-sm font-medium opacity-90">Siswa Perempuan</div>
					<div class="text-3xl font-bold">{{ \App\Models\Student::where('jk', 'P')->count() }}</div>
					<div class="mt-1 text-xs opacity-75">Total siswa P</div>
				</div>
			</div>

			<div class="group relative overflow-hidden rounded-xl bg-gradient-to-br from-purple-500 to-purple-600 p-6 text-white shadow-lg transition-all hover:scale-105 hover:shadow-xl">
				<div class="absolute -right-4 -top-4 h-16 w-16 rounded-full bg-white/20"></div>
				<div class="relative">
					<div class="mb-2 text-sm font-medium opacity-90">Data Terbaru</div>
					<div class="text-3xl font-bold">{{ \App\Models\Student::whereDate('created_at', today())->count() }}</div>
					<div class="mt-1 text-xs opacity-75">Siswa hari ini</div>
				</div>
			</div>
		</div>

		<!-- Quick Actions -->
		<div class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
			<h2 class="mb-4 text-lg font-semibold text-gray-900">Aksi Cepat</h2>
			<div class="grid gap-4 sm:grid-cols-2">
				<a href="{{ route('admin.siswa.create') }}" class="group flex items-center gap-3 rounded-lg border border-dashed border-gray-300 p-4 transition-all hover:border-indigo-500 hover:bg-indigo-50">
					<div class="flex h-10 w-10 items-center justify-center rounded-lg bg-indigo-100 text-indigo-600 group-hover:bg-indigo-600 group-hover:text-white">
						<svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
						</svg>
					</div>
					<div>
						<div class="font-medium text-gray-900">Tambah Siswa Baru</div>
						<div class="text-sm text-gray-500">Daftarkan siswa baru ke sistem</div>
					</div>
				</a>

				<a href="{{ route('admin.siswa.index') }}" class="group flex items-center gap-3 rounded-lg border border-dashed border-gray-300 p-4 transition-all hover:border-emerald-500 hover:bg-emerald-50">
					<div class="flex h-10 w-10 items-center justify-center rounded-lg bg-emerald-100 text-emerald-600 group-hover:bg-emerald-600 group-hover:text-white">
						<svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
						</svg>
					</div>
					<div>
						<div class="font-medium text-gray-900">Kelola Data Siswa</div>
						<div class="text-sm text-gray-500">Lihat dan kelola data siswa</div>
					</div>
				</a>
			</div>
		</div>

		<!-- Recent Students -->
		<div class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
			<div class="mb-4 flex items-center justify-between">
				<h2 class="text-lg font-semibold text-gray-900">Siswa Terbaru</h2>
				<a href="{{ route('admin.siswa.index') }}" class="text-sm text-indigo-600 hover:text-indigo-700">Lihat Semua</a>
			</div>
			<div class="overflow-hidden">
				@php
					$recentStudents = \App\Models\Student::latest()->take(5)->get();
				@endphp
				@if($recentStudents->count() > 0)
					<div class="space-y-3">
						@foreach($recentStudents as $student)
							<div class="flex items-center justify-between rounded-lg border border-gray-100 p-3">
								<div class="flex items-center gap-3">
									<div class="flex h-10 w-10 items-center justify-center rounded-full bg-gray-100 text-sm font-medium text-gray-600">
										{{ substr($student->nama, 0, 2) }}
									</div>
									<div>
										<div class="font-medium text-gray-900">{{ $student->nama }}</div>
										<div class="text-sm text-gray-500">NIPD: {{ $student->nipd }}</div>
									</div>
								</div>
								<div class="text-right">
									<div class="text-sm text-gray-900">{{ $student->jk === 'L' ? 'Laki-laki' : 'Perempuan' }}</div>
									<div class="text-xs text-gray-500">{{ $student->created_at->diffForHumans() }}</div>
								</div>
							</div>
						@endforeach
					</div>
				@else
					<div class="py-8 text-center text-gray-500">
						<svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
						</svg>
						<p class="mt-2">Belum ada data siswa</p>
					</div>
				@endif
			</div>
		</div>
	</div>
</x-layouts.app> 