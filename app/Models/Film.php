<?php

/**
 * (ɔ) GrCOTE7 - 1990-2024
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Film extends Model
{
	use HasFactory;
	use SoftDeletes;

	protected $fillable = ['title', 'year', 'description', 'category_id'];

	public function category(): BelongsTo
	{
		return $this->belongsTo(Category::class);
	}
}
