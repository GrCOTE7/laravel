<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImagesRequest;
use App\Repositories\PhotosRepositoryInterface;
use Illuminate\View\View;

class PhotoController extends Controller
{
	public function create(): View
	{
		return view('pages.photo');
	}

	// public function store(ImagesRequest $request): View
	public function store(ImagesRequest $request, PhotosRepositoryInterface $photosRepository): View
	{
		// $request->image->store(config('images.path'), 'public');
		$photosRepository->save($request->image);

		return view('pages.photo_ok');
	}
}
