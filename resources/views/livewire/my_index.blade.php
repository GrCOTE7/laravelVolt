<?php

use App\Models\User;
use Mary\Traits\Toast;
use Livewire\Volt\Component;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

$v = new #[Title('Home')]
    class extends Component {
    #[Rule('required|exists:users,id')]
    public $index = 1;

    public function maxUid()
    {
        return DB::table('users')->max('id');
    }

    public function updatedIndex()
    {
        $this->validate([
            'index' => ['required', 'exists:users,id'],
        ]);
    }

    public function getUserProperty()
    {
        return User::find($this->index);
    }

    public function getCurrentUserName(): string|null
    {
        return auth()->user()->name ?? null;
    }
    // Table headers
    public function headers(): array
    {
        return [['key' => 'id', 'label' => '#', 'class' => 'w-1'], ['key' => 'name', 'label' => 'Name', 'class' => 'w-64'], ['key' => 'admin', 'label' => 'Admin', 'class' => 'w-20'], ['key' => 'email', 'label' => 'E-mail', 'sortable' => false]];
    }
    public function users(): Collection
    {
        return User::all();
    }

    public function with(): array
    {
        return [
            'maxUid' => $this->maxUid(),
            'users' => $this->users(),
            'headers' => $this->headers(),
        ];
    }
}; ?>

<div>
    @lang('Hi'), {{ $this->getCurrentUserName() ?? 'l\'ami' }} !

    <br><br>
    <hr><br>

    {{-- Propriété calculée --}}
    <div>Taper l'Id d'un utilisateur ci-dessous (1-{{ $maxUid }}):</div>
    <x-input wire:model.live="index" type="test" />

    <p class="bg-yellow-100 text-black px-2 mt-2 mb-3 rounded">
        {{ $this->user?->name ?? 'Personne avec cet Id !' }}
    </p>

    <x-card>
        <x-table :headers="$headers" :rows="$users" />
    </x-card>
</div>
