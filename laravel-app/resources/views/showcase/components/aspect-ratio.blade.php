<x-layouts.showcase title="Aspect Ratio — Showcase">
<div class="mx-auto max-w-[--container-lg] px-4 sm:px-6 lg:px-8 py-10 space-y-12">

    <div>
        <h1 class="text-3xl font-bold tracking-tight">Aspect Ratio</h1>
        <p class="mt-1 text-muted-foreground max-w-prose">Wrapper que mantiene una relación de aspecto fija para imágenes, videos y embeds. Acepta cualquier valor numérico como <code class="font-mono text-sm">ratio</code>.</p>
    </div>

    <section class="space-y-4">
        <h2 class="text-xs font-semibold uppercase tracking-widest text-muted-foreground">Ratios comunes</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            @foreach(['16/9' => '16:9', '4/3' => '4:3', '1/1' => '1:1', '9/16' => '9:16'] as $ratio => $label)
                <div class="space-y-2">
                    <x-ui.aspect-ratio :ratio="$ratio" class="rounded-lg bg-muted overflow-hidden">
                        <div class="flex h-full items-center justify-center text-sm text-muted-foreground font-medium">
                            {{ $label }}
                        </div>
                    </x-ui.aspect-ratio>
                    <p class="text-xs text-center text-muted-foreground">ratio="{{ $ratio }}"</p>
                </div>
            @endforeach
        </div>
    </section>

    <x-ui.separator />

    <section class="space-y-4">
        <h2 class="text-xs font-semibold uppercase tracking-widest text-muted-foreground">Con imagen</h2>
        <div class="max-w-md">
            <x-ui.aspect-ratio ratio="16/9" class="rounded-lg overflow-hidden bg-muted">
                <img
                    src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=800&q=80"
                    alt="Montaña"
                    class="h-full w-full object-cover"
                />
            </x-ui.aspect-ratio>
        </div>
    </section>

</div>
</x-layouts.showcase>
