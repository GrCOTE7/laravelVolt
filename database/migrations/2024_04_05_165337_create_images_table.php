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
		Schema::create('images', function (Blueprint $table) {
			$table->id();
			$table->foreignId('category_id')->constrained()->onDelete('cascade');
			$table->foreignId('user_id')->constrained()->onDelete('cascade');
			$table->string('name');
			$table->string('description')->nullable();
			$table->boolean('adult')->default(false);
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('images');
	}
};
