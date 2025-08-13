<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Student>
 */
class StudentFactory extends Factory
{
	protected $model = Student::class;

	public function definition(): array
	{
		$jk = fake()->randomElement(['L','P']);
		return [
			'nama' => fake()->name($jk === 'L' ? 'male' : 'female'),
			'nipd' => (string) fake()->unique()->numerify('#####'),
			'jk' => $jk,
			'nisn' => (string) fake()->unique()->numerify('##########'),
			'tempat_lahir' => fake()->city(),
			'tanggal_lahir' => fake()->date('Y-m-d','2015-12-31'),
			'nik' => (string) fake()->unique()->numerify('################'),
			'agama' => fake()->randomElement(['Islam','Kristen','Katolik','Hindu','Buddha','Konghucu']),
			'alamat' => fake()->streetAddress(),
			'rt' => (string) fake()->numberBetween(1,20),
			'rw' => (string) fake()->numberBetween(1,20),
			'dusun' => fake()->streetName(),
			'kelurahan' => fake()->citySuffix(),
			'kecamatan' => fake()->citySuffix(),
			'kode_pos' => fake()->postcode(),
		];
	}
} 