<div>

    <article class="prose">
        <h2>Composant Livewire</h2>
        <p>Bonjour, {{ $name ?? 'Toi !' }}</p>
        <hr class="my-0 pb-5">

        @if ($this->user?->note)
            <div class="flex justify-between">
                <span>Note:</span>
                <x-input wire:model.defer="note" type="text"  class="w-1/3 ml-2"/>
                <span>Coeff.:</span>
                    <x-input wire:model.live="multiplier" type="text"  class="w-1/3 ml-2"/>
                    <button class="btn btn-primary" wire:click="noter({{ $multiplier }})">
                        Noter
                    </button>
            </div>
        @endif

        {{-- Propriété calculée --}}
        <p class="my-0">Taper l'Id d'un utilisateur ci-dessous (1-{{ $maxUid }}):</p>
        <x-input wire:model.live="index" type="test" />
        <p class="bg-yellow-100 text-black px-2 mt-2 mb-3 rounded">
            @if ($this->user?->name)
                {{ $this->user->name }} : <b>{{ $this->user->note ?? 'Pas encore de note' }}</b>
            @else
                Personne avec cet Id !
            @endif
        </p>

        {{-- Simple componant --}}
        <x-input type="text" wire:model.live="count" label='Valeur ?' hint="Indiquer une nouvelle valeur" />
        <p class="bg-yellow-100 text-black px-2 mt-2 mb-3 rounded">
            → La voici en live: {{ $count }}
        </p>
    </article>
</div>
