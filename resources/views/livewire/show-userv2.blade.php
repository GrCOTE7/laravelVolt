<?php
include_once 'show-userv2.php';
?>

<div>
    <div class="mb-3 fz-12">
        <h1 class="py-0 my-0 h1">Hi from {{ $title }}</h1>
    </div>
    <hr>
    <div class="mt-5 mb-3">
        <x-partials.counterbox :num=7 :version="$version" :count="$count" />
        {{-- @livewire('show_userv2', ['count' => 111]) --}}
    </div>
    <hr>
    <div class="my-2">
        <p>Nom = {{ $user->name }}</p>
        <p>Email = {{ $user->email }}</p>
        <p>Note = {{ $user->note }}</p>
    </div>
</div>
