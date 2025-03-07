@props(['id', 'title' => 'Title', 'toolbar' => null, 'body', 'footer' => null, 'fullscreen' => false])

<div id="{{ $id }}" class="modal fade" tabindex="-1">
    <div
        {{ $attributes->class(['modal-fullscreen' => $fullscreen])->merge(['class' => 'modal-dialog modal-dialog-centered']) }}>
        <div class="modal-content">
            <div class="modal-header">
                <h2 {{ $title->attributes->class(['modal-title', 'fw-bold']) }}>{{ $title }}</h2>
                <div class="d-flex align-items-center">
                    {{ $toolbar }}
                </div>
            </div>
            <div {{ $body->attributes->class(['modal-body', 'scroll-y', 'mx-lg-5', 'mb-2']) }}>
                {{ $body }}
            </div>
            @if ($footer)
                <div class="modal-footer">
                    {{ $footer }}
                </div>
            @endif
        </div>
    </div>
</div>
