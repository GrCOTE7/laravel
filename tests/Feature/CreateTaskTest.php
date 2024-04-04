<?php

/**
 * (ɔ) GrCOTE7 - 1990-2024
 */

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @internal
 *
 * @coversNothing
 */
class CreateTaskTest extends TestCase
{
	use RefreshDatabase;

	public function testAuthCanCreateTask()
	{
		$user = User::factory(User::class)->create();

		$response = $this->actingAs($user)->post('/tuto/todo', [
			'title'  => 'Ma nouvelle tâche',
			'detail' => 'Tous les détails de ma nouvelle tâche',
		]);

		$this->assertDatabaseHas('tasks', [
			'title' => 'Ma nouvelle tâche',
		]);

		$this->get('/tuto/todo')->assertSee('Ma nouvelle tâche');
	}
}
