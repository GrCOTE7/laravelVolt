<?php

use Livewire\Volt\Component;
use App\Models\Album;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

$v = new class extends Component {
    public function headers(): array
    {
        return [['key' => 'name', 'label' => __('Name')], ['key' => 'slug', 'label' => 'Slug']];
    }

    public function delete($id): void
    {
        Album::destroy($id);
    }

    public function albums(): Collection
    {
        return Auth::user()->albums()->get();
    }

    public function with(): array
    {
        return [
            'albums' => $this->albums(),
            'headers' => $this->headers(),
        ];
    }
}; ?>

<div>
    <x-header title="{{ __('Albums') }}" separator progress-indicator />

    <x-card>
        <x-table :headers="$headers" :rows="$albums" link="albums/{id}/edit">

            @scope('actions', $album)
                <x-button icon="o-trash" wire:click="delete({{ $album->id }})"
                    wire:confirm="{{ __('Are you sure to delete this album?') }}" spinner class="btn-sm" />
            @endscope

        </x-table>
    </x-card>
</div>
