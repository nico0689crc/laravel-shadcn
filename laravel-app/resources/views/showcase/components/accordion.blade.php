<x-layouts.showcase title="Accordion — Showcase">
<div class="mx-auto max-w-[--container-md] px-4 sm:px-6 lg:px-8 py-10 space-y-12">

    <div>
        <h1 class="text-3xl font-bold tracking-tight">Accordion</h1>
        <p class="mt-1 text-muted-foreground max-w-prose">Secciones colapsables con implementación completa del API de Radix: <code class="text-xs bg-muted px-1 py-0.5 rounded">type</code>, <code class="text-xs bg-muted px-1 py-0.5 rounded">collapsible</code>, <code class="text-xs bg-muted px-1 py-0.5 rounded">disabled</code> en root e item, <code class="text-xs bg-muted px-1 py-0.5 rounded">orientation</code>, navegación por teclado (↑↓ Home End). Animación de altura via CSS Grid.</p>
    </div>

    {{-- Single collapsible --}}
    <section class="space-y-4">
        <h2 class="text-xs font-semibold uppercase tracking-widest text-muted-foreground">type="single" collapsible</h2>
        <x-ui.accordion type="single" value="item-1" collapsible class="w-full max-w-lg">
            <x-ui.accordion.item value="item-1">
                <x-ui.accordion.trigger>¿Es accesible?</x-ui.accordion.trigger>
                <x-ui.accordion.content>
                    Sí. Sigue el patrón WAI-ARIA con roles, atributos <code class="text-xs bg-muted px-1 rounded">aria-expanded</code>, <code class="text-xs bg-muted px-1 rounded">data-state</code> y navegación por teclado completa.
                </x-ui.accordion.content>
            </x-ui.accordion.item>
            <x-ui.accordion.item value="item-2">
                <x-ui.accordion.trigger>¿Está estilizado?</x-ui.accordion.trigger>
                <x-ui.accordion.content>
                    Sí. Usa tokens del sistema — border, foreground, muted-foreground — y funciona en modo claro y oscuro.
                </x-ui.accordion.content>
            </x-ui.accordion.item>
            <x-ui.accordion.item value="item-3">
                <x-ui.accordion.trigger>¿Está animado?</x-ui.accordion.trigger>
                <x-ui.accordion.content>
                    Sí. La animación de altura usa el CSS Grid trick (<code class="text-xs bg-muted px-1 rounded">grid-template-rows: 0fr → 1fr</code>) sin JavaScript adicional.
                </x-ui.accordion.content>
            </x-ui.accordion.item>
        </x-ui.accordion>
    </section>

    <x-ui.separator />

    {{-- Multiple --}}
    <section class="space-y-4">
        <h2 class="text-xs font-semibold uppercase tracking-widest text-muted-foreground">type="multiple" — varios ítems abiertos</h2>
        <x-ui.accordion type="multiple" :value="['item-a', 'item-c']" class="w-full max-w-lg">
            <x-ui.accordion.item value="item-a">
                <x-ui.accordion.trigger>Opción A (abierto por defecto)</x-ui.accordion.trigger>
                <x-ui.accordion.content>En modo multiple, este ítem permanece abierto mientras se abren otros.</x-ui.accordion.content>
            </x-ui.accordion.item>
            <x-ui.accordion.item value="item-b">
                <x-ui.accordion.trigger>Opción B</x-ui.accordion.trigger>
                <x-ui.accordion.content>Podés tener múltiples secciones abiertas simultáneamente.</x-ui.accordion.content>
            </x-ui.accordion.item>
            <x-ui.accordion.item value="item-c">
                <x-ui.accordion.trigger>Opción C (abierto por defecto)</x-ui.accordion.trigger>
                <x-ui.accordion.content>El prop <code class="text-xs bg-muted px-1 rounded">:value="['item-a', 'item-c']"</code> inicializa ambos ítems abiertos.</x-ui.accordion.content>
            </x-ui.accordion.item>
        </x-ui.accordion>
    </section>

    <x-ui.separator />

    {{-- Disabled root --}}
    <section class="space-y-4">
        <h2 class="text-xs font-semibold uppercase tracking-widest text-muted-foreground">disabled en root — todos los ítems inactivos</h2>
        <x-ui.accordion type="single" value="item-1" disabled class="w-full max-w-lg">
            <x-ui.accordion.item value="item-1">
                <x-ui.accordion.trigger>Ítem 1 (abierto, no se puede cerrar)</x-ui.accordion.trigger>
                <x-ui.accordion.content>El accordion completo está deshabilitado. Los triggers muestran <code class="text-xs bg-muted px-1 rounded">data-disabled</code> y no responden al click.</x-ui.accordion.content>
            </x-ui.accordion.item>
            <x-ui.accordion.item value="item-2">
                <x-ui.accordion.trigger>Ítem 2 (no se puede abrir)</x-ui.accordion.trigger>
                <x-ui.accordion.content>Contenido del ítem 2.</x-ui.accordion.content>
            </x-ui.accordion.item>
        </x-ui.accordion>
    </section>

    <x-ui.separator />

    {{-- Disabled item individual --}}
    <section class="space-y-4">
        <h2 class="text-xs font-semibold uppercase tracking-widest text-muted-foreground">disabled en item individual</h2>
        <x-ui.accordion type="single" collapsible class="w-full max-w-lg">
            <x-ui.accordion.item value="item-1">
                <x-ui.accordion.trigger>Ítem habilitado</x-ui.accordion.trigger>
                <x-ui.accordion.content>Este ítem funciona normalmente.</x-ui.accordion.content>
            </x-ui.accordion.item>
            <x-ui.accordion.item value="item-2" disabled>
                <x-ui.accordion.trigger>Ítem deshabilitado</x-ui.accordion.trigger>
                <x-ui.accordion.content>Este contenido no es accesible.</x-ui.accordion.content>
            </x-ui.accordion.item>
            <x-ui.accordion.item value="item-3">
                <x-ui.accordion.trigger>Ítem habilitado</x-ui.accordion.trigger>
                <x-ui.accordion.content>Este ítem también funciona normalmente.</x-ui.accordion.content>
            </x-ui.accordion.item>
        </x-ui.accordion>
    </section>

    <x-ui.separator />

    {{-- En contexto — FAQ --}}
    <section class="space-y-4">
        <h2 class="text-xs font-semibold uppercase tracking-widest text-muted-foreground">En contexto — FAQ</h2>
        <div class="max-w-lg">
            <h3 class="text-lg font-semibold mb-4">Preguntas frecuentes</h3>
            <x-ui.accordion type="single" collapsible>
                @foreach([
                    ['q' => '¿Cuánto tarda el envío?',           'a' => 'Los envíos estándar demoran entre 3 y 5 días hábiles. El envío express llega al día siguiente si hacés el pedido antes de las 14 hs.'],
                    ['q' => '¿Puedo devolver un producto?',       'a' => 'Sí, tenés 30 días desde la recepción para solicitar una devolución sin costo. El producto debe estar sin uso y con su embalaje original.'],
                    ['q' => '¿Cómo rastro mi pedido?',           'a' => 'Una vez despachado, recibís un email con el número de seguimiento y el link directo al sitio del correo.'],
                    ['q' => '¿Aceptan pagos en cuotas?',         'a' => 'Aceptamos tarjetas de crédito de todos los bancos. Las cuotas sin interés varían según el banco emisor y la promoción vigente.'],
                    ['q' => '¿Tienen atención al cliente 24/7?', 'a' => 'Nuestro equipo está disponible de lunes a viernes de 9 a 18 hs. Podés dejar tu consulta y te respondemos el siguiente día hábil.'],
                ] as $faq)
                    <x-ui.accordion.item value="{{ $loop->index }}">
                        <x-ui.accordion.trigger>{{ $faq['q'] }}</x-ui.accordion.trigger>
                        <x-ui.accordion.content>{{ $faq['a'] }}</x-ui.accordion.content>
                    </x-ui.accordion.item>
                @endforeach
            </x-ui.accordion>
        </div>
    </section>

</div>
</x-layouts.showcase>
