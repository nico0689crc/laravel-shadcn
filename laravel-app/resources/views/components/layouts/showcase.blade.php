@php
$navItems = [
    'Fase 3 — Primitivos' => [
        ['button',       'Button'],
        ['badge',        'Badge'],
        ['input',        'Input'],
        ['textarea',     'Textarea'],
        ['label',        'Label'],
        ['separator',    'Separator'],
        ['avatar',       'Avatar'],
        ['progress',     'Progress'],
        ['skeleton',     'Skeleton'],
        ['spinner',      'Spinner'],
        ['kbd',          'Kbd'],
        ['aspect-ratio', 'Aspect Ratio'],
        ['scroll-area',  'Scroll Area'],
    ],
    'Fase 4 — Superficies' => [
        ['card',          'Card'],
        ['alert',         'Alert'],
        ['alert-dialog',  'Alert Dialog'],
        ['dialog',        'Dialog'],
        ['sheet',         'Sheet'],
        ['drawer',        'Drawer'],
        ['hover-card',    'Hover Card'],
        ['tooltip',       'Tooltip'],
        ['popover',       'Popover'],
    ],
    'Fase 5 — Formularios' => [
        ['select',        'Select'],
        ['native-select', 'Native Select'],
        ['input-group',   'Input Group'],
        ['input-otp',     'Input OTP'],
        ['checkbox',      'Checkbox'],
        ['radio-group',   'Radio Group'],
        ['switch',        'Switch'],
        ['slider',        'Slider'],
        ['toggle',        'Toggle'],
        ['combobox',      'Combobox'],
    ],
    'Fase 6 — Navegación' => [
        ['tabs',           'Tabs'],
        ['accordion',      'Accordion'],
        ['collapsible',    'Collapsible'],
        ['breadcrumb',     'Breadcrumb'],
        ['pagination',     'Pagination'],
        ['dropdown-menu',  'Dropdown Menu'],
        ['context-menu',   'Context Menu'],
    ],
    'Fase 7 — Data' => [
        ['table',         'Table'],
        ['data-table',    'Data Table'],
        ['chart',         'Chart'],
    ],
    'Fase 8 — Feedback' => [
        ['toast',   'Toast'],
        ['sonner',  'Sonner'],
    ],
    'Fase 9 — Layout' => [
        ['button-group',  'Button Group'],
        ['empty-state',   'Empty State'],
        ['typography',    'Typography'],
    ],
];

$ready = ['button', 'badge', 'input', 'textarea', 'label', 'separator', 'avatar', 'progress', 'skeleton', 'spinner', 'card', 'alert', 'alert-dialog', 'tooltip', 'dialog', 'sheet', 'drawer', 'hover-card', 'popover', 'select', 'native-select', 'input-group', 'input-otp', 'checkbox', 'radio-group', 'switch', 'slider', 'toggle', 'combobox', 'tabs', 'accordion', 'collapsible', 'breadcrumb', 'pagination', 'table', 'data-table', 'chart', 'toast', 'sonner', 'dropdown-menu', 'context-menu', 'kbd', 'aspect-ratio', 'scroll-area', 'button-group', 'empty-state', 'typography'];

$currentComponent = request()->segment(3);
$isIndex = request()->is('showcase');
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Design System' }} — Showcase</title>

    {{-- Evita flash de tema --}}
    <script>
        (function() {
            const saved = localStorage.getItem('theme')
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches
            if (saved === 'dark' || (!saved && prefersDark)) {
                document.documentElement.classList.add('dark')
            }
        })()
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body
    class="h-screen overflow-hidden bg-background text-foreground antialiased"
    x-data="{ sidebarOpen: false }"
>

{{-- ── Overlay mobile ──────────────────────────────────────────────── --}}
<div
    x-show="sidebarOpen"
    x-transition:enter="transition-opacity duration-200"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition-opacity duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    @click="sidebarOpen = false"
    class="fixed inset-0 z-[--z-overlay] bg-surface-overlay lg:hidden"
    x-cloak
></div>

{{-- ── Layout raíz ─────────────────────────────────────────────────── --}}
<div class="flex h-screen">

    {{-- ── Sidebar ──────────────────────────────────────────────────── --}}
    <aside
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
        class="fixed inset-y-0 left-0 z-[--z-modal] flex w-64 flex-col border-r border-border bg-sidebar transition-transform duration-200 ease-out lg:relative lg:translate-x-0 lg:transition-none"
    >
        {{-- Logo + cerrar --}}
        <div class="flex h-14 shrink-0 items-center justify-between border-b border-sidebar-border px-4">
            <a href="/showcase" class="flex items-center gap-2">
                <div class="size-6 rounded bg-primary flex items-center justify-center">
                    <span class="text-[10px] font-bold text-primary-foreground">DS</span>
                </div>
                <span class="text-sm font-semibold text-sidebar-foreground">Design System</span>
            </a>

            <x-ui.button
                size="icon"
                variant="ghost"
                @click="sidebarOpen = false"
                aria-label="Cerrar sidebar"
                class="lg:hidden -mr-1 size-8 text-muted-foreground"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/>
                </svg>
            </x-ui.button>
        </div>

        {{-- Nav --}}
        <nav class="flex-1 overflow-y-auto py-4 px-2 space-y-5">

            {{-- Inicio --}}
            <div>
                <a
                    href="/showcase"
                    @class([
                        'flex items-center gap-2 rounded-md px-2 py-1.5 text-sm transition-colors',
                        'bg-sidebar-accent text-sidebar-accent-foreground font-medium' => $isIndex,
                        'text-sidebar-foreground hover:bg-sidebar-accent/60 hover:text-sidebar-accent-foreground' => !$isIndex,
                    ])
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75"/>
                    </svg>
                    Inicio
                </a>
            </div>

            {{-- Categorías --}}
            @foreach($navItems as $phase => $items)
                <div>
                    <p class="mb-1 px-2 text-[10px] font-semibold uppercase tracking-widest text-muted-foreground">
                        {{ $phase }}
                    </p>
                    <ul class="space-y-0.5">
                        @foreach($items as [$slug, $name])
                            @php $isReady = in_array($slug, $ready); @endphp
                            <li>
                                @if($isReady)
                                    <a
                                        href="/showcase/components/{{ $slug }}"
                                        @class([
                                            'flex items-center justify-between rounded-md px-2 py-1.5 text-sm transition-colors',
                                            'bg-sidebar-accent text-sidebar-accent-foreground font-medium' => $currentComponent === $slug,
                                            'text-sidebar-foreground hover:bg-sidebar-accent/60 hover:text-sidebar-accent-foreground' => $currentComponent !== $slug,
                                        ])
                                    >
                                        {{ $name }}
                                        @if($currentComponent === $slug)
                                            <span class="size-1.5 rounded-full bg-primary shrink-0"></span>
                                        @endif
                                    </a>
                                @else
                                    <span class="flex items-center justify-between rounded-md px-2 py-1.5 text-sm text-muted-foreground/40 cursor-not-allowed select-none">
                                        {{ $name }}
                                        <x-ui.badge variant="outline" class="text-[9px] h-4 px-1.5 py-0 opacity-50 pointer-events-none">
                                            pronto
                                        </x-ui.badge>
                                    </span>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </nav>

        {{-- Footer sidebar --}}
        <div class="shrink-0 border-t border-sidebar-border px-4 py-3">
            <p class="text-[10px] text-muted-foreground font-mono">shadcn/ui → Laravel Blade</p>
        </div>
    </aside>

    {{-- ── Contenido principal ──────────────────────────────────────── --}}
    <div class="flex flex-1 flex-col overflow-hidden">

        {{-- Topbar --}}
        <header class="flex h-14 shrink-0 items-center justify-between border-b border-border bg-background px-4 lg:px-6">

            {{-- Hamburger (mobile) --}}
            <x-ui.button
                size="icon"
                variant="ghost"
                @click="sidebarOpen = true"
                aria-label="Abrir sidebar"
                class="lg:hidden -ml-1 text-muted-foreground"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
                </svg>
            </x-ui.button>

            {{-- Breadcrumb --}}
            <div class="hidden lg:flex items-center gap-2 text-sm text-muted-foreground">
                <a href="/showcase" class="hover:text-foreground transition-colors">Showcase</a>
                @if($currentComponent)
                    <x-ui.separator orientation="vertical" class="h-4" />
                    <span class="text-foreground font-medium capitalize">{{ str_replace('-', ' ', $currentComponent) }}</span>
                @endif
            </div>

            {{-- Theme toggle --}}
            <x-ui.tooltip content="Cambiar tema" side="bottom">
                <x-ui.button
                    size="icon"
                    variant="ghost"
                    @click="$store.theme.toggle()"
                    aria-label="Cambiar tema"
                    class="text-muted-foreground"
                >
                    <svg x-show="!$store.theme.dark" xmlns="http://www.w3.org/2000/svg" class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="4"/><path d="M12 2v2M12 20v2M4.93 4.93l1.41 1.41M17.66 17.66l1.41 1.41M2 12h2M20 12h2M6.34 17.66l-1.41 1.41M19.07 4.93l-1.41 1.41"/>
                    </svg>
                    <svg x-show="$store.theme.dark" xmlns="http://www.w3.org/2000/svg" class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/>
                    </svg>
                </x-ui.button>
            </x-ui.tooltip>
        </header>

        {{-- Scroll area del contenido --}}
        <main class="flex-1 overflow-y-auto">
            {{ $slot }}
        </main>

    </div>
</div>

<x-ui.sonner />

</body>
</html>
