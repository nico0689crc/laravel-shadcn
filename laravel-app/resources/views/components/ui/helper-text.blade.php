@props([
    'state'   => null,   // null | destructive | success | warning | info
    'message' => null,
])

@php
$config = match($state) {
    'success'     => ['text' => 'text-success',     'icon' => 'circle-check'],
    'warning'     => ['text' => 'text-warning',     'icon' => 'triangle-alert'],
    'info'        => ['text' => 'text-info',        'icon' => 'circle-info'],
    'destructive' => ['text' => 'text-destructive', 'icon' => 'circle-x'],
    default       => ['text' => 'text-muted-foreground', 'icon' => null],
};
@endphp

@if($state || $message || $slot->isNotEmpty())
    <p {{ $attributes->twMerge('flex items-center gap-1.5 text-xs', $config['text']) }}>
        @if($config['icon'])
            <x-ui.icon :name="$config['icon']" class="size-3.5 shrink-0" />
        @endif
        {{ $message ?? $slot }}
    </p>
@endif
