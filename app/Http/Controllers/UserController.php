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
	public function create(): View
	{
		$users = User::all();

        // session()->flush(); // Efface all sessions
		session(['code' => 777]);
        session()->forget('code');

		return view('pages.tuto.user.infos');
	}

	public function store(Request $request): View
	{
		// var_dump($request);
		$users = User::all();
        $code = session('code');

		return view('pages.tuto.user.user', ['data' => $users, 'code'=>$code]);
	}
}
