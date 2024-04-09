<?php

use Livewire\Volt\Component;
use App\Models\Category;

$v = new class extends Component {
    public function headers(): array
    {
        return [['key' => 'name', 'label' => __('Name')], ['key' => 'slug', 'label' => 'Slug'], ['key' => 'images_count', 'label' => __('Images count')]];
    }

    public function delete($id): void
    {
        Category::destroy($id);
    }

    public function with(): array
    {
        return [
            'categories' => Category::withCount('images')->get(),
            'headers' => $this->headers(),
        ];
    }
}; ?>

<div>
    <x-header title="{{ __('Categories') }}" separator progress-indicator />
    <x-card>
        <x-table :headers="$headers" :rows="$categories" link="categories/{id}/edit">
            @scope('actions', $category)
                <x-button icon="o-trash" wire:click="delete({{ $category->id }})"
                    wire:confirm="{{ __('Are you sure to delete this category?') }}" spinner class="btn-sm" />
            @endscope
        </x-table>
    </x-card>
</div>
