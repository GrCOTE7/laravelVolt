<?php

use Livewire\Volt\Component;

$v = new
#[Title('Home')]
class extends Component {
    
}; ?>

<div>
    @lang('Hi')
    {{-- {{ $this->v() }} --}}
    <hr>
    {{ var_dump($users ?? 'no') }}
    <hr>
    <a href="/index2" class="link">index2</a> |
    <a href="/users" class="link">Users</a>
</div>
