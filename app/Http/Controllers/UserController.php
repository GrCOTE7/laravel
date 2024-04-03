<?php

/**
 * (ɔ) GrCOTE7 - 1990-2024
 */

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
	public function __construct()
	{
		$this->authorizeResource(User::class, 'user');
	}

	public function index(): View
	{
		// $users = User::all()->each(
		// 	function ($u) {
		// 		$u->note = $u->id + 1e3;
		// 		$u->save();
		// 	}
		// );

		$users = User::all();

		return view('pages.tuto.user.infos')->with('users', $users);
	}

	public function store(Request $request): View
	{
		// dd($request);
		$request->validate(
			[
				'nom' => 'bail|required|between:2,32|exists:users,name',
			],
			// [
			// 	'nom.exists' => 'Le nom entré n\'existe pas dans notre base de données.',
			// ]
		);

		$userChoice = $request->nom;
		$users      = User::all();
		$code       = session('code');

		return view('pages.tuto.user.user', [
			'userChoice' => $userChoice,
			'users'      => $users,
			'code'       => $code,
		]);
	}

	public function edit(User $user)
	{
		// $this->authorize('update', $user);

		return 'Formulaire pour modifier #' . $user->id;
	}

	public function update(Request $request, User $user)
	{
		// $this->authorize('update', $user);

		return 'Ok on a modifié !';
	}
}
