<?php

/**
 * (ɔ) GrCOTE7 - 1990-2024
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('tasks', function (Blueprint $table) {
			$table->id();
			$table->string('title');
			$table->text('detail');
			$table->boolean('state')->default(false);
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('tasks');
	}
};