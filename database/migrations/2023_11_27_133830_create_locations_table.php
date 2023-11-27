<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('locations', function (Blueprint $table) {
			$table->engine = 'InnoDB';
			$table->increments('id')->unsigned();
			$table->string('name')->nulllable();
			$table->string('cp')->nulllable();
			$table->string('slug')->nullable();
			$table->integer('sort_order')->default(1);
			$table->timestamp('created_at')->default(now());
			$table->timestamp('updated_at')->default(now());
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('locations');
	}
};
