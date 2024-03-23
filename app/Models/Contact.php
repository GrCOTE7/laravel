<?php

/**
 * (ɔ) GrCOTE7 - 1990-2024
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
	use HasFactory;

	protected $fillable = ['name', 'email', 'message'];
}
