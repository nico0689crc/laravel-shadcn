<x-layouts.showcase title="Button Group — Showcase">
<div class="mx-auto max-w-[--container-lg] px-4 sm:px-6 lg:px-8 py-10 space-y-12">

    <div>
        <h1 class="text-3xl font-bold tracking-tight">Button Group</h1>
        <p class="mt-1 text-muted-foreground max-w-prose">Agrupa botones fusionando sus bordes intermedios. Sin JS.</p>
    </div>

    <section class="space-y-4">
        <h2 class="text-xs font-semibold uppercase tracking-widest text-muted-foreground">Horizontal</h2>
        <div class="flex flex-wrap gap-4">
            <x-ui.button-group>
                <x-ui.button variant="outline">Anterior</x-ui.button>
                <x-ui.button variant="outline">Siguiente</x-ui.button>
            </x-ui.button-group>

            <x-ui.button-group>
                <x-ui.button variant="outline">Día</x-ui.button>
                <x-ui.button variant="outline">Semana</x-ui.button>
                <x-ui.button variant="outline">Mes</x-ui.button>
            </x-ui.button-group>

            <x-ui.button-group>
                <x-ui.button variant="outline" size="sm">
                    <x-ui.icon name="chevron-left" />
                </x-ui.button>
                <x-ui.button variant="outline" size="sm">1</x-ui.button>
                <x-ui.button variant="outline" size="sm">2</x-ui.button>
                <x-ui.button variant="outline" size="sm">3</x-ui.button>
                <x-ui.button variant="outline" size="sm">
                    <x-ui.icon name="chevron-right" />
                </x-ui.button>
            </x-ui.button-group>
        </div>
    </section>

    <x-ui.separator />

    <section class="space-y-4">
        <h2 class="text-xs font-semibold uppercase tracking-widest text-muted-foreground">Vertical</h2>
        <x-ui.button-group orientation="vertical" class="w-32">
            <x-ui.button variant="outline">Arriba</x-ui.button>
            <x-ui.button variant="outline">Centro</x-ui.button>
            <x-ui.button variant="outline">Abajo</x-ui.button>
        </x-ui.button-group>
    </section>

    <x-ui.separator />

    <section class="space-y-4">
        <h2 class="text-xs font-semibold uppercase tracking-widest text-muted-foreground">Con variantes</h2>
        <div class="flex flex-wrap gap-4">
            <x-ui.button-group>
                <x-ui.button>Publicar</x-ui.button>
                <x-ui.button>
                    <x-ui.icon name="chevron-down" />
                </x-ui.button>
            </x-ui.button-group>

            <x-ui.button-group>
                <x-ui.button variant="outline">Copiar</x-ui.button>
                <x-ui.button variant="outline">Cortar</x-ui.button>
                <x-ui.button variant="outline">Pegar</x-ui.button>
            </x-ui.button-group>
        </div>
    </section>

</div>
</x-layouts.showcase>
