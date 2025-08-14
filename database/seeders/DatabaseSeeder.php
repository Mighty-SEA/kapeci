<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 */
	public function run(): void
	{
		User::query()->updateOrCreate(
			['email' => 'admin@sekolah.test'],
			[
				'name' => 'Admin',
				'username' => 'admin',
				'password' => Hash::make('password'),
			]
		);

		$this->call([
			StudentSeeder::class,
		]);
	}
}
