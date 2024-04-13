@php
    use App\Livewire\Posts\PostItem;
@endphp
<div class="prose">
    <h2>Title: "{{ $title }}"</h2>
    <span>Author: <b>{{ $author }}</b></span>
    <p>A good traveler has no fixed plans and is not intent upon arriving.</p>

    <ul>
        @foreach ($posts as $post)
            <li>{{ $post->title }}: {{ $post->content }}</li>
        @endforeach
    </ul>

    <hr>

    @foreach ($posts as $post)
        <div wire:key="{{ $post->id }}">
            {{ $post->title }}
        </div>
    @endforeach

    @livewire('divers.counter1', ['count' => 111])
    @livewire(Counter2::class, ['count' => 222])

</div>
