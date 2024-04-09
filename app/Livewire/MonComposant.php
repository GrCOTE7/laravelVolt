<?php

namespace App\Livewire;

use Livewire\Component;

class MonComposant extends Component
{
    public $name = 'Lionel';
    public $count = 77;
    public function render()
    {
        return view('livewire.mon-composant');
    }
}