@props([
    'as' => 'div',
])

<{{ $as }} {{ $attributes->twMerge('rounded-xl border border-border bg-card text-card-foreground shadow-sm') }}>
    {{ $slot }}
</{{ $as }}>
