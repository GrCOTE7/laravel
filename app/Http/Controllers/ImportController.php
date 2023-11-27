<?php

namespace App\Http\Controllers;

class ImportController extends Controller
{
	public function index()
	{
		$rep = 'Ready';

		return view('pages.import', compact('rep'));
	}
}
