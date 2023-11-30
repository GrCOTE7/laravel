<?php

namespace App\Http\Controllers;

use App\Http\Controllers\importOwnerManagerController;

class TestController extends Controller
{
	public function index()
	{
        // $newDates = new importDateManagerController;
        // $newDates->index();
        $newOwner = new importOwnerManagerController;
        $myVar = $newOwner->index();

		return view('pages.test', compact('myVar'));
	}
}
