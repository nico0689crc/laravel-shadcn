<x-layouts.showcase title="Slider — Showcase">
<div class="mx-auto max-w-[--container-md] px-4 sm:px-6 lg:px-8 py-10 space-y-12">

    <div>
        <h1 class="text-3xl font-bold tracking-tight">Slider</h1>
        <p class="mt-1 text-muted-foreground max-w-prose">Control deslizante con soporte para valor único, rango, múltiples pulgares, orientación vertical y RTL. Drag + teclado + touch.</p>
    </div>

    {{-- Default --}}
    <section class="space-y-4">
        <h2 class="text-xs font-semibold uppercase tracking-widest text-muted-foreground">Default</h2>
        <div class="max-w-sm">
            <x-ui.slider :values="[33]" />
        </div>
    </section>

    <x-ui.separator />

    {{-- Range --}}
    <section class="space-y-4">
        <h2 class="text-xs font-semibold uppercase tracking-widest text-muted-foreground">Range</h2>
        <p class="text-sm text-muted-foreground">Array con dos valores. Los pulgares no se cruzan.</p>
        <div
            class="max-w-sm space-y-2"
            x-data="{ lo: 20, hi: 80 }"
            @slider-change="lo = $event.detail.values[0]; hi = $event.detail.values[1]"
        >
            <div class="flex justify-between text-sm tabular-nums text-muted-foreground">
                <span x-text="lo"></span>
                <span x-text="hi"></span>
            </div>
            <x-ui.slider :values="[20, 80]" name="price_range" />
        </div>
    </section>

    <x-ui.separator />

    {{-- Multiple thumbs --}}
    <section class="space-y-4">
        <h2 class="text-xs font-semibold uppercase tracking-widest text-muted-foreground">Multiple Thumbs</h2>
        <p class="text-sm text-muted-foreground">Array con tres o más valores.</p>
        <div class="max-w-sm">
            <x-ui.slider :values="[10, 50, 90]" />
        </div>
    </section>

    <x-ui.separator />

    {{-- Vertical --}}
    <section class="space-y-4">
        <h2 class="text-xs font-semibold uppercase tracking-widest text-muted-foreground">Vertical</h2>
        <div class="flex items-end gap-8">
            <div class="space-y-2 text-center">
                <x-ui.slider :values="[60]" orientation="vertical" />
                <p class="text-xs text-muted-foreground">Single</p>
            </div>
            <div class="space-y-2 text-center">
                <x-ui.slider :values="[20, 75]" orientation="vertical" />
                <p class="text-xs text-muted-foreground">Range</p>
            </div>
            <div class="space-y-2 text-center">
                <x-ui.slider :values="[60]" orientation="vertical" class="h-32" size="sm" />
                <p class="text-xs text-muted-foreground">sm · h-32</p>
            </div>
            <div class="space-y-2 text-center">
                <x-ui.slider :values="[60]" orientation="vertical" class="h-64" size="lg" />
                <p class="text-xs text-muted-foreground">lg · h-64</p>
            </div>
        </div>
    </section>

    <x-ui.separator />

    {{-- Tamaños --}}
    <section class="space-y-4">
        <h2 class="text-xs font-semibold uppercase tracking-widest text-muted-foreground">Tamaños</h2>
        <div class="max-w-sm space-y-6">
            <div class="space-y-2">
                <p class="text-sm text-muted-foreground">sm</p>
                <x-ui.slider :values="[60]" size="sm" />
            </div>
            <div class="space-y-2">
                <p class="text-sm text-muted-foreground">md (default)</p>
                <x-ui.slider :values="[60]" size="md" />
            </div>
            <div class="space-y-2">
                <p class="text-sm text-muted-foreground">lg</p>
                <x-ui.slider :values="[60]" size="lg" />
            </div>
        </div>
    </section>

    <x-ui.separator />

    {{-- Estados semánticos --}}
    <section class="space-y-4">
        <h2 class="text-xs font-semibold uppercase tracking-widest text-muted-foreground">Estados semánticos</h2>
        <div class="max-w-sm space-y-6">
            @foreach([
                ['state' => null,          'label' => 'Default',     'class' => ''],
                ['state' => 'destructive', 'label' => 'Destructive', 'class' => 'text-destructive'],
                ['state' => 'success',     'label' => 'Success',     'class' => 'text-success'],
                ['state' => 'warning',     'label' => 'Warning',     'class' => 'text-warning'],
                ['state' => 'info',        'label' => 'Info',        'class' => 'text-info'],
            ] as $s)
                <div class="space-y-2">
                    <p class="text-sm {{ $s['class'] }}">{{ $s['label'] }}</p>
                    <x-ui.slider :values="[60]" :state="$s['state']" />
                </div>
            @endforeach
        </div>
    </section>

    <x-ui.separator />

    {{-- Step --}}
    <section class="space-y-4">
        <h2 class="text-xs font-semibold uppercase tracking-widest text-muted-foreground">Step</h2>
        <div class="max-w-sm space-y-6">
            <div class="space-y-2">
                <p class="text-sm text-muted-foreground">step=10</p>
                <x-ui.slider :values="[50]" :step="10" />
            </div>
            <div class="space-y-2">
                <p class="text-sm text-muted-foreground">step=25</p>
                <x-ui.slider :values="[50]" :step="25" />
            </div>
        </div>
    </section>

    <x-ui.separator />

    {{-- Disabled --}}
    <section class="space-y-4">
        <h2 class="text-xs font-semibold uppercase tracking-widest text-muted-foreground">Disabled</h2>
        <div class="max-w-sm space-y-4">
            <x-ui.slider :values="[40]" disabled />
            <x-ui.slider :values="[20, 70]" disabled />
        </div>
    </section>

    <x-ui.separator />

    {{-- RTL --}}
    <section class="space-y-4">
        <h2 class="text-xs font-semibold uppercase tracking-widest text-muted-foreground">RTL</h2>
        <div class="max-w-sm space-y-4">
            <x-ui.slider :values="[30]" rtl />
            <x-ui.slider :values="[20, 80]" rtl />
        </div>
    </section>

    <x-ui.separator />

    {{-- En contexto — mezclador de audio --}}
    <section class="space-y-4">
        <h2 class="text-xs font-semibold uppercase tracking-widest text-muted-foreground">En contexto — mezclador de audio</h2>
        <div class="flex gap-6">
            {{-- Canales verticales --}}
            <x-ui.card class="w-fit">
                <x-ui.card.header>
                    <x-ui.card.title>Mezcla</x-ui.card.title>
                    <x-ui.card.description>Niveles por canal</x-ui.card.description>
                </x-ui.card.header>
                <x-ui.card.content>
                    <div class="flex gap-6 items-end">
                        @foreach([
                            ['label' => 'VOL',  'value' => 80, 'state' => null],
                            ['label' => 'BASS', 'value' => 45, 'state' => null],
                            ['label' => 'MID',  'value' => 60, 'state' => null],
                            ['label' => 'TREBLE','value'=> 55, 'state' => null],
                            ['label' => 'FX',   'value' => 30, 'state' => 'info'],
                        ] as $ch)
                            <div
                                class="flex flex-col items-center gap-2"
                                x-data="{ val: {{ $ch['value'] }} }"
                                @slider-change="val = $event.detail.values[0]"
                            >
                                <span class="text-xs tabular-nums text-muted-foreground w-6 text-center" x-text="val"></span>
                                <x-ui.slider
                                    :values="[$ch['value']]"
                                    :state="$ch['state']"
                                    orientation="vertical"
                                    size="sm"
                                    class="h-32"
                                />
                                <span class="text-xs font-medium text-muted-foreground">{{ $ch['label'] }}</span>
                            </div>
                        @endforeach
                    </div>
                </x-ui.card.content>
                <x-ui.card.footer class="gap-2">
                    <x-ui.button size="sm" variant="outline">Reset</x-ui.button>
                    <x-ui.button size="sm">Aplicar</x-ui.button>
                </x-ui.card.footer>
            </x-ui.card>

            {{-- Ajustes horizontales --}}
            <x-ui.card class="flex-1 min-w-0">
                <x-ui.card.header>
                    <x-ui.card.title>Ajustes de reproducción</x-ui.card.title>
                    <x-ui.card.description>Controlá cada parámetro individualmente.</x-ui.card.description>
                </x-ui.card.header>
                <x-ui.card.content class="space-y-6">
                    @foreach([
                        ['name' => 'volume',  'label' => 'Volumen',   'value' => 75, 'state' => null],
                        ['name' => 'balance', 'label' => 'Balance',   'value' => 50, 'state' => null],
                        ['name' => 'pitch',   'label' => 'Pitch',     'value' => 20, 'state' => 'warning'],
                    ] as $ctrl)
                        <div
                            class="space-y-2"
                            x-data="{ val: {{ $ctrl['value'] }} }"
                            @slider-change="val = $event.detail.values[0]"
                        >
                            <div class="flex items-center justify-between">
                                <x-ui.label>{{ $ctrl['label'] }}</x-ui.label>
                                <span class="text-sm tabular-nums text-muted-foreground" x-text="val + '%'"></span>
                            </div>
                            <x-ui.slider
                                name="{{ $ctrl['name'] }}"
                                :values="[$ctrl['value']]"
                                :state="$ctrl['state']"
                            />
                        </div>
                    @endforeach

                    <div class="space-y-2">
                        <div class="flex items-center justify-between">
                            <x-ui.label>Rango de exportación</x-ui.label>
                            <span
                                class="text-sm tabular-nums text-muted-foreground"
                                x-data="{ lo: 20, hi: 80 }"
                                @slider-change="lo = $event.detail.values[0]; hi = $event.detail.values[1]"
                            >
                                <span x-text="lo + 's'"></span>–<span x-text="hi + 's'"></span>
                            </span>
                        </div>
                        <x-ui.slider :values="[20, 80]" name="export_range" :max="120" />
                    </div>
                </x-ui.card.content>
            </x-ui.card>
        </div>
    </section>

</div>
</x-layouts.showcase>
