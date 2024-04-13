<article class="prose">
    <form wire:submit="submit">
        <div class="flex justify-between">
            <span>Note</span>
            <x-input wire:model.live="note" type="text" class="w-1/3" />
            <x-button class="btn btn-primary" type="submit">
                Noter
            </x-button>
        </div>
    </form>
</article>
