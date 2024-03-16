<?php

/**
 * (ɔ) GrCOTE7 - 1990-2024
 */

namespace App\Http\Controllers;

use App\Http\Tools\Gc7;
use App\Mail\TestMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
	public function __construct()
	{
		$this->app = env('APP_NAME', 'oOo');
	}

	/**
	 * Handle the incoming request.
	 */
	public function index()
	{
		// Gc7::aff(config('app.locale'), 'Config App locale');
		$appName = $this->app;

		return view('pages.mail', compact('appName'));
	}

	public function send()
	{
		$appName = $this->app;
		// Code d'envoi
		Mail::to('administrateur@chezmoi.com')
			->send(new TestMail());

		$msg = 'Email envoyé !';

		return view('pages.mail', compact('appName', 'msg'));
	}
}
