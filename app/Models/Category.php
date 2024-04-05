<?php

/**
 * (ɔ) GrCOTE7 - 1990-2024
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
	protected $fillable = [
		'name', 'slug',
	];

	public function images(): HasMany
	{
		return $this->hasMany(Image::class);
	}
}
