<x-layouts.showcase title="Alert Dialog — Showcase">
<div class="mx-auto max-w-[--container-lg] px-4 sm:px-6 lg:px-8 py-10 space-y-12">

    <div>
        <h1 class="text-3xl font-bold tracking-tight">Alert Dialog</h1>
        <p class="mt-1 text-muted-foreground max-w-prose">Modal de confirmación para acciones destructivas o irreversibles. Sin botón X — solo acción o cancelación explícita.</p>
    </div>

    {{-- ── Básico ────────────────────────────────────────────────────────── --}}
    <section class="space-y-4">
        <h2 class="text-xs font-semibold uppercase tracking-widest text-muted-foreground">Básico</h2>
        <x-ui.alert-dialog>
            <x-ui.alert-dialog.trigger>
                <x-ui.button variant="outline">Abrir alert dialog</x-ui.button>
            </x-ui.alert-dialog.trigger>
            <x-ui.alert-dialog.content>
                <x-ui.alert-dialog.header>
                    <x-ui.alert-dialog.title>¿Estás seguro?</x-ui.alert-dialog.title>
                    <x-ui.alert-dialog.description>
                        Esta acción no se puede deshacer. El elemento será eliminado permanentemente.
                    </x-ui.alert-dialog.description>
                </x-ui.alert-dialog.header>
                <x-ui.alert-dialog.footer>
                    <x-ui.alert-dialog.cancel>Cancelar</x-ui.alert-dialog.cancel>
                    <x-ui.alert-dialog.action variant="destructive" @click="open = false">
                        Eliminar
                    </x-ui.alert-dialog.action>
                </x-ui.alert-dialog.footer>
            </x-ui.alert-dialog.content>
        </x-ui.alert-dialog>
    </section>

    <x-ui.separator />

    {{-- ── Size sm (footer en 2 columnas) ──────────────────────────────── --}}
    <section class="space-y-4">
        <h2 class="text-xs font-semibold uppercase tracking-widest text-muted-foreground">Size sm — footer 2 columnas</h2>
        <x-ui.alert-dialog>
            <x-ui.alert-dialog.trigger>
                <x-ui.button variant="outline">Alert sm</x-ui.button>
            </x-ui.alert-dialog.trigger>
            <x-ui.alert-dialog.content size="sm">
                <x-ui.alert-dialog.header>
                    <x-ui.alert-dialog.title>Confirmar cambio</x-ui.alert-dialog.title>
                    <x-ui.alert-dialog.description>
                        ¿Querés guardar los cambios antes de salir?
                    </x-ui.alert-dialog.description>
                </x-ui.alert-dialog.header>
                <x-ui.alert-dialog.footer>
                    <x-ui.alert-dialog.cancel>No</x-ui.alert-dialog.cancel>
                    <x-ui.alert-dialog.action @click="open = false">Sí, guardar</x-ui.alert-dialog.action>
                </x-ui.alert-dialog.footer>
            </x-ui.alert-dialog.content>
        </x-ui.alert-dialog>
    </section>

    <x-ui.separator />

    {{-- ── Con media (ícono decorativo) ────────────────────────────────── --}}
    <section class="space-y-4">
        <h2 class="text-xs font-semibold uppercase tracking-widest text-muted-foreground">Con media (ícono)</h2>
        <div class="flex flex-wrap gap-3">
            {{-- Destructivo con ícono --}}
            <x-ui.alert-dialog>
                <x-ui.alert-dialog.trigger>
                    <x-ui.button variant="destructive">Eliminar cuenta</x-ui.button>
                </x-ui.alert-dialog.trigger>
                <x-ui.alert-dialog.content>
                    <x-ui.alert-dialog.header>
                        <x-ui.alert-dialog.media class="bg-destructive/10">
                            <x-ui.icon name="triangle-alert" class="size-5 text-destructive" />
                        </x-ui.alert-dialog.media>
                        <x-ui.alert-dialog.title>Eliminar cuenta</x-ui.alert-dialog.title>
                        <x-ui.alert-dialog.description>
                            Esta acción eliminará permanentemente tu cuenta y todos tus datos. No hay forma de recuperarlos.
                        </x-ui.alert-dialog.description>
                    </x-ui.alert-dialog.header>
                    <x-ui.alert-dialog.footer>
                        <x-ui.alert-dialog.cancel>Cancelar</x-ui.alert-dialog.cancel>
                        <x-ui.alert-dialog.action variant="destructive" @click="open = false">
                            Sí, eliminar
                        </x-ui.alert-dialog.action>
                    </x-ui.alert-dialog.footer>
                </x-ui.alert-dialog.content>
            </x-ui.alert-dialog>

            {{-- Informativo --}}
            <x-ui.alert-dialog>
                <x-ui.alert-dialog.trigger>
                    <x-ui.button variant="outline">Publicar cambios</x-ui.button>
                </x-ui.alert-dialog.trigger>
                <x-ui.alert-dialog.content>
                    <x-ui.alert-dialog.header>
                        <x-ui.alert-dialog.media>
                            <x-ui.icon name="circle-check" class="size-5 text-success" />
                        </x-ui.alert-dialog.media>
                        <x-ui.alert-dialog.title>¿Publicar los cambios?</x-ui.alert-dialog.title>
                        <x-ui.alert-dialog.description>
                            Los cambios serán visibles para todos los usuarios inmediatamente.
                        </x-ui.alert-dialog.description>
                    </x-ui.alert-dialog.header>
                    <x-ui.alert-dialog.footer>
                        <x-ui.alert-dialog.cancel>Revisar primero</x-ui.alert-dialog.cancel>
                        <x-ui.alert-dialog.action @click="open = false">Publicar</x-ui.alert-dialog.action>
                    </x-ui.alert-dialog.footer>
                </x-ui.alert-dialog.content>
            </x-ui.alert-dialog>
        </div>
    </section>

</div>
</x-layouts.showcase>
