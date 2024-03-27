<?php

/**
 * (ɔ) GrCOTE7 - 1990-2024
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Film extends Model
{
	use HasFactory;
	use SoftDeletes;

	protected $fillable = ['title', 'year', 'description'];

	protected $hidden = ['id', 'created_at', 'updated_at', 'deleted_at'];

	public function categories(): MorphToMany
	{
		return $this->morphedByMany(Category::class, 'filmable');
	}

	public function actors(): MorphToMany
	{
		return $this->morphedByMany(Actor::class, 'filmable');
	}
}
