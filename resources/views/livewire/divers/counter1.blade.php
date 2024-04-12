<?php

use Livewire\Volt\Component;

$v = new class extends Component {
    public $count = 1;

    public function increment()
    {
        $this->count++;
    }
    public function decrement()
    {
        $this->count--;
    }

    public function with()
    {
        return [
            'count'   => $this->count,
            'version' => 'Volt',
        ];
    }
}; ?>

<x-partials.counterbox :num=1 :version="$version" :count="$count" />
