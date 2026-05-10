<li role="presentation" aria-hidden="true" {{ $attributes->twMerge('[&>svg]:size-3.5') }}>
    @if($slot->isNotEmpty())
        {{ $slot }}
    @else
        <x-ui.icon name="chevron-right" class="size-3.5" />
    @endif
</li>
