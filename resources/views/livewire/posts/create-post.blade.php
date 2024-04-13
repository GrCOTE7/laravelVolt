@php
    use App\Livewire\Posts\PostItem;
@endphp
<div class="prose">

    <h2>Title: "{{ $title }}"</h2>
    <span>Author: <b>{{ $author }}</b></span>

    <hr class="my-1">

    <form class="mb-3">
        <label for="title">Title:</label>
        <x-input type="text" id="title" wire:model.live="title" />
    </form>

    <livewire:divers.counter1 :count=777 />

</div>
