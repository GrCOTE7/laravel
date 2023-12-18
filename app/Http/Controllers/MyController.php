<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\View\View;

class MyController extends Controller
{
	public function index(mixed $data = null): View
	{
		session(['maVar' => null]);
		$var = config('app.name');


		define('DATA', $this->getFrDate());

		return view('test')->withDataSend(DATA);
	}

	public function users($id = null)
	{
		$users = User::all();

		return view('test', ['dataSend' => $users]);
	}

	private function getFrDate()
	{
		date_default_timezone_set('Europe/Paris');
        $date = Carbon::now()->locale('fr');
        return ucfirst($date->isoFormat('LLLL'));
	}
}
