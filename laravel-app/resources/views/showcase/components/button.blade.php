<x-layouts.showcase title="Button — Showcase">
<div class="mx-auto max-w-[--container-lg] px-4 sm:px-6 lg:px-8 py-10 space-y-12">

    <div>
        <h1 class="text-3xl font-bold tracking-tight">Button</h1>
        <p class="mt-1 text-muted-foreground max-w-prose">Componente de acción principal. Dos ejes independientes: <code class="text-xs bg-muted px-1 py-0.5 rounded">variant</code> (forma) y <code class="text-xs bg-muted px-1 py-0.5 rounded">state</code> (color semántico).</p>
    </div>

    {{-- Variantes --}}
    <section class="space-y-4">
        <h2 class="text-xs font-semibold uppercase tracking-widest text-muted-foreground">Variantes</h2>
        <div class="flex flex-wrap gap-3 items-center">
            <x-ui.button variant="default">Default</x-ui.button>
            <x-ui.button variant="secondary">Secondary</x-ui.button>
            <x-ui.button variant="outline">Outline</x-ui.button>
            <x-ui.button variant="ghost">Ghost</x-ui.button>
            <x-ui.button variant="link">Link</x-ui.button>
        </div>
    </section>

    <x-ui.separator />

    {{-- Estados semánticos (filled) --}}
    <section class="space-y-4">
        <h2 class="text-xs font-semibold uppercase tracking-widest text-muted-foreground">Estados semánticos — filled</h2>
        <div class="flex flex-wrap gap-3 items-center">
            <x-ui.button state="destructive">Destructive</x-ui.button>
            <x-ui.button state="success">Success</x-ui.button>
            <x-ui.button state="warning">Warning</x-ui.button>
            <x-ui.button state="info">Info</x-ui.button>
        </div>
    </section>

    <x-ui.separator />

    {{-- Estados semánticos × outline --}}
    <section class="space-y-4">
        <h2 class="text-xs font-semibold uppercase tracking-widest text-muted-foreground">Estados semánticos — outline</h2>
        <div class="flex flex-wrap gap-3 items-center">
            <x-ui.button variant="outline" state="destructive">Destructive</x-ui.button>
            <x-ui.button variant="outline" state="success">Success</x-ui.button>
            <x-ui.button variant="outline" state="warning">Warning</x-ui.button>
            <x-ui.button variant="outline" state="info">Info</x-ui.button>
        </div>
    </section>

    <x-ui.separator />

    {{-- Estados semánticos × ghost --}}
    <section class="space-y-4">
        <h2 class="text-xs font-semibold uppercase tracking-widest text-muted-foreground">Estados semánticos — ghost</h2>
        <div class="flex flex-wrap gap-3 items-center">
            <x-ui.button variant="ghost" state="destructive">Destructive</x-ui.button>
            <x-ui.button variant="ghost" state="success">Success</x-ui.button>
            <x-ui.button variant="ghost" state="warning">Warning</x-ui.button>
            <x-ui.button variant="ghost" state="info">Info</x-ui.button>
        </div>
    </section>

    <x-ui.separator />

    {{-- Tamaños --}}
    <section class="space-y-4">
        <h2 class="text-xs font-semibold uppercase tracking-widest text-muted-foreground">Tamaños</h2>
        <div class="flex flex-wrap gap-3 items-center">
            <x-ui.button size="sm">Small</x-ui.button>
            <x-ui.button size="md">Medium</x-ui.button>
            <x-ui.button size="lg">Large</x-ui.button>
            <x-ui.button size="icon" aria-label="Acción">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
            </x-ui.button>
        </div>
    </section>

    <x-ui.separator />

    {{-- Con ícono --}}
    <section class="space-y-4">
        <h2 class="text-xs font-semibold uppercase tracking-widest text-muted-foreground">Con ícono</h2>
        <div class="flex flex-wrap gap-3 items-center">
            <x-ui.button>
                <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75"/></svg>
                Enviar email
            </x-ui.button>
            <x-ui.button variant="outline">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
                Descargar
            </x-ui.button>
        </div>
    </section>

    <x-ui.separator />

    {{-- Estados UI --}}
    <section class="space-y-4">
        <h2 class="text-xs font-semibold uppercase tracking-widest text-muted-foreground">Estados UI</h2>
        <div class="flex flex-wrap gap-3 items-center">
            <x-ui.button disabled>Disabled</x-ui.button>
            <x-ui.button disabled variant="outline">Disabled outline</x-ui.button>
            <x-ui.button disabled>
                <x-ui.spinner size="sm" class="text-primary-foreground opacity-70" />
                Cargando...
            </x-ui.button>
        </div>
    </section>

</div>
</x-layouts.showcase>
