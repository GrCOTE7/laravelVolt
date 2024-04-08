<?php

use Livewire\Volt\Component;
use Mary\Traits\Toast;
use App\Models\Album;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

$v = new class extends Component {
    use Toast;

    public Album $album;
    public string $name = '';

    public function mount(): void
    {
        $this->fill($this->album);
    }

    public function save(): void
    {
        $data = $this->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('albums')
                    ->ignore($this->album->id)
                    ->where(function ($query) {
                        return $query->where('user_id', Auth::id());
                    }),
            ],
        ]);

        $data['slug'] = Str::of($this->name)->slug('-');
        $this->album->update($data);

        $this->success(__('Album updated with success.'), redirectTo: '/albums');
    }
}; ?>

<div>
    <x-card class="h-screen flex items-center" title="{{ __('Update') }} {{ $album->name }}">
        <x-form wire:submit="save">
            <x-input label="{{ __('Name') }}" name="Name" wire:model="name" />
            <x-slot:actions>
                <x-button label="{{ __('Cancel') }}" link="/albums" />
                <x-button label="{{ __('Save') }}" icon="o-paper-airplane" spinner="save" type="submit"
                    class="btn-primary" />
            </x-slot:actions>
        </x-form>
    </x-card>
</div>
