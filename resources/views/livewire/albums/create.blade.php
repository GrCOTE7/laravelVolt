<?php

use Livewire\Volt\Component;
use Illuminate\Validation\Rule;
use Mary\Traits\Toast;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

$v = new class extends Component {
    use Toast;

    public string $name = '';

    public function save(): void
    {
        $data = $this->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('albums')->where(function ($query) {
                    return $query->where('user_id', Auth::id());
                }),
            ],
        ]);

        $data['slug'] = Str::of($this->name)->slug('-');
        Auth::user()->albums()->create($data);

        $this->success(__('Album created with success.'), redirectTo: '/albums');
    }
}; ?>

<div>
    <x-card class="h-screen flex items-center" title="{{ __('Create a new album') }}">
        <x-form wire:submit="save">
            <x-input label="{{ __('Name') }}" name="Name" wire:model="name" />
            <x-slot:actions>
                <x-button label="{{ __('Cancel') }}" link="/" />
                <x-button label="{{ __('Save') }}" icon="o-paper-airplane" spinner="save" type="submit"
                    class="btn-primary" />
            </x-slot:actions>
        </x-form>
    </x-card>
</div>
