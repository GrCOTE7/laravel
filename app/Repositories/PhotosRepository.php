<?php

namespace App\Repositories;

use Illuminate\Http\UploadedFile;

// use Your Model

/**
 * Class PhotoRepository.
 */
class PhotosRepository implements PhotosRepositoryInterface
{
	/**
	 * @return string
	 *                Return the model
	 */
	public function model()
	{
		// return YourModel::class;
	}

	public function save(UploadedFile $image)
	{
		$image->store(config('images.path').'/imgs', 'public');
	}
}
