<?php

/**
 * (ɔ) GrCOTE7 - 1990-2024
 */

namespace App\Repositories;

use App\Models\Image;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ImageRepository
{
	public function getImagesPaginate(string $category, string $param): LengthAwarePaginator
	{
		$user = Auth::user();

		$query = Image::with('user')->latest();

		if (!$user || !$user->adult) {
			$query->whereAdult(false);
		}

		if ('' != $param) {
			$query->whereUserId($param);
		}

		if ('all' != $category) {
			$query->whereHas('category', function ($query) use ($category) {
				$query->whereSlug($category);
			});
		}

		return $query->paginate($user->pagination ?? config('app.pagination'));
	}

	public function getImage(int $id)
	{
		return Image::find($id);
	}

	public function saveImage(Image $image, array $data): void
	{
		$image->update($data);
	}

	public function deleteImage(int $id): void
	{
		$image = Image::find($id);
		Storage::disk('public')->delete([
			'images/' . $image->name,
			'thumbs/' . $image->name,
		]);
		$image->delete();
	}
}