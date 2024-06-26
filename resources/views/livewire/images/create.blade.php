<?php

/**
 * (ɔ) GrCOTE7 - 1990-2024
 */

use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as InterventionImage;
use Livewire\Attributes\Rule;
use Livewire\Volt\Component;
use Livewire\WithFileUploads;
use Mary\Traits\Toast;

$v = new class() extends Component {
	use WithFileUploads;
	use Toast;

	#[Rule('required|image|max:2000')]
	public $photo = '';

	#[Rule('required|exists:categories,id')]
	public string $category_id = '1';

	#[Rule('nullable|string|max:255')]
	public string $description = '';

	#[Rule('boolean')]
	public bool $adult = false;

	public function save()
	{
		// Validation
		$data = $this->validate();

		// Save image
		$path = basename($this->photo->store('images', 'public'));

		// Save thumb
		$image = InterventionImage::make($this->photo)
			->widen(500)
			->encode();
		Storage::disk('public')->put('thumbs/' . $path, $image);

		// Save in database
		Auth::user()
			->images()
			->create($data + ['name' => $path]);

		$this->success(__('Image added with success.'), redirectTo: '/images/create');
	}

	public function with(): array
	{
		return [
			'categories' => Category::all(),
		];
	}
};
 ?>

<div>
  <x-card class="h-screen flex items-center justify-center" title="{{ __('Add image') }}">
    <x-form wire:submit="save">
      <x-file wire:model.live="photo" label="{{ __('Image') }}" hint="{{ __('Only image') }}" accept="image/png, image/jpeg">
        <img src="{{ $photo == '' ? '/ask.jpg' : $photo }}" class="h-40" alt="new tof" />
      </x-file>
      <x-select label="{{ __('Category') }}" icon="o-tag" :options="$categories" wire:model.live="category_id"
        hint="{{ __('Choose a pertinent category') }}" />
      <x-input label="{{ __('Description') }}" wire:model.live="description" hint="{{ __('Describe your image here') }}" />
      <x-checkbox label="{{ __('Adult content') }}" wire:model.live="adult" />
      <x-slot:actions>
        <x-button label="{{ __('Save') }}" icon="o-paper-airplane" spinner="save" type="submit" class="btn-primary" />
      </x-slot:actions>
    </x-form>
  </x-card>
</div>
