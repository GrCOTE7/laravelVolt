<?php

/**
 * (ɔ) GrCOTE7 - 1990-2024
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Image extends Model
{
	use HasFactory;

        protected $fillable = [
        'description',
        'category_id',
        'adult',
        'name',
    ];

	public function category(): BelongsTo
	{
		return $this->belongsTo(Category::class);
	}

	public function user(): BelongsTo
	{
		return $this->belongsTo(User::class);
	}
}
