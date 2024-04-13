@php
    use App\Livewire\Posts\PostItem;
@endphp

<x-slot:lang>de</x-slot>

<div class="prose">

    <h2>Title: "{{ $title }}"</h2>
    <span>Author: <b>{{ $author }}</b></span>

    <hr class="my-1">

    <form class="mb-3">
        <x-input label="title" wire:model.live="title" icon="o-document-text" inline />
    </form>

</div>
