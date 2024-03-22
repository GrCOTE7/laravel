<?php

/**
 * (ɔ) GrCOTE7 - 1990-2024
 */

namespace App\Http\Controllers;

class TutoController extends Controller
{
	public function tutos()
	{
		return view('pages.tuto.tutos');
	}

	public function welcome()
	{
		return view('welcome');
	}

	public function article($n)
	{
		return view('pages.tuto.article')->withNumero($n);
	}
}
