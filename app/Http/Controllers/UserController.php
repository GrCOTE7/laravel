<?php

/**
 * (ɔ) GrCOTE7 - 1990-2024
 */

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;

class UserController extends Controller
{
	public function create(): View
	{
		$users = User::all();

		return view('pages.tuto.user.infos');
	}
	public function store(Request $request): string
	{
		$users = User::all();

		return view('pages.tuto.user.user', ['data' => $users]);
	}
}
