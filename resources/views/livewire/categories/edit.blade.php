<?php

use Livewire\Volt\Component;

use App\Models\Category;
use Illuminate\Validation\Rule;
use Mary\Traits\Toast;

$v = new class extends Component {
    use Toast;

    public Category $category;
    public string $name = '';

    public function mount(): void
    {
        $this->fill($this->category);
    }

    public function save(): void
    {
        $data = $this->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('categories')->ignore($this->category->id)],
        ]);

        $data['slug'] = Str::of($this->name)->slug('-');

        $this->category->update($data);

        $this->success(__('Category updated with success.'), redirectTo: '/categories');
    }
}; ?>

<div>
    <x-card class="h-screen flex items-center justify-center" title="{{ __('Update') }} {{ $category->name }}">
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
