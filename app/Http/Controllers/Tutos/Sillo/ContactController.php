<?php

/**
 * (ɔ) GrCOTE7 - 1990-2024
 */

namespace App\Http\Controllers\Tutos\Sillo;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use Illuminate\View\View;

class ContactController extends Controller
{
	public function create(): View
	{
		return view('pages.tuto.contact.contact');
	}

	public function store(ContactRequest $request): View
	{
		return view('pages.tuto.contact.confirm');
	}
}
