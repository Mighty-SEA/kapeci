<x-layouts.app :title="'Edit Siswa'">
	<div class="space-y-4">
		<!-- Header -->
		<div class="flex items-center gap-3">
			<a href="{{ route('admin.siswa.index') }}" class="rounded-lg border border-gray-300 p-2 text-gray-500 hover:bg-gray-50 hover:text-gray-700">
				<svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
				</svg>
			</a>
			<div>
				<h1 class="text-xl font-semibold text-gray-900">Edit Siswa</h1>
				<p class="text-sm text-gray-600">Ubah data siswa {{ $student->nama }}</p>
			</div>
		</div>

		<!-- Validation Errors -->
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

		<!-- Form -->
		<form method="POST" action="{{ route('admin.siswa.update', $student) }}" class="space-y-6">
			@csrf
			@method('PUT')
			
			<!-- Data Pribadi -->
			<div class="bg-white rounded-lg border border-gray-200 shadow-sm">
				<div class="border-b border-gray-200 bg-gray-50 px-4 py-3 rounded-t-lg">
					<h3 class="text-sm font-medium text-gray-900">Data Pribadi</h3>
				</div>
				<div class="p-4 grid gap-4 sm:grid-cols-2">
					<div>
						<label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
						<input name="nama" value="{{ old('nama', $student->nama) }}" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm @error('nama') border-red-300 focus:border-red-500 focus:ring-red-500 @enderror" required>
					</div>
					<div>
						<label class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin <span class="text-red-500">*</span></label>
						<select name="jk" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm @error('jk') border-red-300 focus:border-red-500 focus:ring-red-500 @enderror" required>
							<option value="L" @selected(old('jk', $student->jk)==='L')>Laki-laki</option>
							<option value="P" @selected(old('jk', $student->jk)==='P')>Perempuan</option>
						</select>
					</div>
					<div>
						<label class="block text-sm font-medium text-gray-700 mb-1">Tempat Lahir <span class="text-red-500">*</span></label>
						<input name="tempat_lahir" value="{{ old('tempat_lahir', $student->tempat_lahir) }}" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm @error('tempat_lahir') border-red-300 focus:border-red-500 focus:ring-red-500 @enderror" required>
					</div>
					<div>
						<label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir <span class="text-red-500">*</span></label>
						<input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $student->tanggal_lahir) }}" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm @error('tanggal_lahir') border-red-300 focus:border-red-500 focus:ring-red-500 @enderror" required>
					</div>
					<div class="sm:col-span-2">
						<label class="block text-sm font-medium text-gray-700 mb-1">Agama <span class="text-red-500">*</span></label>
						<select name="agama" class="block w-full max-w-xs rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm @error('agama') border-red-300 focus:border-red-500 focus:ring-red-500 @enderror" required>
							<option value="Islam" @selected(old('agama', $student->agama)==='Islam')>Islam</option>
							<option value="Kristen" @selected(old('agama', $student->agama)==='Kristen')>Kristen</option>
							<option value="Katolik" @selected(old('agama', $student->agama)==='Katolik')>Katolik</option>
							<option value="Hindu" @selected(old('agama', $student->agama)==='Hindu')>Hindu</option>
							<option value="Buddha" @selected(old('agama', $student->agama)==='Buddha')>Buddha</option>
							<option value="Konghucu" @selected(old('agama', $student->agama)==='Konghucu')>Konghucu</option>
						</select>
					</div>
				</div>
			</div>

			<!-- Data Identitas -->
			<div class="bg-white rounded-lg border border-gray-200 shadow-sm">
				<div class="border-b border-gray-200 bg-gray-50 px-4 py-3">
					<h3 class="text-sm font-medium text-gray-900">Data Identitas</h3>
				</div>
				<div class="p-4 grid gap-4 sm:grid-cols-3">
					<div>
						<label class="block text-sm font-medium text-gray-700 mb-1">NIPD <span class="text-red-500">*</span></label>
						<input name="nipd" value="{{ old('nipd', $student->nipd) }}" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm font-mono @error('nipd') border-red-300 focus:border-red-500 focus:ring-red-500 @enderror" required>
					</div>
					<div>
						<label class="block text-sm font-medium text-gray-700 mb-1">NISN <span class="text-red-500">*</span></label>
						<input name="nisn" value="{{ old('nisn', $student->nisn) }}" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm font-mono @error('nisn') border-red-300 focus:border-red-500 focus:ring-red-500 @enderror" required>
					</div>
					<div>
						<label class="block text-sm font-medium text-gray-700 mb-1">NIK <span class="text-red-500">*</span></label>
						<input name="nik" value="{{ old('nik', $student->nik) }}" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm font-mono @error('nik') border-red-300 focus:border-red-500 focus:ring-red-500 @enderror" required>
					</div>
				</div>
			</div>

			<!-- Data Alamat -->
			<div class="bg-white rounded-lg border border-gray-200 shadow-sm">
				<div class="border-b border-gray-200 bg-gray-50 px-4 py-3">
					<h3 class="text-sm font-medium text-gray-900">Data Alamat</h3>
				</div>
				<div class="p-4 space-y-4">
					<div>
						<label class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap <span class="text-red-500">*</span></label>
						<textarea name="alamat" rows="2" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm @error('alamat') border-red-300 focus:border-red-500 focus:ring-red-500 @enderror" required>{{ old('alamat', $student->alamat) }}</textarea>
					</div>
					<div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-6">
						<div>
							<label class="block text-sm font-medium text-gray-700 mb-1">RT</label>
							<input name="rt" value="{{ old('rt', $student->rt) }}" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm @error('rt') border-red-300 focus:border-red-500 focus:ring-red-500 @enderror">
						</div>
						<div>
							<label class="block text-sm font-medium text-gray-700 mb-1">RW</label>
							<input name="rw" value="{{ old('rw', $student->rw) }}" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm @error('rw') border-red-300 focus:border-red-500 focus:ring-red-500 @enderror">
						</div>
						<div>
							<label class="block text-sm font-medium text-gray-700 mb-1">Dusun</label>
							<input name="dusun" value="{{ old('dusun', $student->dusun) }}" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm @error('dusun') border-red-300 focus:border-red-500 focus:ring-red-500 @enderror">
						</div>
						<div>
							<label class="block text-sm font-medium text-gray-700 mb-1">Kelurahan</label>
							<input name="kelurahan" value="{{ old('kelurahan', $student->kelurahan) }}" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm @error('kelurahan') border-red-300 focus:border-red-500 focus:ring-red-500 @enderror">
						</div>
						<div>
							<label class="block text-sm font-medium text-gray-700 mb-1">Kecamatan</label>
							<input name="kecamatan" value="{{ old('kecamatan', $student->kecamatan) }}" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm @error('kecamatan') border-red-300 focus:border-red-500 focus:ring-red-500 @enderror">
						</div>
						<div>
							<label class="block text-sm font-medium text-gray-700 mb-1">Kode Pos</label>
							<input name="kode_pos" value="{{ old('kode_pos', $student->kode_pos) }}" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm @error('kode_pos') border-red-300 focus:border-red-500 focus:ring-red-500 @enderror">
						</div>
					</div>
				</div>
			</div>

			<!-- Actions -->
			<div class="flex items-center justify-end gap-3 bg-gray-50 rounded-lg p-4 border border-gray-200">
				<a href="{{ route('admin.siswa.index') }}" class="inline-flex items-center gap-2 rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
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