<?php

/**
 * (ɔ) GrCOTE7 - 1990-2024
 */

namespace App\Http\Tutos\Sillo;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImagesRequest;
use App\Repositories\PhotosRepositoryInterface;
use Illuminate\View\View;

class PhotoController extends Controller
{
	public function create(): View
	{echo 123;
		return view('pages.tuto.photo.photo');
	}

	// public function store(ImagesRequest $request): View
	public function store(ImagesRequest $request, PhotosRepositoryInterface $photosRepository): View
	{
		// $request->image->store(config('images.path'), 'public');
		$photosRepository->save($request->image);

		return view('pages.tuto.photo.photo_ok');
	}
}
