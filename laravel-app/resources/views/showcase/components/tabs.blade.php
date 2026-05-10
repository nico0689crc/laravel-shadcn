<x-layouts.showcase title="Tabs — Showcase">
<div class="mx-auto max-w-[--container-md] px-4 sm:px-6 lg:px-8 py-10 space-y-12">

    <div>
        <h1 class="text-3xl font-bold tracking-tight">Tabs</h1>
        <p class="mt-1 text-muted-foreground max-w-prose">Navegación entre paneles de contenido. Implementación completa del API de Radix: <code class="text-xs bg-muted px-1 py-0.5 rounded">orientation</code>, <code class="text-xs bg-muted px-1 py-0.5 rounded">activationMode</code>, navegación por teclado (↑↓←→ Home End) con <code class="text-xs bg-muted px-1 py-0.5 rounded">loop</code>, roving tabindex y ARIA completo.</p>
    </div>

    {{-- Default --}}
    <section class="space-y-4">
        <h2 class="text-xs font-semibold uppercase tracking-widest text-muted-foreground">Default</h2>
        <x-ui.tabs value="account" class="w-full max-w-sm">
            <x-ui.tabs.list>
                <x-ui.tabs.trigger value="account">Account</x-ui.tabs.trigger>
                <x-ui.tabs.trigger value="password">Password</x-ui.tabs.trigger>
            </x-ui.tabs.list>
            <x-ui.tabs.content value="account">
                <x-ui.card>
                    <x-ui.card.header>
                        <x-ui.card.title>Account</x-ui.card.title>
                        <x-ui.card.description>Hacé cambios en tu cuenta acá. Guardá cuando termines.</x-ui.card.description>
                    </x-ui.card.header>
                    <x-ui.card.content class="space-y-3">
                        <x-ui.form-field>
                            <x-ui.label>Nombre</x-ui.label>
                            <x-ui.input value="Pedro Duarte" />
                        </x-ui.form-field>
                        <x-ui.form-field>
                            <x-ui.label>Username</x-ui.label>
                            <x-ui.input value="@peduarte" />
                        </x-ui.form-field>
                    </x-ui.card.content>
                    <x-ui.card.footer>
                        <x-ui.button size="sm">Guardar cambios</x-ui.button>
                    </x-ui.card.footer>
                </x-ui.card>
            </x-ui.tabs.content>
            <x-ui.tabs.content value="password">
                <x-ui.card>
                    <x-ui.card.header>
                        <x-ui.card.title>Password</x-ui.card.title>
                        <x-ui.card.description>Cambiá tu contraseña acá.</x-ui.card.description>
                    </x-ui.card.header>
                    <x-ui.card.content class="space-y-3">
                        <x-ui.form-field>
                            <x-ui.label>Contraseña actual</x-ui.label>
                            <x-ui.input type="password" />
                        </x-ui.form-field>
                        <x-ui.form-field>
                            <x-ui.label>Nueva contraseña</x-ui.label>
                            <x-ui.input type="password" />
                        </x-ui.form-field>
                    </x-ui.card.content>
                    <x-ui.card.footer>
                        <x-ui.button size="sm">Cambiar contraseña</x-ui.button>
                    </x-ui.card.footer>
                </x-ui.card>
            </x-ui.tabs.content>
        </x-ui.tabs>
    </section>

    <x-ui.separator />

    {{-- Múltiples tabs --}}
    <section class="space-y-4">
        <h2 class="text-xs font-semibold uppercase tracking-widest text-muted-foreground">Múltiples pestañas</h2>
        <x-ui.tabs value="overview">
            <x-ui.tabs.list>
                <x-ui.tabs.trigger value="overview">Overview</x-ui.tabs.trigger>
                <x-ui.tabs.trigger value="analytics">Analytics</x-ui.tabs.trigger>
                <x-ui.tabs.trigger value="reports">Reports</x-ui.tabs.trigger>
                <x-ui.tabs.trigger value="notifications" disabled>Notifications</x-ui.tabs.trigger>
            </x-ui.tabs.list>
            <x-ui.tabs.content value="overview">
                <p class="text-sm text-muted-foreground">Panel de overview con métricas generales.</p>
            </x-ui.tabs.content>
            <x-ui.tabs.content value="analytics">
                <p class="text-sm text-muted-foreground">Datos analíticos detallados.</p>
            </x-ui.tabs.content>
            <x-ui.tabs.content value="reports">
                <p class="text-sm text-muted-foreground">Reportes generados automáticamente.</p>
            </x-ui.tabs.content>
            <x-ui.tabs.content value="notifications">
                <p class="text-sm text-muted-foreground">Configuración de notificaciones.</p>
            </x-ui.tabs.content>
        </x-ui.tabs>
    </section>

    <x-ui.separator />

    {{-- Vertical --}}
    <section class="space-y-4">
        <h2 class="text-xs font-semibold uppercase tracking-widest text-muted-foreground">Vertical (orientation="vertical") — flechas ↑↓</h2>
        <x-ui.tabs value="general" orientation="vertical" class="flex gap-6">
            <x-ui.tabs.list>
                <x-ui.tabs.trigger value="general">General</x-ui.tabs.trigger>
                <x-ui.tabs.trigger value="security">Seguridad</x-ui.tabs.trigger>
                <x-ui.tabs.trigger value="integrations">Integraciones</x-ui.tabs.trigger>
                <x-ui.tabs.trigger value="billing">Facturación</x-ui.tabs.trigger>
            </x-ui.tabs.list>
            <div class="flex-1">
                <x-ui.tabs.content value="general" class="mt-0"><p class="text-sm text-muted-foreground">Configuración general de la cuenta.</p></x-ui.tabs.content>
                <x-ui.tabs.content value="security" class="mt-0"><p class="text-sm text-muted-foreground">Contraseña, 2FA y sesiones activas.</p></x-ui.tabs.content>
                <x-ui.tabs.content value="integrations" class="mt-0"><p class="text-sm text-muted-foreground">Conectá herramientas externas.</p></x-ui.tabs.content>
                <x-ui.tabs.content value="billing" class="mt-0"><p class="text-sm text-muted-foreground">Plan, facturación y métodos de pago.</p></x-ui.tabs.content>
            </div>
        </x-ui.tabs>
    </section>

    <x-ui.separator />

    {{-- Manual activation --}}
    <section class="space-y-4">
        <h2 class="text-xs font-semibold uppercase tracking-widest text-muted-foreground">activationMode="manual" — foco con flechas, Enter/Space para activar</h2>
        <x-ui.tabs value="tab1" activationMode="manual" class="w-full max-w-sm">
            <x-ui.tabs.list>
                <x-ui.tabs.trigger value="tab1">Tab 1</x-ui.tabs.trigger>
                <x-ui.tabs.trigger value="tab2">Tab 2</x-ui.tabs.trigger>
                <x-ui.tabs.trigger value="tab3">Tab 3</x-ui.tabs.trigger>
            </x-ui.tabs.list>
            <x-ui.tabs.content value="tab1"><p class="text-sm text-muted-foreground">Tab 1 — las flechas mueven el foco sin cambiar el panel activo.</p></x-ui.tabs.content>
            <x-ui.tabs.content value="tab2"><p class="text-sm text-muted-foreground">Tab 2.</p></x-ui.tabs.content>
            <x-ui.tabs.content value="tab3"><p class="text-sm text-muted-foreground">Tab 3.</p></x-ui.tabs.content>
        </x-ui.tabs>
    </section>

    <x-ui.separator />

    {{-- En contexto --}}
    <section class="space-y-4">
        <h2 class="text-xs font-semibold uppercase tracking-widest text-muted-foreground">En contexto — dashboard</h2>
        <x-ui.tabs value="month" class="w-full">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold">Ventas</h3>
                <x-ui.tabs.list>
                    <x-ui.tabs.trigger value="week">Semana</x-ui.tabs.trigger>
                    <x-ui.tabs.trigger value="month">Mes</x-ui.tabs.trigger>
                    <x-ui.tabs.trigger value="year">Año</x-ui.tabs.trigger>
                </x-ui.tabs.list>
            </div>
            <x-ui.tabs.content value="week">
                <div class="h-32 rounded-lg border border-dashed border-border flex items-center justify-center text-sm text-muted-foreground">
                    Gráfico semanal
                </div>
            </x-ui.tabs.content>
            <x-ui.tabs.content value="month">
                <div class="h-32 rounded-lg border border-dashed border-border flex items-center justify-center text-sm text-muted-foreground">
                    Gráfico mensual
                </div>
            </x-ui.tabs.content>
            <x-ui.tabs.content value="year">
                <div class="h-32 rounded-lg border border-dashed border-border flex items-center justify-center text-sm text-muted-foreground">
                    Gráfico anual
                </div>
            </x-ui.tabs.content>
        </x-ui.tabs>
    </section>

</div>
</x-layouts.showcase>
