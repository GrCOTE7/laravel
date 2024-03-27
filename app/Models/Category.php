<?php

/**
 * (ɔ) GrCOTE7 - 1990-2024
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Category extends Model
{
	use HasFactory;

	protected $fillable = ['name', 'slug'];

	protected $visible = ['name'];

	public function films(): MorphToMany
	{
		return $this->morphToMany(Film::class, 'filmable');
	}
}
