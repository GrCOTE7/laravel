<?php

/**
 * (ɔ) GrCOTE7 - 1990-2024
 */

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

/**
 * @internal
 *
 * @coversNothing
 */
class ExampleTest extends TestCase
{
	/**
	 * A basic test example.
	 */
	public function testTheApplicationReturnsASuccessfulResponse(): void
	{
		// Créer un utilisateur de test
		$user = User::factory()->create();

		// Simuler l'authentification de l'utilisateur
		// $this->actingAs($user);

		$response = $this->get('/');

		$response->assertStatus(200);
	}
}
