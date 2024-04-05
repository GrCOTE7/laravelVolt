<?php

use App\Models\User;
use function Livewire\Volt\{state};

// public function Users (){

// }

$users = User::all();

// return $users;

?>

<div>
    Hi2
    <hr>
    {{ var_dump($users ?? 'no') }}
    <hr>
    <a href="/" class="link">index</a> |
    <a href="/users" class="link">Users</a>
</div>
