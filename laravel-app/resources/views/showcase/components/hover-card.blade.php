<x-layouts.showcase title="Hover Card — Showcase">
<div class="mx-auto max-w-[--container-lg] px-4 sm:px-6 lg:px-8 py-10 space-y-12">

    <div>
        <h1 class="text-3xl font-bold tracking-tight">Hover Card</h1>
        <p class="mt-1 text-muted-foreground max-w-prose">Tarjeta de preview que aparece al pasar el cursor sobre un trigger. Se abre con un delay de 150ms para evitar cierres accidentales.</p>
    </div>

    <section class="space-y-4">
        <h2 class="text-xs font-semibold uppercase tracking-widest text-muted-foreground">Básico</h2>
        <div class="flex flex-wrap gap-6 py-8 justify-center">
            <x-ui.hover-card>
                <x-ui.hover-card.trigger>
                    <a href="#" class="text-sm font-medium underline underline-offset-4">@shadcn</a>
                </x-ui.hover-card.trigger>
                <x-ui.hover-card.content>
                    <div class="flex gap-3">
                        <x-ui.avatar class="size-10">
                            <x-ui.avatar.fallback>SC</x-ui.avatar.fallback>
                        </x-ui.avatar>
                        <div class="space-y-1">
                            <p class="text-sm font-semibold">shadcn/ui</p>
                            <p class="text-xs text-muted-foreground">Accesible and customizable components.</p>
                            <p class="text-xs text-muted-foreground">Joined December 2022</p>
                        </div>
                    </div>
                </x-ui.hover-card.content>
            </x-ui.hover-card>
        </div>
    </section>

    <x-ui.separator />

    <section class="space-y-4">
        <h2 class="text-xs font-semibold uppercase tracking-widest text-muted-foreground">Posiciones</h2>
        <div class="flex flex-wrap gap-4 py-12 justify-center">
            @foreach(['top', 'bottom', 'left', 'right'] as $side)
                <x-ui.hover-card>
                    <x-ui.hover-card.trigger>
                        <x-ui.badge variant="outline">{{ $side }}</x-ui.badge>
                    </x-ui.hover-card.trigger>
                    <x-ui.hover-card.content :side="$side">
                        <p class="text-sm">Panel posicionado en <strong>{{ $side }}</strong>.</p>
                    </x-ui.hover-card.content>
                </x-ui.hover-card>
            @endforeach
        </div>
    </section>

    <x-ui.separator />

    <section class="space-y-4">
        <h2 class="text-xs font-semibold uppercase tracking-widest text-muted-foreground">Con contenido rico</h2>
        <div class="flex flex-wrap gap-6 py-4 justify-center">
            <x-ui.hover-card>
                <x-ui.hover-card.trigger>
                    <x-ui.button variant="link">Ver estadísticas</x-ui.button>
                </x-ui.hover-card.trigger>
                <x-ui.hover-card.content class="w-72">
                    <div class="space-y-3">
                        <p class="text-sm font-semibold">Resumen del mes</p>
                        <div class="grid grid-cols-2 gap-2">
                            @foreach([['Visitas', '12,430'], ['Conversiones', '2.4%'], ['Ingresos', '$8,291'], ['Promedio', '3:42']] as [$label, $val])
                                <div class="rounded-md bg-muted p-2">
                                    <p class="text-xs text-muted-foreground">{{ $label }}</p>
                                    <p class="text-sm font-semibold">{{ $val }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </x-ui.hover-card.content>
            </x-ui.hover-card>
        </div>
    </section>

</div>
</x-layouts.showcase>
