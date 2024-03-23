<?php

/**
 * (ɔ) GrCOTE7 - 1990-2024
 */

namespace App\Http\Controllers\Tutos\Sillo;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use Illuminate\View\View;

class ContactController extends Controller
{
	public function create(): View
	{
		return view('pages.tuto.contact.contact');
	}

	public function store(ContactRequest $request): View
	{
		// $contact          = new Contact();
		// $contact->name    = $request->nom;
		// $contact->email   = $request->email;
		// $contact->message = $request->message;
		// $contact->save();

        // dd(Contact::create ([ // Need fillable fields in model
		// 	'name'    => $request->nom,
		// 	'email'   => $request->email,
		// 	'message' => $request->message,
		// ]));

		Contact::create([ // Need fillable fields in model
			'name'    => $request->nom,
			'email'   => $request->email,
			'message' => $request->message,
		]);


		$data = Contact::get()->last();

		return view('pages.tuto.contact.confirm')->with('data', $data);
	}
}
