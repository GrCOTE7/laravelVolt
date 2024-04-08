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
		Schema::create('albums', function (Blueprint $table) {
			$table->id();
			$table->string('name');
			$table->string('slug');
			$table->foreignId('user_id')->constrained()->onDelete('cascade');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('albums');
	}
};