<?php

namespace App\Http\Controllers;

use index;

class TestController extends Controller
{
	/**
	 * index.
	 */
	public function index()
	{
		$n    = 10;
		$data = $n % 10;

		return view('pages.test', compact('data'));
	}
}
