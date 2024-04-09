<?php

use Livewire\Volt\Component;

use App\Models\Category;
use Mary\Traits\Toast;
use Illuminate\Support\Str;
use Livewire\Attributes\Rule;

$v = new class extends Component {
    use Toast;

    #[Rule('required|string|max:255|unique:categories,name')]
    public string $name = '';

    public function save(): void
    {
        $data = $this->validate();
        $data['slug'] = Str::of($this->name)->slug('-');
        Category::create($data);
        $this->success(__('Category created with success.'), redirectTo: '/categories');
    }
}; ?>

<div>
    <x-card class="h-screen flex items-center" title="{{ __('Create a new category') }}">

        <x-form wire:submit="save">
            <x-input label="{{ __('Name') }}" name="Name" wire:model="name" />
            <x-slot:actions>
                <x-button label="{{ __('Cancel') }}" link="/categories" />
                <x-button label="{{ __('Save') }}" icon="o-paper-airplane" spinner="save" type="submit"
                    class="btn-primary" />
            </x-slot:actions>
        </x-form>

    </x-card>
</div>
