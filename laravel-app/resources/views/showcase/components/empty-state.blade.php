<x-layouts.showcase title="Empty State — Showcase">
<div class="mx-auto max-w-[--container-lg] px-4 sm:px-6 lg:px-8 py-10 space-y-12">

    <div>
        <h1 class="text-3xl font-bold tracking-tight">Empty State</h1>
        <p class="mt-1 text-muted-foreground max-w-prose">Componente para secciones sin datos. Acepta título, descripción, ícono opcional y un slot para una acción CTA.</p>
    </div>

    <section class="space-y-4">
        <h2 class="text-xs font-semibold uppercase tracking-widest text-muted-foreground">Solo título</h2>
        <x-ui.empty-state title="Sin resultados" />
    </section>

    <x-ui.separator />

    <section class="space-y-4">
        <h2 class="text-xs font-semibold uppercase tracking-widest text-muted-foreground">Con descripción</h2>
        <x-ui.empty-state
            title="No hay proyectos"
            description="Todavía no creaste ningún proyecto. Empezá creando uno nuevo."
        />
    </section>

    <x-ui.separator />

    <section class="space-y-4">
        <h2 class="text-xs font-semibold uppercase tracking-widest text-muted-foreground">Con ícono</h2>
        <x-ui.empty-state
            title="Bandeja de entrada vacía"
            description="No tenés mensajes sin leer. Volvé más tarde."
            icon="circle-info"
        />
    </section>

    <x-ui.separator />

    <section class="space-y-4">
        <h2 class="text-xs font-semibold uppercase tracking-widest text-muted-foreground">Con acción</h2>
        <x-ui.empty-state
            title="No hay integrantes"
            description="Todavía no agregaste integrantes al equipo."
            icon="plus"
        >
            <x-ui.button size="sm">
                <x-ui.icon name="plus" />
                Agregar integrante
            </x-ui.button>
        </x-ui.empty-state>
    </section>

    <x-ui.separator />

    <section class="space-y-4">
        <h2 class="text-xs font-semibold uppercase tracking-widest text-muted-foreground">Uso en tabla</h2>
        <x-ui.table>
            <x-ui.table.header>
                <x-ui.table.row>
                    <x-ui.table.head>Nombre</x-ui.table.head>
                    <x-ui.table.head>Estado</x-ui.table.head>
                    <x-ui.table.head>Fecha</x-ui.table.head>
                </x-ui.table.row>
            </x-ui.table.header>
            <x-ui.table.body>
                <tr>
                    <td colspan="3" class="p-0">
                        <x-ui.empty-state
                            title="Sin registros"
                            description="Aplicá otro filtro o creá un nuevo registro."
                            class="border-0 rounded-none"
                        />
                    </td>
                </tr>
            </x-ui.table.body>
        </x-ui.table>
    </section>

</div>
</x-layouts.showcase>
