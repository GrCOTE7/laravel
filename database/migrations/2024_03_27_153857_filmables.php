<?php

/**
 * (ɔ) GrCOTE7 - 1990-2024
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
	public function up(): void
	{
		Schema::create('filmables', function (Blueprint $table) {
			// $table->id();
			$table->foreignId('film_id')
				->constrained()
				->onDelete('cascade')
				->onUpdate('cascade');
			$table->morphs('filmable');
		});
	}

	public function down(): void
	{
		Schema::dropIfExists('filmables');
	}
};
