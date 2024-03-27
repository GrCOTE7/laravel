<?php

/**
 * (ɔ) GrCOTE7 - 1990-2024
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Actor extends Model
{
	use HasFactory;
    protected $visible=['name'];

	public function films(): MorphToMany
	{
		return $this->morphToMany(Film::class, 'filmable');
	}
}
