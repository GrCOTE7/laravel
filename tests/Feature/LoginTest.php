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
class LoginTest extends TestCase
{
	use RefreshDatabase;
	public const HOME  = 'dashboard';
	public const LOGIN = 'login';

	/**
	 * A basic feature test example.
	 */
	public function testLoginScreenCanBeRendered(): void
	{
		$response = $this->get('/login');

		$response->assertStatus(200);
	}

	public function testUsersCanAuthenticateUsingTheLoginScreen()
	{
		$user     = User::factory()->create();
		$response = $this->post('/login', [
			'email'    => $user->email,
			'password' => 'password',
		]);
		$this->assertAuthenticated();
		$response->assertRedirect(self::HOME);
	}

	public function testUsersCanNotAuthenticateWithInvalidPassword()
	{
		$user     = User::factory()->create();
		$response = $this->post('/login', [
			'email'    => $user->email,
			'password' => 'passwordFalse',
		]);
		$this->assertGuest();
		$response->assertRedirect('/');
	}
}
