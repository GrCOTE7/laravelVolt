<!DOCTYPE html>
<html data-theme="dark" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@php
    $urls = ['counter1', 'counter2'];
    $uri = substr(request()->getRequestUri(), 1);
    $title = in_array($uri, $urls) ? ucfirst($uri) : 'Albums';
@endphp

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ isset($title) ? $title . ' | ' . config('app.name') : config('app.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- <link rel="stylesheet" href="assets/app-Dah4FSc-.css">
    <script src="assets/app-D2jpX1vH.js"></script> --}}

    <script src=" https://cdn.jsdelivr.net/npm/simplelightbox@2.14.2/dist/simple-lightbox.min.js "></script>
    <link href=" https://cdn.jsdelivr.net/npm/simplelightbox@2.14.2/dist/simple-lightbox.min.css " rel="stylesheet">
</head>

<body class="min-h-screen font-sans antialiased bg-base-200/50 dark:bg-base-200">

    {{-- NAVBAR mobile only --}}
    <x-nav sticky class="lg:hidden">
        <x-slot:brand>
            <x-app-brand />
        </x-slot:brand>
        <x-slot:actions>
            <label for="main-drawer" class="lg:hidden mr-3">
                <x-icon name="o-bars-3" class="cursor-pointer" />
            </label>
        </x-slot:actions>
    </x-nav>

    {{-- MAIN --}}
    <x-main full-width>
        {{-- SIDEBAR --}}
        <x-slot:sidebar drawer="main-drawer" collapsible class="bg-base-100 lg:bg-inherit">

            {{-- BRAND --}}
            <x-app-brand class="p-5 pt-3" />

            {{-- MENU --}}
            <livewire:navigation />

        </x-slot:sidebar>

        {{-- The `$slot` goes here --}}
        <x-slot:content>

            @if (session('error'))
                <div class="bg-red-500 text-white p-3 rounded border border-red-600 text-center">
                    {{ session('error') }}
                </div>
            @endif

            <div class="font-extrabold flex mb-4 justify-center items-center text-4xl"><a
                    href="/">{{ strtoupper($title) }}</a>
            </div>
            <x-partials.nav2 />
            {{ $slot }}
        </x-slot:content>
    </x-main>

    {{--  TOAST area --}}
    <x-toast />
    <toast>

        <script>
            // On vérifie si lightbox existe déjà
            if (typeof lightbox === 'undefined') {
                // S'il n'existe pas, on le crée
                const lightbox = new SimpleLightbox('.gallery a', {});
            } else {
                // S'il existe déjà, on met à jour ses propriétés
                lightbox.refresh();
            }
        </script>
</body>

</html>
