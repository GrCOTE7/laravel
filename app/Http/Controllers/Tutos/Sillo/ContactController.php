<?php

/**
 * (ɔ) GrCOTE7 - 1990-2024
 */

namespace App\Http\Controllers\Tutos\Sillo;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
	public function create()
	{
		return view('pages.tuto.contact.create');
	}

	public function store(ContactRequest $request)
	{
		return view('pages.tuto.contact.confirm');
	}
}
