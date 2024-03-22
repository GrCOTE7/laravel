<?php

/**
 * (ɔ) GrCOTE7 - 1990-2024
 */

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 */
	public function run(): void
	{
		// \App\Models\User::factory(10)->create();

		User::factory()->create([
			'name'     => env('MAIL_USERNAME'),
			'email'    => env('MAIL_FROM_ADDRESS'),
			'password' => md5('123123123'),
		]);

		$this->call(ImportSeeder::class);
	}
}
