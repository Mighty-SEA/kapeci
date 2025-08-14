<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
	public function index(Request $request)
	{
		$query = Student::query();

		$search = $request->string('q')->toString();
		if ($search !== '') {
			$query->where(function ($q) use ($search) {
				$q->where('nama', 'like', "%{$search}%")
					->orWhere('nipd', 'like', "%{$search}%")
					->orWhere('nisn', 'like', "%{$search}%")
					->orWhere('nik', 'like', "%{$search}%");
			});
		}

		$students = $query->orderBy('nama')->paginate(10)->withQueryString();
		return view('admin.siswa.index', compact('students', 'search'));
	}

	public function create()
	{
		return view('admin.siswa.create');
	}

	public function store(Request $request)
	{
		$data = $this->validateData($request);
		Student::create($data);
		return redirect()->route('admin.siswa.index')->with('success', 'Data siswa berhasil ditambahkan.');
	}

	public function edit(Student $siswa)
	{
		return view('admin.siswa.edit', ['student' => $siswa]);
	}

	public function update(Request $request, Student $siswa)
	{
		$data = $this->validateData($request, $siswa->id);
		$siswa->update($data);
		return redirect()->route('admin.siswa.index')->with('success', 'Data siswa berhasil diperbarui.');
	}

	public function destroy(Student $siswa)
	{
		$siswa->delete();
		return redirect()->route('admin.siswa.index')->with('success', 'Data siswa berhasil dihapus.');
	}

	public function bulkDestroy(Request $request)
	{
		$validated = $request->validate([
			'ids' => ['required', 'array'],
			'ids.*' => ['integer', 'exists:students,id'],
		]);

		Student::whereIn('id', $validated['ids'])->delete();

		return redirect()->route('admin.siswa.index')->with('success', 'Data siswa terpilih berhasil dihapus.');
	}

	private function validateData(Request $request, ?int $ignoreId = null): array
	{
		$uniqueNipd = 'unique:students,nipd';
		$uniqueNisn = 'unique:students,nisn';
		$uniqueNik = 'unique:students,nik';
		if ($ignoreId) {
			$uniqueNipd .= ",{$ignoreId}";
			$uniqueNisn .= ",{$ignoreId}";
			$uniqueNik .= ",{$ignoreId}";
		}

		return $request->validate([
			'nama' => ['required', 'string', 'max:255'],
			'nipd' => ['required', 'string', 'max:100', $uniqueNipd],
			'jk' => ['required', 'string', 'max:10'],
			'nisn' => ['required', 'string', 'max:100', $uniqueNisn],
			'tempat_lahir' => ['required', 'string', 'max:255'],
			'tanggal_lahir' => ['required', 'date'],
			'nik' => ['required', 'string', 'max:100', $uniqueNik],
			'agama' => ['required', 'string', 'max:100'],
			'alamat' => ['required', 'string', 'max:255'],
			'rt' => ['nullable', 'string', 'max:10'],
			'rw' => ['nullable', 'string', 'max:10'],
			'dusun' => ['nullable', 'string', 'max:255'],
			'kelurahan' => ['nullable', 'string', 'max:255'],
			'kecamatan' => ['nullable', 'string', 'max:255'],
			'kode_pos' => ['nullable', 'string', 'max:10'],
		]);
	}
} 