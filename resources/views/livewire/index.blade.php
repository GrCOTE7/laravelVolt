<?php

use App\Models\Image;
use Mary\Traits\Toast;
use App\Models\Category;
use Livewire\Volt\Component;
use Livewire\Attributes\Rule;
use App\Repositories\ImageRepository;
use Illuminate\Pagination\LengthAwarePaginator;

$v = new class extends Component {
    use Toast;

    public Image $image;
    public string $category;
    public string $param;

    #[Rule('required|exists:categories,id')]
    public string $category_id = '';

    #[Rule('nullable|string|max:255')]
    public $description = '';

    #[Rule('boolean')]
    public bool $adult = false;

    public bool $imageModal = false;

    public $albums;
    public array $albums_multi_ids = [];

    public function mount($category, $param = ''): void
    {
        $this->category = $category;
        $this->param = $param;
        $this->albums = Auth::user() ? Auth::user()->albums()->get() : null;
    }

    public function images(): LengthAwarePaginator
    {
        $imageRepository = new ImageRepository();

        return $imageRepository->getImagesPaginate($this->category, $this->param);
    }

    public function userImages(int $id): void
    {
        redirect()->route('home', ['category' => $this->category, 'param' => $id]);
    }

    public function editImage(ImageRepository $imageRepository, int $id): void
    {
        $this->image = $imageRepository->getImageWithAlbums($id);

        $this->description = $this->image->description;
        $this->category_id = $this->image->category_id;
        $this->adult = $this->image->adult;
        $this->albums_multi_ids = $this->image->albums->pluck('id')->toArray();

        $this->imageModal = true;
    }

    public function saveImage(ImageRepository $imageRepository): void
    {
        $data = $this->validate();

        $imageRepository->saveImage($this->image, $data, $this->albums_multi_ids);

        $this->success(__('Photo changed with success.'));

        $this->imageModal = false;
    }

    public function deleteImage(ImageRepository $imageRepository, int $id): void
    {
        $imageRepository->deleteImage($id);
        $this->success(__('Photo deleted with success.'), redirectTo: '/');
    }

    public function with(): array
    {
        return [
            'images' => $this->images(),
            'categories' => Category::all(),
        ];
    }
}; ?>

<div>
    <x-partials.nav2 />
    <div class="relative items-center grid w-full px-5 py-5 mx-auto md:px-12 max-w-7xl">

        <x-modal wire:model="imageModal" title="{{ __('Manage Photo') }}" separator>
            <x-form wire:submit="saveImage">
                <x-input label="{{ __('Description') }}" value="{{ $description }}" wire:model="description"
                    hint="{{ __('Describre your image here') }}" />
                <x-select label="{{ __('Category') }}" icon="o-tag" :options="$categories" wire:model="category_id"
                    hint="{{ __('Choose a pertinent category') }}" />
                @if ($albums)
                    <x-choices label="{{ __('Albums') }}" wire:model="albums_multi_ids" :options="$albums" />
                @endif
                <x-checkbox label="{{ __('Adult content') }}" wire:model="adult" />
                <x-slot:actions>
                    <x-button label="{{ __('Cancel') }}" icon="o-x-mark" class="btn-ghost"
                        @click="$wire.imageModal = false" />
                    <x-button label="{{ __('Save') }}" type="submit" icon="o-check" class="btn-primary" />
                </x-slot:actions>
            </x-form>
        </x-modal>

        <div class="mb-4">{{ $images->links() }}</div>
        <div class="grid w-full grid-cols-1 gap-6 mx-auto sm:grid-cols-2 lg:grid-cols-3 gallery">
            @foreach ($images as $image)
                <x-card title="" subtitle="{!! $image->description !!}" shadow separator>
                    <div class="flex justify-between">
                        <p wire:click="userImages({{ $image->user->id }})" class="text-left" style="cursor: pointer;">
                            {{ $image->user->name }}</p>
                        <p class="text-right"><em>{{ ucfirst($image->created_at->isoFormat('LLLL')) }}</em></p>
                    </div>

                    @adminOrOwner($image->user_id)
                        <div class="flex justify-between mt-2">
                            <x-button wire:click="deleteImage({{ $image->id }})" icon="o-fire"
                                class="btn-circle btn-ghost text-left"
                                wire:confirm="{{ __('Are you sure to delete this photo?') }}"
                                tooltip="{{ __('Delete this photo') }}" />
                            <x-button wire:click="editImage({{ $image->id }})" icon="o-cog"
                                class="btn-circle btn-ghost text-right" tooltip="{{ __('Edit photo') }}" />
                        </div>
                    @endadminOrOwner

                    <x-slot:figure>
                        <a href="{{ asset('storage/images/' . $image->name) }}">
                            <img src="{{ asset('storage/thumbs/' . $image->name) }}" alt="Galerie" />
                        </a>
                    </x-slot:figure>
                </x-card>
            @endforeach
        </div>
    </div>
</div>
