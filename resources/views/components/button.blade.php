@props(['type' => 'button', 'color' => 'primary', 'indicator' => false, 'url' => null])

<a href="{{ $url ?? '#' }}" {{ $attributes->merge(['class' => 'btn btn-' . $color]) }}>
    {{ $slot }}
</a>
