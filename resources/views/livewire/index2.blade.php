<?php

use App\Models\User;
use Livewire\Volt\Component;
use Illuminate\Support\Collection;
use Mary\Traits\Toast;

$v = new
#[Title('Home')]
class extends Component {
    public function getCurrentUserName(): string|null
    {
        return auth()->user()->name ?? null;
    }
    // Table headers
    public function headers(): array
    {
        return [['key' => 'id', 'label' => '#', 'class' => 'w-1'], ['key' => 'name', 'label' => 'Name', 'class' => 'w-64'], ['key' => 'admin', 'label' => 'Admin', 'class' => 'w-20'], ['key' => 'email', 'label' => 'E-mail', 'sortable' => false]];
    }
    public function users():Collection {
        return User::all();
    }

    public function with(): array
    {
        return [
            'users' => $this->users(),
            'headers' => $this->headers(),
        ];
    }
}; ?>

<div>
    <a href="/" class="link">Home</a> |
    <a href="/users" class="link">Users</a>

    <br><br><hr><br>

    @lang('Hi'), {{ $this->getCurrentUserName() ?? 'l\'ami' }} !

    <br><br><hr><br>

    <x-card>
        <x-table :headers="$headers" :rows="$users" />
    </x-card>
</div>
