<div>
    <p>Bonjour, {{ $name ?? 'Toi !' }}</p>
    <hr class="mb-3">

    {{-- Propriété calculée --}}
    <div>Taper l'Id d'un utilisateur ci-dessous (1-{{ $maxUid }}):</div>
    <x-input wire:model.live="index" type="test" />
    <p class="bg-yellow-100 text-black px-2 mt-2 mb-3 rounded">
        {{ $this->user?->name ?? 'Personne avec cet Id !' }}
    </p>

    {{-- Simple componant --}}
    <x-input type="text" wire:model.live="count" label='Valeur ?' hint="Indiquer une nouvelle valeur" />
    <p class="bg-yellow-100 text-black px-2 mt-2 mb-3 rounded">
        → La voici en live: {{ $count }}
    </p>
</div>
