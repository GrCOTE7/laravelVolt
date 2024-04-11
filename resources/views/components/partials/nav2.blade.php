@php
    $routes = [
        '/' => 'home',
        '/myIndex' => 'myIndex',
        '/composant' => 'composant',
        '/user/1' => 'user',
        '/users' => 'users',
    ];
    $currentRoute = Route::currentRouteName();
    $lks = [];
    foreach ($routes as $url => $route) {
        if ($currentRoute != $route) {
            $lks[] = '<a href="' . $url . '" class="link">' . ucfirst($route) . '</a>';
        } else {
            $lks[] = '<span>' . ucfirst($route) . '</span>';
        }
    }
@endphp
@admin
    {!! implode(' | ', $lks) !!}
    <br><br>
    <hr><br>
{{-- @else
    @foreach ($lks as $lk)
        <i>{!! $lk !!}</i>
    @endforeach --}}
@endadmin
