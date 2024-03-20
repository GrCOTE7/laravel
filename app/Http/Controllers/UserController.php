<?php

/**
 * (ɔ) GrCOTE7 - 1990-2024
 */

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
	public function index($id = null)
	{
		$users = User::all();

		return view('pages.tuto.user', ['data' => $users]);
	}
}
