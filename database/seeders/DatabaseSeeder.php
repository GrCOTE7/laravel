<?php

/**
 * (ɔ) GrCOTE7 - 1990-2024
 */

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Film;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

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

        Schema::disableForeignKeyConstraints();
        Category::factory()
            ->has(Film::factory()->count(4))
            ->count(10)
            ->create();

		$this->call(ImportSeeder::class);
	}
}
