<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

$v = new #[Layout('components.layouts.posts')] #[Title('Next')] class extends Component {
    protected $layout = 'components.layouts.posts';
}; ?>

<div>
    <input type="text" data-picker>
</div>

@assets
    <script src="https://cdn.jsdelivr.net/npm/pikaday/pikaday.js" defer></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/pikaday/css/pikaday.css">
@endassets

@script
    <script>
        new Pikaday({
            field: $wire.$el.querySelector('[data-picker]')
        });
    </script>
@endscript

@script
    <script>
        setInterval(() => {
            $wire.$refresh()
            console.log('Top...');
        }, 2000)
    </script>
@endscript

