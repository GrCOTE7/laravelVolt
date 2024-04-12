<div class="flex h-full justify-around align-items prose">
    <div>
        <p class="text-yellow-500 text-2xl my-0 h2">Compteur{{  $num??'' }}: <b>{{ $count }}</b></p>
        <p class="my-0">{{ $version ?? '' }} component</p>
    </div>
    <div class="flex align-items-center">
        <x-button class="btn btn-primary px-5" wire:click="increment">+</x-button>
        <x-button class="btn btn-secondary mx-3 px-5" wire:click="decrement">-</x-button>
    </div>
</div>
