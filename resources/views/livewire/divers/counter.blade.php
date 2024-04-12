<?php

use Livewire\Volt\Component;

$v = new class extends Component {
    public function uri()
    {
        $uri = request()->getRequestUri();
        if ($uri == '/counter') {
            $uri = substr($uri, 1);
            return $uri;
        }
    }

    public function with()
    {
        $urls = ['a', 'counter'];
        return [
            'data' => $this->uri(),
            'res' => in_array($this->uri(), $urls) * 1,
        ];
    }
}; ?>

<div>
    data: {{ $data }}
</div>
