<x-layouts.showcase title="Skeleton — Showcase">
<div class="mx-auto max-w-[--container-lg] px-4 sm:px-6 lg:px-8 py-10 space-y-12">

    <div>
        <h1 class="text-3xl font-bold tracking-tight">Skeleton</h1>
        <p class="mt-1 text-muted-foreground max-w-prose">Placeholder animado para estados de carga. Acepta cualquier clase Tailwind para moldear su forma.</p>
    </div>

    {{-- Formas básicas --}}
    <section class="space-y-4">
        <h2 class="text-xs font-semibold uppercase tracking-widest text-muted-foreground">Formas básicas</h2>
        <div class="space-y-3 max-w-xs">
            <x-ui.skeleton class="h-4 w-full" />
            <x-ui.skeleton class="h-4 w-3/4" />
            <x-ui.skeleton class="h-4 w-1/2" />
        </div>
    </section>

    <x-ui.separator />

    {{-- Avatar + texto --}}
    <section class="space-y-4">
        <h2 class="text-xs font-semibold uppercase tracking-widest text-muted-foreground">Avatar + texto</h2>
        <div class="flex items-center gap-3 max-w-xs">
            <x-ui.skeleton class="size-10 rounded-full shrink-0" />
            <div class="flex-1 space-y-2">
                <x-ui.skeleton class="h-4 w-32" />
                <x-ui.skeleton class="h-3 w-48" />
            </div>
        </div>
    </section>

    <x-ui.separator />

    {{-- Card skeleton --}}
    <section class="space-y-4">
        <h2 class="text-xs font-semibold uppercase tracking-widest text-muted-foreground">Card cargando</h2>
        <div class="max-w-sm">
            <x-ui.card>
                <x-ui.card.header>
                    <x-ui.skeleton class="h-5 w-40" />
                    <x-ui.skeleton class="h-4 w-60 mt-1" />
                </x-ui.card.header>
                <x-ui.card.content class="space-y-3">
                    <x-ui.skeleton class="h-4 w-full" />
                    <x-ui.skeleton class="h-4 w-5/6" />
                    <x-ui.skeleton class="h-4 w-4/6" />
                </x-ui.card.content>
                <x-ui.card.footer class="gap-3">
                    <x-ui.skeleton class="h-9 w-20 rounded-md" />
                    <x-ui.skeleton class="h-9 w-20 rounded-md" />
                </x-ui.card.footer>
            </x-ui.card>
        </div>
    </section>

    <x-ui.separator />

    {{-- Lista --}}
    <section class="space-y-4">
        <h2 class="text-xs font-semibold uppercase tracking-widest text-muted-foreground">Lista cargando</h2>
        <div class="space-y-4 max-w-md">
            @foreach(range(1, 4) as $_)
                <div class="flex items-center gap-3">
                    <x-ui.skeleton class="size-9 rounded-full shrink-0" />
                    <div class="flex-1 space-y-2">
                        <x-ui.skeleton class="h-4 w-28" />
                        <x-ui.skeleton class="h-3 w-40" />
                    </div>
                    <x-ui.skeleton class="h-5 w-12 rounded-full shrink-0" />
                </div>
            @endforeach
        </div>
    </section>

</div>
</x-layouts.showcase>
