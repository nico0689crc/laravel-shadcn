<x-layouts.showcase title="Design System — Showcase">

    <div class="mx-auto max-w-[--container-xl] px-4 sm:px-6 lg:px-8 py-10">

        {{-- Header --}}
        <div class="mb-10">
            <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-foreground">
                Design System
            </h1>
            <p class="mt-2 text-md text-muted-foreground max-w-prose">
                Componentes Blade basados en shadcn/ui. Todos los tokens de color, tipografía
                y espaciado se controlan desde <code class="text-sm font-mono bg-muted px-1.5 py-0.5 rounded">design-tokens.css</code>.
            </p>
        </div>

        {{-- Tokens de color --}}
        <section class="mb-16">
            <h2 class="text-xl font-semibold mb-6">Tokens de color</h2>

            <div class="space-y-8">

                {{-- Semánticos --}}
                <div>
                    <p class="text-xs font-semibold uppercase tracking-widest text-muted-foreground mb-3">Semánticos</p>
                    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3">
                        @foreach([
                            ['background',  'Background',  'text-foreground'],
                            ['card',        'Card',        'text-card-foreground'],
                            ['primary',     'Primary',     'text-primary-foreground'],
                            ['secondary',   'Secondary',   'text-secondary-foreground'],
                            ['muted',       'Muted',       'text-muted-foreground'],
                            ['accent',      'Accent',      'text-accent-foreground'],
                        ] as [$bg, $label, $text])
                            <div class="rounded-lg border border-border overflow-hidden">
                                <div class="h-12 bg-{{ $bg }}"></div>
                                <div class="px-3 py-2 bg-card">
                                    <p class="text-xs font-medium text-foreground">{{ $label }}</p>
                                    <p class="text-xs text-muted-foreground font-mono">--{{ $bg }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Estados de feedback --}}
                <div>
                    <p class="text-xs font-semibold uppercase tracking-widest text-muted-foreground mb-3">Estados de feedback</p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3">
                        @foreach([
                            ['destructive', 'Destructive', 'red'],
                            ['success',     'Success',     'green'],
                            ['warning',     'Warning',     'yellow'],
                            ['info',        'Info',        'blue'],
                        ] as [$state, $label, $_])
                            <div class="rounded-lg border border-border overflow-hidden">
                                <div class="h-8 bg-{{ $state }}"></div>
                                <div class="h-8 bg-{{ $state }}-subtle"></div>
                                <div class="px-3 py-2 bg-card space-y-1">
                                    <p class="text-xs font-medium text-foreground">{{ $label }}</p>
                                    <div class="flex gap-2 flex-wrap">
                                        <span class="text-[10px] text-{{ $state }}-foreground bg-{{ $state }} px-1.5 py-0.5 rounded">filled</span>
                                        <span class="text-[10px] text-{{ $state }}-subtle-foreground bg-{{ $state }}-subtle border border-{{ $state }}-border px-1.5 py-0.5 rounded">subtle</span>
                                        <span class="text-[10px] text-{{ $state }} px-1.5 py-0.5">text</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </section>

        {{-- Tipografía --}}
        <section class="mb-16">
            <h2 class="text-xl font-semibold mb-6">Tipografía</h2>
            <div class="space-y-4 bg-card border border-border rounded-xl p-6">
                <div class="space-y-1">
                    <p class="text-xs text-muted-foreground font-mono">Display · 60px · bold</p>
                    <p class="text-5xl font-bold leading-tight tracking-tight">Sistema de diseño</p>
                </div>
                <div class="border-t border-border pt-4 space-y-1">
                    <p class="text-xs text-muted-foreground font-mono">H1 · 40px · semibold</p>
                    <h1 class="text-4xl font-semibold leading-tight">Componentes accesibles</h1>
                </div>
                <div class="border-t border-border pt-4 space-y-1">
                    <p class="text-xs text-muted-foreground font-mono">H2 · 30px · semibold</p>
                    <h2 class="text-3xl font-semibold leading-snug">Tailwind + Blade</h2>
                </div>
                <div class="border-t border-border pt-4 space-y-1">
                    <p class="text-xs text-muted-foreground font-mono">H3 · 22px · medium</p>
                    <h3 class="text-xl font-medium leading-snug">Tokens de diseño</h3>
                </div>
                <div class="border-t border-border pt-4 space-y-1">
                    <p class="text-xs text-muted-foreground font-mono">Body · 16px · normal · max 65ch</p>
                    <p class="text-md leading-relaxed max-w-prose text-foreground">
                        El sistema de diseño utiliza CSS custom properties para todos los tokens visuales.
                        Un cambio en <code class="font-mono text-sm bg-muted px-1 rounded">design-tokens.css</code>
                        propaga el cambio a todos los componentes en ambos temas.
                    </p>
                </div>
                <div class="border-t border-border pt-4 space-y-1">
                    <p class="text-xs text-muted-foreground font-mono">Small · 13px</p>
                    <p class="text-sm text-muted-foreground">Texto secundario y descripciones de ayuda</p>
                </div>
                <div class="border-t border-border pt-4 space-y-1">
                    <p class="text-xs text-muted-foreground font-mono">Caption · 12px</p>
                    <p class="text-xs text-muted-foreground">Metadata, timestamps, labels de formulario</p>
                </div>
                <div class="border-t border-border pt-4 space-y-1">
                    <p class="text-xs text-muted-foreground font-mono">Code · mono</p>
                    <code class="text-sm font-mono bg-muted px-2 py-1 rounded">design-tokens.css</code>
                </div>
            </div>
        </section>

        {{-- Sombras --}}
        <section class="mb-16">
            <h2 class="text-xl font-semibold mb-6">Elevación</h2>
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4">
                @foreach(['xs', 'sm', 'md', 'lg', 'xl', '2xl'] as $size)
                    <div class="bg-card rounded-lg p-4 shadow-{{ $size }} flex flex-col items-center gap-2">
                        <span class="text-xs font-mono text-muted-foreground">shadow-{{ $size }}</span>
                    </div>
                @endforeach
            </div>
        </section>

        {{-- Componentes (próximamente) --}}
        <section>
            <h2 class="text-xl font-semibold mb-6">Componentes</h2>
            @php
            $components = [
                'Fase 3 — Primitivos' => [
                    ['button',    'Button',    true],
                    ['input',     'Input',     true],
                    ['textarea',  'Textarea',  false],
                    ['badge',     'Badge',     true],
                    ['label',     'Label',     false],
                    ['separator', 'Separator', false],
                    ['avatar',    'Avatar',    false],
                    ['progress',  'Progress',  false],
                    ['skeleton',  'Skeleton',  false],
                    ['spinner',   'Spinner',   false],
                ],
                'Fase 4 — Superficies' => [
                    ['card',         'Card',         false],
                    ['alert',        'Alert',        false],
                    ['dialog',       'Dialog',       false],
                    ['sheet',        'Sheet',        false],
                    ['drawer',       'Drawer',       false],
                    ['tooltip',      'Tooltip',      false],
                    ['popover',      'Popover',      false],
                ],
                'Fase 5 — Formularios' => [
                    ['select',       'Select',       false],
                    ['checkbox',     'Checkbox',     false],
                    ['radio-group',  'Radio Group',  false],
                    ['switch',       'Switch',       false],
                    ['slider',       'Slider',       false],
                ],
                'Fase 6 — Navegación' => [
                    ['tabs',         'Tabs',         false],
                    ['accordion',    'Accordion',    false],
                    ['breadcrumb',   'Breadcrumb',   false],
                    ['pagination',   'Pagination',   false],
                ],
                'Fase 7 — Data' => [
                    ['table',        'Table',        false],
                    ['chart',        'Chart',        false],
                ],
                'Fase 8 — Feedback' => [
                    ['toast',        'Toast',        false],
                ],
            ];
            @endphp

            <div class="space-y-8">
                @foreach($components as $phase => $items)
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-widest text-muted-foreground mb-3">{{ $phase }}</p>
                        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-2">
                            @foreach($items as [$slug, $name, $ready])
                                <a
                                    href="{{ $ready ? "/showcase/components/{$slug}" : '#' }}"
                                    @class([
                                        'group flex items-center justify-between rounded-lg border px-4 py-3 text-sm font-medium transition-all',
                                        'border-border bg-card hover:border-primary/50 hover:bg-accent/30 cursor-pointer' => $ready,
                                        'border-dashed border-border bg-transparent opacity-50 cursor-not-allowed' => !$ready,
                                    ])
                                >
                                    <span @class(['text-foreground group-hover:text-primary transition-colors' => $ready, 'text-muted-foreground' => !$ready])>
                                        {{ $name }}
                                    </span>
                                    @if($ready)
                                        <span class="text-muted-foreground text-xs">→</span>
                                    @else
                                        <span class="text-[10px] text-muted-foreground">pronto</span>
                                    @endif
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

    </div>

</x-layouts.showcase>
