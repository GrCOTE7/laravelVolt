<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Album extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug',
    ];

    public function images(): belongsToMany
    {
        return $this->belongsToMany (Image::class);
    }

    public function user(): belongsTo
    {
        return $this->belongsTo (User::class);
    }
}