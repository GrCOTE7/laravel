<?php

/**
 * (ɔ) GrCOTE7 - 1990-2024
 */

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
	public function infos($id = null)
	{
		$users = User::all();

		return view('pages.tuto.userInfos', ['data' => $users]);
	}
	public function store($id = null)
	{
		$users = User::all();

		return view('pages.tuto.userInfos', ['data' => $users]);
	}
}
