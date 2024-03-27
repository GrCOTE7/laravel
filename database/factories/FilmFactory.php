<?php

/**
 * (ɔ) GrCOTE7 - 1990-2024
 */

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Film>
 */
class FilmFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition(): array
	{
		return [
			'title'       => fake()->sentence(2, true),
			'year'        => fake()->year,
			'description' => fake()->paragraph(),
		];
	}
}
