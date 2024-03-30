<?php

/**
 * (ɔ) GrCOTE7 - 1990-2024
 */

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Events\Accueil;
use App\Http\Tools\Gc7;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class MyController extends Controller
{
	public function index(mixed $data = null)
	{
		ini_set('max_execution_time', '0');
		// $data = (new AdController())->index();

		// $data = (new ScrapController())->index();

		// define('DATA', $this->getFrDate());
		// return view('test')->withDataSend(DATA);

		// $data = Gc7::affData($data ?? null);
		// $user = auth()->user()?->email;
		// $user = User::inRandomOrder()->first();

		// $data = $teams ?? null;
		return view('pages.test', compact('data'));
	}

	public function logLionel()
	{
        event(new Accueil);
		$user = User::find(15);
		$this->forceLogin($user);
		$ttt = $user->ownedTeam;
		// return $ttt;
		$teams = implode(',', (array) $ttt);

        return view('pages.test');
	}

	private function forceLogin($user)
	{
		Auth::login($user); // Connecter cet utilisateur

		return redirect('/'); // Rediriger vers la page d'accueil
	}

	private function getFrDate()
	{
		date_default_timezone_set('Europe/Paris');
		$date = Carbon::now()->locale('fr');

		return ucfirst($date->isoFormat('LLLL'));
	}
}
