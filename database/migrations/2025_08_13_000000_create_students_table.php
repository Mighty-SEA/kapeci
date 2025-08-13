<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	public function up(): void
	{
		Schema::create('students', function (Blueprint $table) {
			$table->id();
			$table->string('nama');
			$table->string('nipd')->unique();
			$table->string('jk', 10);
			$table->string('nisn')->unique();
			$table->string('tempat_lahir');
			$table->date('tanggal_lahir');
			$table->string('nik')->unique();
			$table->string('agama');
			$table->string('alamat');
			$table->string('rt', 10)->nullable();
			$table->string('rw', 10)->nullable();
			$table->string('dusun')->nullable();
			$table->string('kelurahan')->nullable();
			$table->string('kecamatan')->nullable();
			$table->string('kode_pos', 10)->nullable();
			$table->timestamps();
		});
	}

	public function down(): void
	{
		Schema::dropIfExists('students');
	}
}; 