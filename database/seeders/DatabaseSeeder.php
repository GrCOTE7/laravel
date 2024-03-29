<?php

/**
 * (ɔ) GrCOTE7 - 1990-2024
 */

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Actor;
use App\Models\Category;
use App\Models\Film;
use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 */
	public function run(): void
	{
		User::factory(10)->create();

		Actor::factory()->count(10)->create();
		$categories = [
			'Comédie',
			'Drame',
			'Action',
			'Fantastique',
			'Horreur',
			'Animation',
			'Espionnage',
			'Guerre',
			'Policier',
			'Pornographique',
		];
		foreach ($categories as $category) {
			Category::create(['name' => $category, 'slug' => str()->slug($category)]);
		}
		$ids = range(1, 10);
		Film::factory()->count(40)->create()->each(function ($film) use ($ids) {
			shuffle($ids);
			$film->categories()->attach(array_slice($ids, 0, rand(1, 4)));
			shuffle($ids);
			$film->actors()->attach(array_slice($ids, 0, rand(1, 4)));
		});

		$this->call(ImportSeeder::class);

		Team::factory()->count(5)->create();

		$u                  = User::find(15);
		$u->name            = 'Lionel';
		$u->email           = 'hello@example.com';
		$u->password        = bcrypt('password');
		$u->current_team_id = 1;
		$u->save();

		$t          = Team::find(1);
		$t->user_id = 15;
		$t->save();
	}
}
