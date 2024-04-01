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

	public function notifs()
	{
		// session()->flush(); // Efface all sessions
		$alerts = ['code', 'success', 'danger', 'info', 'warning', 'primary', 'secondary', 'light', 'dark'];
		foreach ($alerts as $alert) {
			session(["{$alert}" => 'Txt for ' . $alert]);
		}

		$data = '<x-alert>
                In my Vue (Here the slot in a app/view/component)</i>
            </x-alert>';

		return view('pages.test', compact('data'));
	}

	public function article($n)
	{
		return view('pages.tuto.article')->withNumero($n);
	}

	public function component()
	{
		return view('pages.test');
	}
}
