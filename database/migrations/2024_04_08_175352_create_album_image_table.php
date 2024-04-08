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
		Schema::create('album_image', function (Blueprint $table) {
			$table->id();
			$table->foreignId('album_id')->constrained()->onDelete('cascade');
			$table->foreignId('image_id')->constrained()->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('album_image');
	}
};