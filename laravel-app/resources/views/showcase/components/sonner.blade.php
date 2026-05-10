<x-layouts.showcase title="Sonner — Showcase">
<div class="mx-auto max-w-[--container-lg] px-4 sm:px-6 lg:px-8 py-10 space-y-12">

    <div>
        <h1 class="text-3xl font-bold tracking-tight">Sonner</h1>
        <p class="mt-1 text-muted-foreground max-w-prose">Toast stack con efecto visual apilado. Los toasts más recientes están al frente; los anteriores se ven apilados detrás. Al hacer hover se expanden todos.</p>
    </div>

    <section class="space-y-4">
        <h2 class="text-xs font-semibold uppercase tracking-widest text-muted-foreground">Variantes</h2>
        <div class="flex flex-wrap gap-2">
            <x-ui.button variant="outline" @click="$store.toast.add('Mensaje por defecto', { description: 'Notificación estándar sin variante.' })">Default</x-ui.button>
            <x-ui.button variant="outline" @click="$store.toast.success('Guardado correctamente', { description: 'Los cambios fueron aplicados.' })">Success</x-ui.button>
            <x-ui.button variant="outline" @click="$store.toast.error('Error al procesar', { description: 'Verificá tu conexión.' })">Error</x-ui.button>
            <x-ui.button variant="outline" @click="$store.toast.warning('Límite cercano', { description: 'Usaste el 90% del almacenamiento.' })">Warning</x-ui.button>
            <x-ui.button variant="outline" @click="$store.toast.info('Nueva versión disponible', { description: 'Actualización lista para instalar.' })">Info</x-ui.button>
        </div>
    </section>

    <x-ui.separator />

    <section class="space-y-4">
        <h2 class="text-xs font-semibold uppercase tracking-widest text-muted-foreground">Loading</h2>
        <div class="flex flex-wrap gap-2">
            <x-ui.button variant="outline" @click="const id = $store.toast.loading('Subiendo archivo...'); setTimeout(() => { $store.toast.dismiss(id); $store.toast.success('Archivo subido'); }, 3000)">
                Loading (3s → success)
            </x-ui.button>
        </div>
    </section>

    <x-ui.separator />

    <section class="space-y-4">
        <h2 class="text-xs font-semibold uppercase tracking-widest text-muted-foreground">Promise</h2>
        <div class="flex flex-wrap gap-2">
            <x-ui.button variant="outline"
                @click="$store.toast.promise(
                    new Promise(resolve => setTimeout(resolve, 2000, 'ok')),
                    { loading: 'Guardando datos...', success: '¡Datos guardados!', error: 'No se pudo guardar' }
                )"
            >
                Promise (resolve)
            </x-ui.button>
            <x-ui.button variant="outline"
                @click="$store.toast.promise(
                    new Promise((_, reject) => setTimeout(reject, 2000, new Error('timeout'))),
                    { loading: 'Procesando...', success: 'Listo', error: err => 'Falló: ' + err.message }
                )"
            >
                Promise (reject)
            </x-ui.button>
        </div>
    </section>

    <x-ui.separator />

    <section class="space-y-4">
        <h2 class="text-xs font-semibold uppercase tracking-widest text-muted-foreground">Con acción</h2>
        <x-ui.button variant="outline"
            @click="$store.toast.add('Elemento eliminado', {
                description: 'El ítem fue movido a la papelera.',
                action: { label: 'Deshacer', onClick: () => $store.toast.success('Acción deshecha') }
            })"
        >
            Con acción "Deshacer"
        </x-ui.button>
    </section>

    <x-ui.separator />

    <section class="space-y-4">
        <h2 class="text-xs font-semibold uppercase tracking-widest text-muted-foreground">Stack — disparar varios</h2>
        <x-ui.button variant="outline"
            @click="
                $store.toast.success('Toast 1');
                setTimeout(() => $store.toast.info('Toast 2'), 200);
                setTimeout(() => $store.toast.warning('Toast 3'), 400);
            "
        >
            Disparar 3 toasts
        </x-ui.button>
        <p class="text-sm text-muted-foreground">Hover sobre el stack para expandir todos.</p>
    </section>

</div>
</x-layouts.showcase>
