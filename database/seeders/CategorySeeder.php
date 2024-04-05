<?php

/**
 * (ɔ) GrCOTE7 - 1990-2024
 */

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
	public function run(): void
	{
		$cats = ['Paysages', 'Maisons', 'Personnages', 'Animaux', 'Végétation'];

		foreach ($cats as $cat) {
			Category::create([
				'name' => $cat,
				'slug' => Str::slug($cat),
			]);
		}
	}
}
