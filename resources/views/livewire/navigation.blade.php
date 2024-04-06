<?php

use Livewire\Volt\Component;

$v = new class extends Component {
    public function logout(): void
    {
        Auth::guard('web')->logout();
        Session::invalidate();
        Session::regenerateToken();
        $this->redirect('/');
    }
}; ?>

<div>
    <x-menu activate-by-route>

        <x-menu-separator />
        {{-- User --}}
        @if ($user = auth()->user())
            <x-list-item :item="$user" value="name" sub-value="email" no-separator no-hover
                class="-mx-2 !-my-2 rounded">
                <x-slot:actions>
                    <x-button icon="o-power" wire:click="logout" class="btn-circle btn-ghost btn-xs"
                        tooltip-left="{{ __('Logout') }}" no-wire-navigate />
                </x-slot:actions>
            </x-list-item>
            <x-menu-separator />
            @else
            <x-menu-item title="{{ __('Login') }}" icon="o-user" link="{{ route('login') }}" />
            @endif

            <x-menu-sub title="{{__('Images')}}" icon="o-photo">
                <x-menu-item title="{{__('Add image')}}" icon="o-plus" link="{{ route('images.create') }}" />
            </x-menu-sub>

            <x-menu-separator />

        <x-menu-item title="Hello" icon="o-sparkles" link="/" />
        <x-menu-sub title="Settings" icon="o-cog-6-tooth">
            <x-menu-item title="Wifi" icon="o-wifi" link="####" />
            <x-menu-item title="Archives" icon="o-archive-box" link="####" />
        </x-menu-sub>
        <x-menu-item title="Users" icon="o-users" link="users" />
    </x-menu>
</div>
