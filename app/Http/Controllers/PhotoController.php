<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImagesRequest;
use Illuminate\View\View;

class PhotoController extends Controller
{
	public function create(): View
	{
		return view('pages.photo');
	}

	public function store(ImagesRequest $request): View
	{
		$request->image->store(config('images.path'), 'public');

		return view('pages.photo_ok');
	}
}