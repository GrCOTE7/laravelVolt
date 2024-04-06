@php
    $routes = ['/' => 'home', 'index2' => 'index2', 'users' => 'users'];
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
