<?php
namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\View\View;

class MyController extends Controller {

	public function index(mixed $data = null): View {
		$var = config('app.name');
		// var_dump($var);

		// Storage::disk('public')->put('recettes2.txt', 'Contenu du fichier');
		date_default_timezone_set('Europe/Paris');

        // $date= Carbon::now()->locale('fr_FR');
        $date= Carbon::now()->locale('de');

		define('DATA', $data ?? ucfirst($date->isoFormat('LLLL')));
		return view('test')->withDataSend(DATA);
	}

	public function users($id = null) {
		$users = User::all();
		return view('test', ['dataSend'=> $users]);
	}
}