<x-layouts.showcase title="Toast — Showcase">
<div class="mx-auto max-w-[--container-md] px-4 sm:px-6 lg:px-8 py-10 space-y-12">

    <div>
        <h1 class="text-3xl font-bold tracking-tight">Toast</h1>
        <p class="mt-1 text-muted-foreground max-w-prose">Notificaciones temporales via Alpine store. Se disparan con <code class="text-xs bg-muted px-1 py-0.5 rounded">$store.toast.add()</code> desde cualquier parte de la página. El <code class="text-xs bg-muted px-1 py-0.5 rounded">&lt;x-ui.toaster /&gt;</code> se coloca una sola vez en el layout.</p>
    </div>

    {{-- Variantes --}}
    <section class="space-y-4">
        <h2 class="text-xs font-semibold uppercase tracking-widest text-muted-foreground">Variantes</h2>
        <div class="flex flex-wrap gap-3">
            <x-ui.button
                variant="outline"
                @click="$store.toast.add('Mensaje por defecto', { description: 'Esto es un toast estándar.' })"
            >
                Default
            </x-ui.button>

            <x-ui.button
                variant="outline"
                @click="$store.toast.success('Cambios guardados', { description: 'Tu perfil fue actualizado correctamente.' })"
            >
                Success
            </x-ui.button>

            <x-ui.button
                variant="outline"
                @click="$store.toast.error('Error al guardar', { description: 'Verificá tu conexión e intentá de nuevo.' })"
            >
                Destructive
            </x-ui.button>

            <x-ui.button
                variant="outline"
                @click="$store.toast.warning('Límite cercano', { description: 'Usaste el 90% de tu almacenamiento.' })"
            >
                Warning
            </x-ui.button>

            <x-ui.button
                variant="outline"
                @click="$store.toast.info('Actualización disponible', { description: 'Hay una nueva versión lista para instalar.' })"
            >
                Info
            </x-ui.button>
        </div>
    </section>

    <x-ui.separator />

    {{-- Solo título --}}
    <section class="space-y-4">
        <h2 class="text-xs font-semibold uppercase tracking-widest text-muted-foreground">Solo título (sin descripción)</h2>
        <div class="flex flex-wrap gap-3">
            <x-ui.button variant="outline" @click="$store.toast.add('Copiado al portapapeles')">
                Sin descripción
            </x-ui.button>
            <x-ui.button variant="outline" @click="$store.toast.success('¡Enviado!')">
                Success corto
            </x-ui.button>
        </div>
    </section>

    <x-ui.separator />

    {{-- Con acción --}}
    <section class="space-y-4">
        <h2 class="text-xs font-semibold uppercase tracking-widest text-muted-foreground">Con acción</h2>
        <div class="flex flex-wrap gap-3">
            <x-ui.button
                variant="outline"
                @click="$store.toast.add('Elemento eliminado', {
                    description: 'El elemento fue movido a la papelera.',
                    action: { label: 'Deshacer', onClick: () => $store.toast.info('Acción deshecha') }
                })"
            >
                Con acción "Deshacer"
            </x-ui.button>

            <x-ui.button
                variant="outline"
                @click="$store.toast.warning('Sesión por expirar', {
                    description: 'Tu sesión expira en 5 minutos.',
                    duration: Infinity,
                    action: { label: 'Renovar', onClick: () => $store.toast.success('Sesión renovada') }
                })"
            >
                Persistente + acción
            </x-ui.button>
        </div>
    </section>

    <x-ui.separator />

    {{-- Duración custom --}}
    <section class="space-y-4">
        <h2 class="text-xs font-semibold uppercase tracking-widest text-muted-foreground">Duración custom</h2>
        <div class="flex flex-wrap gap-3">
            <x-ui.button variant="outline" @click="$store.toast.add('Cierra en 1 segundo', { duration: 1000 })">
                1 segundo
            </x-ui.button>
            <x-ui.button variant="outline" @click="$store.toast.add('Cierra en 8 segundos', { duration: 8000 })">
                8 segundos
            </x-ui.button>
            <x-ui.button variant="outline" @click="$store.toast.info('Toast persistente (no cierra solo)', { duration: Infinity })">
                Persistente
            </x-ui.button>
        </div>
    </section>

    <x-ui.separator />

    {{-- Stack --}}
    <section class="space-y-4">
        <h2 class="text-xs font-semibold uppercase tracking-widest text-muted-foreground">Stack múltiple</h2>
        <x-ui.button
            variant="outline"
            @click="
                $store.toast.success('Paso 1 completado');
                setTimeout(() => $store.toast.info('Paso 2 en progreso...'), 400);
                setTimeout(() => $store.toast.warning('Paso 3 requiere atención'), 800);
            "
        >
            Disparar 3 toasts
        </x-ui.button>
    </section>

    <x-ui.separator />

    {{-- API reference --}}
    <section class="space-y-4">
        <h2 class="text-xs font-semibold uppercase tracking-widest text-muted-foreground">API</h2>
        <x-ui.card class="max-w-lg">
            <x-ui.card.content class="pt-6">
                <x-ui.table>
                    <x-ui.table.header>
                        <x-ui.table.row>
                            <x-ui.table.head>Método</x-ui.table.head>
                            <x-ui.table.head>Descripción</x-ui.table.head>
                        </x-ui.table.row>
                    </x-ui.table.header>
                    <x-ui.table.body>
                        @foreach([
                            ['$store.toast.add(msg, opts)',     'Toast genérico. opts: variant, description, duration, action'],
                            ['$store.toast.success(msg, opts)', 'Variante success (fondo verde suave)'],
                            ['$store.toast.error(msg, opts)',   'Variante destructive (fondo rojo sólido)'],
                            ['$store.toast.warning(msg, opts)', 'Variante warning (fondo amarillo suave)'],
                            ['$store.toast.info(msg, opts)',    'Variante info (fondo azul suave)'],
                            ['$store.toast.dismiss(id)',         'Cierra un toast por su id retornado por add()'],
                        ] as [$method, $desc])
                            <x-ui.table.row>
                                <x-ui.table.cell><code class="text-xs font-mono">{{ $method }}</code></x-ui.table.cell>
                                <x-ui.table.cell class="text-sm text-muted-foreground">{{ $desc }}</x-ui.table.cell>
                            </x-ui.table.row>
                        @endforeach
                    </x-ui.table.body>
                </x-ui.table>
            </x-ui.card.content>
        </x-ui.card>
    </section>

</div>
</x-layouts.showcase>
