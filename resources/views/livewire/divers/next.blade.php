<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

$v = new #[Layout('components.layouts.posts')] #[Title('Next')] class extends Component {
    protected $layout = 'components.layouts.posts';
}; ?>

<div>

    @script
        <script>
            setInterval(() => {
                $wire.$refresh()
                console.log('Top...');
            }, 2000)
        </script>
    @endscript

</div>
