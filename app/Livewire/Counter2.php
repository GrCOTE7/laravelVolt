<?php

namespace App\Livewire;

use Livewire\Component;

class Counter2 extends Component
{
    public $count = 1;
    public $version = 'Livewire';

    public function increment()
    {
        $this->count++;
    }

    public function decrement()
    {
        $this->count--;
    }

    public function render()
    {
        return view('livewire.divers.counter2');
    }
}
