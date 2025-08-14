<x-layouts.app :title="'Manajemen Siswa'">
	<div class="space-y-4">
		<div class="flex items-center justify-between">
			<h1 class="text-xl font-semibold text-gray-900">Manajemen Siswa</h1>
			<div class="flex items-center gap-2">
				<a href="{{ route('admin.siswa.create') }}" class="inline-flex items-center gap-2 rounded-md bg-indigo-600 px-3 py-2 text-sm font-medium text-white hover:bg-indigo-700">
					<svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
					Tambah Siswa
				</a>
			</div>
		</div>

		<div class="rounded-lg bg-white p-3 shadow-sm ring-1 ring-gray-200">
			<form method="GET" class="flex items-center gap-2">
				<div class="relative flex-1">
					<div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-2">
						<svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
					</div>
					<input type="text" name="q" value="{{ $search ?? '' }}" placeholder="Cari nama, NIPD, NISN, atau NIK..." class="block w-full rounded-md border-gray-300 pl-7 pr-2 text-sm leading-8 focus:border-indigo-500 focus:ring-indigo-500" />
				</div>
				<button class="rounded-md bg-gray-600 px-3 py-1.5 text-xs font-medium text-white hover:bg-gray-700">Cari</button>
				@if($search)
					<a href="{{ route('admin.siswa.index') }}" class="rounded-md border px-3 py-1.5 text-xs">Reset</a>
				@endif
			</form>
		</div>

		<div class="mt-2 flex items-center gap-2">
			<form id="bulkDeleteForm" method="POST" action="{{ route('admin.siswa.bulk-destroy') }}" onsubmit="return confirm('Hapus semua data terpilih?')" class="flex items-center gap-2">
				@csrf
				@method('DELETE')
				<input type="hidden" name="ids" id="bulkIds" />
				<button type="submit" id="bulkDeleteBtn" disabled class="hidden items-center gap-2 rounded-md bg-red-600 px-3 py-2 text-sm font-medium text-white hover:bg-red-700 disabled:cursor-not-allowed">
					<svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
					<span>Hapus Terpilih</span>
				</button>
				<!-- <button type="button" id="selectAllBtn" class="rounded-md border px-3 py-1.5 text-xs hidden">Pilih Semua</button> -->
			</form>
		</div>

		@if (session('success'))
			<div class="rounded-md bg-emerald-50 p-3 text-sm font-medium text-emerald-800 ring-1 ring-emerald-200">{{ session('success') }}</div>
		@endif

		<div class="overflow-hidden rounded-lg bg-white shadow-sm ring-1 ring-gray-100">
			<div class="overflow-x-auto">
				<table class="min-w-full">
					<thead>
						<tr class="bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200">
							<th class="w-10 px-3 py-3">
								<input id="selectAll" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" />
							</th>
							<th class="w-14 px-3 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-600">No</th>
							<th class="px-3 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-600">Nama</th>
							<th class="px-3 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-600">JK</th>
							<th class="px-3 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-600">NIPD</th>
							<th class="px-3 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-600">NISN</th>
							<th class="px-3 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-600">Tempat Lahir</th>
							<th class="px-3 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-600">Tanggal Lahir</th>
							<th class="px-3 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-600">Alamat</th>
							<th class="px-3 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-600">Aksi</th>
						</tr>
					</thead>
					<tbody class="divide-y divide-gray-100" id="studentTableBody">
						@forelse ($students as $student)
							<tr class="hover:bg-blue-50/50 transition-colors {{ $loop->even ? 'bg-gray-50/30' : 'bg-white' }}">
								<td class="px-3 py-2.5">
									<input type="checkbox" value="{{ $student->id }}" class="rowCheckbox h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" />
								</td>
								<td class="px-3 py-2.5 text-xs text-gray-500 font-medium">{{ $students->firstItem() + $loop->index }}</td>
								<td class="px-3 py-2.5 font-medium text-gray-900 text-sm">{{ $student->nama }}</td>
								<td class="px-3 py-2.5">
									<span class="inline-flex items-center rounded-full px-2 py-0.5 text-xs font-medium {{ $student->jk==='L' ? 'bg-blue-50 text-blue-700 ring-1 ring-blue-600/20' : 'bg-pink-50 text-pink-700 ring-1 ring-pink-600/20' }}">{{ $student->jk }}</span>
								</td>
								<td class="px-3 py-2.5 text-sm text-gray-700 font-mono">{{ $student->nipd }}</td>
								<td class="px-3 py-2.5 text-sm text-gray-700 font-mono">{{ $student->nisn }}</td>
								<td class="px-3 py-2.5 text-sm text-gray-700">{{ $student->tempat_lahir }}</td>
								<td class="px-3 py-2.5 text-sm text-gray-700">{{ \Illuminate\Support\Carbon::parse($student->tanggal_lahir)->format('d/m/Y') }}</td>
								<td class="px-3 py-2.5"><div class="max-w-32 truncate text-sm text-gray-700" title="{{ $student->alamat }}">{{ $student->alamat }}</div></td>
								<td class="px-3 py-2.5">
									<div class="flex gap-1.5">
										<a href="{{ route('admin.siswa.edit', $student) }}" class="inline-flex items-center rounded-md bg-amber-50 px-2 py-1 text-xs font-medium text-amber-700 ring-1 ring-amber-700/10 hover:bg-amber-100">
											<svg class="mr-1 h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
											Edit
										</a>
										<form method="POST" action="{{ route('admin.siswa.destroy', $student) }}" onsubmit="return confirm('Hapus {{ $student->nama }}?')">
											@csrf
											@method('DELETE')
											<button class="inline-flex items-center rounded-md bg-red-50 px-2 py-1 text-xs font-medium text-red-700 ring-1 ring-red-700/10 hover:bg-red-100">
												<svg class="mr-1 h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
												Hapus
											</button>
										</form>
									</div>
								</td>
							</tr>
						@empty
							<tr>
								<td colspan="10" class="px-4 py-12 text-center">
									<svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 0 19.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 14 0zM7 10a2 2 0 11-4 0 2 2 0 14 0z"/></svg>
									<p class="text-sm text-gray-500">
										@if($search)
											Tidak ditemukan siswa. <a href="{{ route('admin.siswa.index') }}" class="text-indigo-600">Reset pencarian</a>
										@else
											Belum ada siswa. <a href="{{ route('admin.siswa.create') }}" class="text-indigo-600">Tambah siswa pertama</a>
										@endif
									</p>
								</td>
							</tr>
						@endforelse
					</tbody>
				</table>
			</div>
		</div>

		@if($students->hasPages())
			<div class="pt-2">{{ $students->links() }}</div>
		@endif
	</div>

	<script>
		document.addEventListener('DOMContentLoaded', function () {
			const selectAll = document.getElementById('selectAll');
			const rowCheckboxes = Array.from(document.querySelectorAll('.rowCheckbox'));
			const bulkBtn = document.getElementById('bulkDeleteBtn');
			const bulkIdsInput = document.getElementById('bulkIds');
			const bulkForm = document.getElementById('bulkDeleteForm');
			const selectAllBtn = document.getElementById('selectAllBtn');

			function updateBulkState() {
				const selected = rowCheckboxes.filter(cb => cb.checked).map(cb => cb.value);
				const hasSelected = selected.length > 0;
				bulkBtn.disabled = !hasSelected;
				bulkBtn.classList.toggle('opacity-50', !hasSelected);
				if (hasSelected) {
					bulkBtn.classList.remove('hidden');
					bulkBtn.classList.add('inline-flex');
				} else {
					bulkBtn.classList.add('hidden');
					bulkBtn.classList.remove('inline-flex');
				}
				// kirim sebagai JSON string agar mudah diparse di backend
				bulkIdsInput.value = JSON.stringify(selected);
				// tampilkan tombol pilih semua jika minimal 1 dipilih
				if (selectAllBtn) {
					selectAllBtn.classList.toggle('hidden', !hasSelected);
				}
			}

			selectAll?.addEventListener('change', function (e) {
				rowCheckboxes.forEach(cb => { cb.checked = e.target.checked; });
				updateBulkState();
			});

			rowCheckboxes.forEach(cb => cb.addEventListener('change', updateBulkState));

			selectAllBtn?.addEventListener('click', function () {
				rowCheckboxes.forEach(cb => { cb.checked = true; });
				if (selectAll) selectAll.checked = true;
				updateBulkState();
			});

			bulkForm.addEventListener('submit', function (e) {
				// Ubah input ter-hidden menjadi array ids[] agar tervalidasi sebagai array di Laravel
				try {
					const arr = JSON.parse(bulkIdsInput.value || '[]');
					bulkIdsInput.removeAttribute('name');
					arr.forEach((id) => {
						const hidden = document.createElement('input');
						hidden.type = 'hidden';
						hidden.name = 'ids[]';
						hidden.value = id;
						bulkForm.appendChild(hidden);
					});
				} catch (_) {}
			});

			// sinkronkan state pada awal load (antisipasi restore state browser)
			updateBulkState();
		});
	</script>
</x-layouts.app>
