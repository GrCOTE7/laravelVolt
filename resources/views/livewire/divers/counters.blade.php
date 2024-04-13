<?php

use Livewire\Volt\Component;

$v = new class extends Component {}; ?>

<div>
    @livewire('divers.counter1', ['count' => 111])
    @livewire(Counter2::class, ['count' => 222])
</div>
