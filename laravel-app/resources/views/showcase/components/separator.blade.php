<x-layouts.showcase title="Separator — Showcase">
<div class="mx-auto max-w-[--container-md] px-4 sm:px-6 lg:px-8 py-10 space-y-12">

    <div>
        <h1 class="text-3xl font-bold tracking-tight">Separator</h1>
        <p class="mt-1 text-muted-foreground max-w-prose">Línea divisoria semántica. Soporta orientación horizontal y vertical.</p>
    </div>

    {{-- Horizontal --}}
    <section class="space-y-4">
        <h2 class="text-xs font-semibold uppercase tracking-widest text-muted-foreground">Horizontal (default)</h2>
        <div class="space-y-4">
            <p class="text-sm text-muted-foreground">Contenido arriba del separador.</p>
            <x-ui.separator />
            <p class="text-sm text-muted-foreground">Contenido debajo del separador.</p>
        </div>
    </section>

    <x-ui.separator />

    {{-- Vertical --}}
    <section class="space-y-4">
        <h2 class="text-xs font-semibold uppercase tracking-widest text-muted-foreground">Vertical</h2>
        <div class="flex items-center gap-4 h-6">
            <span class="text-sm font-medium">Blog</span>
            <x-ui.separator orientation="vertical" />
            <span class="text-sm font-medium">Docs</span>
            <x-ui.separator orientation="vertical" />
            <span class="text-sm font-medium">Fuente</span>
        </div>
    </section>

    <x-ui.separator />

    {{-- En contexto — perfil --}}
    <section class="space-y-4">
        <h2 class="text-xs font-semibold uppercase tracking-widest text-muted-foreground">En contexto</h2>
        <div class="space-y-1 max-w-xs">
            <h4 class="text-sm font-semibold">Radix Primitives</h4>
            <p class="text-sm text-muted-foreground">Una librería open-source de componentes UI.</p>
            <x-ui.separator class="my-4" />
            <div class="flex h-5 items-center gap-4 text-sm">
                <span>Blog</span>
                <x-ui.separator orientation="vertical" />
                <span>Docs</span>
                <x-ui.separator orientation="vertical" />
                <span>Fuente</span>
            </div>
        </div>
    </section>

</div>
</x-layouts.showcase>
