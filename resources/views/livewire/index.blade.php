<?php

use Mary\Traits\Toast;
use App\Models\Category;
use Livewire\Volt\Component;
use App\Repositories\ImageRepository;
use Illuminate\Pagination\LengthAwarePaginator;

$v = new class extends Component {

    use Toast;

    public string $category;
    public string $param;

    public function mount($category, $param = ''): void
    {
        $this->category = $category;
        $this->param = $param;
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
        <div class="mb-4">{{ $images->links() }}</div>
        <div class="grid w-full grid-cols-1 gap-6 mx-auto sm:grid-cols-2 lg:grid-cols-3 gallery">
            @foreach ($images as $image)
                <x-card title="" subtitle="{!! $image->description !!}" shadow separator>
                    <div class="flex justify-between">
                        <p wire:click="userImages({{ $image->user->id }})" class="text-left" style="cursor: pointer;">
                            {{ $image->user->name }}</p>
                        <p class="text-right"><em>{{ $image->created_at->isoFormat('LLLL') }}</em></p>
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
