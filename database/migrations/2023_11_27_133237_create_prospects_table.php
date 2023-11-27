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
		Schema::create('prospects', function (Blueprint $table) {
			$table->engine = 'InnoDB';
			$table->bigIncrements('id')->unsigned();
			$table->string('location')->nullable();
			$table->string('source')->nullable();
            $table->timestamp('publish_at')->nullable();
			$table->string('owner')->nullable();
			$table->string('phone')->nullable();
			$table->integer('property_price')->nullable()->unsigned();
			$table->smallInteger('property_pieces')->nullable()->unsigned();
			$table->smallInteger('property_bedrooms')->nullable()->unsigned();
			$table->smallInteger('levels')->nullable()->unsigned();
			$table->integer('building')->nullable()->unsigned();
			$table->integer('land')->nullable()->unsigned();
			$table->string('dpe')->nullable();
			$table->text('details')->nullable();
			$table->text('exchanges')->nullable();
			$table->dateTime('last_contact')->nullable();
			$table->dateTime('inbound')->nullable();
			$table->timestamp('deleted_at')->nullable();
			$table->timestamp('created_at')->default(now());
			$table->timestamp('updated_at')->default(now());
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('prospects');
	}
};
