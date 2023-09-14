<?php

namespace App\Http\Controllers;

class TestController extends Controller
{
	public function index()
	{
		$maVar = session('maVar');

		return view('pages.test', compact('maVar'));
	}

	public function store()
	{
		session(['maVar' => 123]);

		// return to_route('test.index');
		return back();
	}
}
