<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
	use HasFactory;

	protected $fillable = [
		'nama',
		'nipd',
		'jk',
		'nisn',
		'tempat_lahir',
		'tanggal_lahir',
		'nik',
		'agama',
		'alamat',
		'rt',
		'rw',
		'dusun',
		'kelurahan',
		'kecamatan',
		'kode_pos',
	];
} 