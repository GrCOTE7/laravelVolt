@php
    $routes = [
        '/' => 'home',
        '/myIndex' => 'myIndex',
        '/composant' => 'component',
        '/user/1' => 'User 1',
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

{!! implode(' | ', $lks) !!}

<br><br>
<hr><br>
