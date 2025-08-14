<x-layouts.app :title="'Pengaturan Akun'">
	<div class="space-y-4">
		<!-- Header -->
		<div class="flex items-center gap-3">
			<a href="{{ route('admin.dashboard') }}" class="rounded-lg border border-gray-300 p-2 text-gray-500 hover:bg-gray-50 hover:text-gray-700">
				<svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
				</svg>
			</a>
			<div>
				<h1 class="text-xl font-semibold text-gray-900">Pengaturan Akun</h1>
				<p class="text-sm text-gray-600">Perbarui informasi akun Anda</p>
			</div>
		</div>

		@if (session('status'))
			<div class="rounded-md bg-green-50 p-3 text-sm text-green-700 ring-1 ring-green-200">{{ session('status') }}</div>
		@endif

		@if ($errors->any())
			<div class="rounded-md bg-red-50 p-4 border border-red-200">
				<div class="flex">
					<svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
						<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
					</svg>
					<div class="ml-3">
						<h3 class="text-sm font-medium text-red-800">Ada beberapa kesalahan pada form:</h3>
						<ul class="mt-2 list-disc list-inside text-sm text-red-700">
							@foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
				</div>
			</div>
		@endif

		<form method="POST" action="{{ route('account.update') }}" class="space-y-8">
			@csrf
			@method('PUT')

			<!-- Data Akun -->
			<div class="bg-white rounded-xl border-2 border-indigo-200/70 shadow-md ring-2 ring-indigo-300/60 ring-offset-1 ring-offset-white">
				<div class="border-b border-gray-200 bg-gray-50 px-8 py-5 rounded-t-lg">
					<h3 class="text-sm font-medium text-gray-900">Informasi Dasar</h3>
				</div>
				<div class="p-8 grid gap-6 sm:grid-cols-2">
					<div>
						<label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
						<input name="name" value="{{ old('name', $user->name) }}" class="block w-full px-3.5 py-2.5 rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base @error('name') border-red-300 focus:border-red-500 focus:ring-red-500 @enderror" required>
					</div>
					<div>
						<label class="block text-sm font-medium text-gray-700 mb-1">Username <span class="text-red-500">*</span></label>
						<input name="username" value="{{ old('username', $user->username) }}" class="block w-full px-3.5 py-2.5 rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base @error('username') border-red-300 focus:border-red-500 focus:ring-red-500 @enderror" required>
					</div>
					<div class="sm:col-span-2">
						<label class="block text-sm font-medium text-gray-700 mb-1">Email <span class="text-red-500">*</span></label>
						<input type="email" name="email" value="{{ old('email', $user->email) }}" class="block w-full max-w-lg px-3.5 py-2.5 rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base @error('email') border-red-300 focus:border-red-500 focus:ring-red-500 @enderror" required>
					</div>
				</div>
			</div>

			<!-- Ubah Password -->
			<div class="bg-white rounded-xl border-2 border-indigo-200/70 shadow-md ring-2 ring-indigo-300/60 ring-offset-1 ring-offset-white">
				<div class="border-b border-gray-200 bg-gray-50 px-8 py-5">
					<h3 class="text-sm font-medium text-gray-900">Ubah Password</h3>
				</div>
				<div class="p-8 grid gap-6 sm:grid-cols-2">
					<div>
						<label class="block text-sm font-medium text-gray-700 mb-1">Password Baru</label>
						<input type="password" name="password" class="block w-full px-3.5 py-2.5 rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base @error('password') border-red-300 focus:border-red-500 focus:ring-red-500 @enderror">
					</div>
					<div>
						<label class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password</label>
						<input type="password" name="password_confirmation" class="block w-full px-3.5 py-2.5 rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base">
					</div>
				</div>
			</div>

			<!-- Actions -->
			<div class="flex items-center justify-end gap-3 bg-gray-50 rounded-xl p-6 border-2 border-indigo-200/70 ring-2 ring-indigo-300/60 ring-offset-1 ring-offset-white shadow-md">
				<a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-2 rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
					<svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
					</svg>
					Batal
				</a>
				<button type="submit" class="inline-flex items-center gap-2 rounded-md bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-700">
					<svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
					</svg>
					Simpan Perubahan
				</button>
			</div>
		</form>
	</div>
</x-layouts.app> 