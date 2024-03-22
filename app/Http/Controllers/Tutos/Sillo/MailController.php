<?php

/**
 * (ɔ) GrCOTE7 - 1990-2024
 */

namespace App\Http\Controllers\Tutos\Sillo;

use App\Http\Controllers\Controller;
use App\Mail\TutoMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

/**
 * Class MailController.
 *
 * @property string $app
 */
class MailController extends Controller
{
	public function __construct()
	{
		$this->app = config('app.name', 'L11');
	}

	/**
	 * Handle the incoming request.
	 */
	public function index()
	{
		$appName = $this->app;

		$vueEmail = new TutoMail();
		// $vueEmail = new TestMail('Oki (ou rien possible)');

		return view('pages.tuto.mail.mail', compact('appName', 'vueEmail'));
	}

	public function view()
	{
		$appName = $this->app;

		$vueEmail = new TutoMail();
		// $vueEmail = new TestMail('Oki (ou rien possible)');

		echo '<a href="' . route('mail') . '" style="margin-left:10px">Retour</a><hr>';

		return $vueEmail;
	}

	public function send($data = null)
	{
		$appName = $this->app;

		// Code d'envoi
		Mail::to('administrateur@chezmoi.com')
			->send(new TutoMail($data));

		$msg = $data . '<hr>Email envoyé !';

		return view('pages.tuto.mail.mail', compact('appName', 'msg'));
	}
}
