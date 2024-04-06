<?php

/**
 * (ɔ) GrCOTE7 - 1990-2024
 */

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
	public function run(): void
	{
		$this->call([
			UserSeeder::class,
			CategorySeeder::class,
			ImageSeeder::class,
		]);
	}
}
