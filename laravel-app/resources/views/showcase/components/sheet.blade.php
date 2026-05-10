<x-layouts.showcase title="Sheet — Showcase">
<div class="mx-auto max-w-[--container-lg] px-4 sm:px-6 lg:px-8 py-10 space-y-12">

    <div>
        <h1 class="text-3xl font-bold tracking-tight">Sheet</h1>
        <p class="mt-1 text-muted-foreground max-w-prose">Panel deslizante desde cualquier lado de la pantalla. Ideal para filtros, detalles y formularios secundarios sin interrumpir el flujo principal.</p>
    </div>

    {{-- Lados --}}
    <section class="space-y-4">
        <h2 class="text-xs font-semibold uppercase tracking-widest text-muted-foreground">Lados</h2>
        <div class="flex flex-wrap gap-3">
            @foreach(['right' => 'Derecha (default)', 'left' => 'Izquierda', 'top' => 'Arriba', 'bottom' => 'Abajo'] as $side => $label)
                <x-ui.sheet side="{{ $side }}">
                    <x-slot:trigger>
                        <x-ui.button variant="outline">{{ $label }}</x-ui.button>
                    </x-slot:trigger>

                    <x-ui.sheet.header>
                        <x-ui.sheet.title>Sheet — {{ $label }}</x-ui.sheet.title>
                        <x-ui.sheet.description>Panel deslizando desde el {{ $label }}.</x-ui.sheet.description>
                    </x-ui.sheet.header>

                    <x-ui.sheet.content>
                        <p class="text-sm text-muted-foreground">El contenido del sheet va aquí. Puede contener formularios, listas u otros componentes.</p>
                    </x-ui.sheet.content>

                    <x-ui.sheet.footer>
                        <x-ui.button @click="open = false">Guardar</x-ui.button>
                        <x-ui.button variant="outline" @click="open = false">Cancelar</x-ui.button>
                    </x-ui.sheet.footer>
                </x-ui.sheet>
            @endforeach
        </div>
    </section>

    <x-ui.separator />

    {{-- Caso de uso: filtros --}}
    <section class="space-y-4">
        <h2 class="text-xs font-semibold uppercase tracking-widest text-muted-foreground">Caso de uso — Filtros</h2>
        <x-ui.sheet side="right">
            <x-slot:trigger>
                <x-ui.button variant="outline">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75"/></svg>
                    Filtros
                </x-ui.button>
            </x-slot:trigger>

            <x-ui.sheet.header>
                <x-ui.sheet.title>Filtrar resultados</x-ui.sheet.title>
                <x-ui.sheet.description>Ajustá los filtros para refinar la búsqueda.</x-ui.sheet.description>
            </x-ui.sheet.header>

            <x-ui.sheet.content class="space-y-4">
                <x-ui.form-field>
                    <x-ui.label>Búsqueda</x-ui.label>
                    <x-ui.input placeholder="Buscar por nombre..." />
                </x-ui.form-field>
                <x-ui.form-field>
                    <x-ui.label>Estado</x-ui.label>
                    <x-ui.input placeholder="Todos los estados" />
                </x-ui.form-field>
                <x-ui.separator />
                <x-ui.form-field>
                    <x-ui.label>Rango de fechas</x-ui.label>
                    <x-ui.input type="date" />
                </x-ui.form-field>
            </x-ui.sheet.content>

            <x-ui.sheet.footer>
                <x-ui.button>Aplicar filtros</x-ui.button>
                <x-ui.button variant="outline" @click="open = false">Cancelar</x-ui.button>
            </x-ui.sheet.footer>
        </x-ui.sheet>
    </section>

</div>
</x-layouts.showcase>
