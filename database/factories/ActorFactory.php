<?php

/**
 * (ɔ) GrCOTE7 - 1990-2024
 */

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Actor>
 */
class ActorFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition(): array
	{
		$name = fake()->name();

		return [
			'name' => $name,
			'slug' => str()->slug($name),
		];
	}
}
