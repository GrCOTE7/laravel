<?php

namespace App\Http\Controllers;

use App\Http\Tools\Gc7;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\View\View;

class MyController extends Controller
{
	public function index(mixed $data = null): View
	{
		ini_set('max_execution_time', '0');
		// $data = (new AdController())->index();

		// $data = (new ScrapController())->index();

		// define('DATA', $this->getFrDate());
		// return view('test')->withDataSend(DATA);

		// $data = Gc7::affData($data ?? null);
        // $data=789;

		return view('pages.test', compact('data'));
	}

	private function getFrDate()
	{
		date_default_timezone_set('Europe/Paris');
		$date = Carbon::now()->locale('fr');

		return ucfirst($date->isoFormat('LLLL'));
	}
}
