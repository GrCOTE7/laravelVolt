<?php

use App\Models\User;
use Mary\Traits\Toast;
use Livewire\Volt\Component;
use Livewire\WithPagination;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

$v = new class extends Component {
    use Toast, WithPagination;

    public string $search = '';
    public bool $drawer = false;
    public array $sortBy = ['column' => 'name', 'direction' => 'asc'];

    public function clear(): void
    {
        $this->reset();
        $this->resetPage();
        $this->success(__('Filters cleared.'), position: 'toast-bottom');
    }

    public function delete(User $user): void
    {
        $user->delete();
        $this->warning("$user->name ".__('deleted'), __('Good bye')."!", position: 'toast-bottom');
    }

    public function headers(): array
    {
        return [
            ['key' => 'id', 'label' => '#', 'class' => 'w-1'], ['key' => 'name', 'label' => 'Name', 'class' => 'w-64'],
            ['key' => 'admin', 'label' => 'Admin', 'class' => 'w-20'],
            ['key' => 'adult', 'label' => __('Adult')],
            ['key' => 'images_count', 'label' => __('Images count')],
            ['key' => 'note', 'label' => 'Note', 'class' => 'w-20 text-right'],
            ['key' => 'created_at', 'label' => __('Registration')],
            ['key' => 'email', 'label' => 'E-mail', 'sortable' => false]
        ];
    }

    public function users(): LengthAwarePaginator
    {
        return User::query()
        ->withCount('images')
        ->when($this->search, fn(Builder $q) => $q->where('name', 'like', "%$this->search%"))
        ->orderBy(...array_values($this->sortBy))
        ->paginate(5);
    }
    public function updated($property): void
    {
        if (! is_array($property) && $property != "") {
            $this->resetPage();
        }
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
    <!-- HEADER -->
    <x-header title="{{__('Users')}}" separator progress-indicator>
        <x-slot:middle class="!justify-end">
           <x-input placeholder="{{__('Search...')}}" wire:model.live.debounce="search" clearable icon="o-magnifying-glass" />
        </x-slot:middle>
        <x-slot:actions>
            <x-button label="Filters" @click="$wire.drawer = true" responsive icon="o-funnel" />
        </x-slot:actions>
    </x-header>

    <!-- TABLE  -->
    <x-card>
        <x-table :headers="$headers" :rows="$users" :sort-by="$sortBy" with-pagination>

           @scope('cell_admin', $user)
                @if($user->admin)
                    <x-icon name="o-check-circle"  />
                @endif
            @endscope

           @scope('cell_adult', $user)
                @if($user->adult)
                    <x-icon name="o-check-circle"  />
                @endif
            @endscope

           @scope('cell_created_at', $user)
                {{ $user->created_at->isoFormat('L') }}
            @endscope

            @scope('actions', $user)
                <x-button icon="o-trash" wire:click="delete({{ $user['id'] }})" wire:confirm="{{__('Are you sure to delete this user?')}}" confirm-text="Are you sure?" spinner
                    class="btn-ghost btn-sm text-red-500" />
            @endscope
        </x-table>
    </x-card>

    <!-- FILTER DRAWER -->
    <x-drawer wire:model="drawer" title="Filters" right separator with-close-button class="lg:w-1/3">
        <x-input placeholder="Search..." wire:model.live.debounce="search" icon="o-magnifying-glass"
            @keydown.enter="$wire.drawer = false" />

        <x-slot:actions>
            <x-button label="Reset" icon="o-x-mark" wire:click="clear" spinner />
            <x-button label="Done" icon="o-check" class="btn-primary" @click="$wire.drawer = false" />
        </x-slot:actions>
    </x-drawer>
</div>
