<x-layouts.showcase title="Combobox — Showcase">
<div class="mx-auto max-w-[--container-md] px-4 sm:px-6 lg:px-8 py-10 space-y-12">

    <div>
        <h1 class="text-3xl font-bold tracking-tight">Combobox</h1>
        <p class="mt-1 text-muted-foreground max-w-prose">Select con búsqueda integrada. Filtra opciones en tiempo real mientras el usuario escribe. Compatible con formularios HTML via input hidden.</p>
    </div>

    {{-- Default --}}
    <section class="space-y-4">
        <h2 class="text-xs font-semibold uppercase tracking-widest text-muted-foreground">Default</h2>
        <div class="max-w-xs">
            <x-ui.combobox
                name="framework"
                placeholder="Seleccioná un framework..."
                :options="[
                    'next'    => 'Next.js',
                    'sveltekit' => 'SvelteKit',
                    'nuxt'    => 'Nuxt.js',
                    'remix'   => 'Remix',
                    'astro'   => 'Astro',
                    'laravel' => 'Laravel',
                ]"
            />
        </div>
    </section>

    <x-ui.separator />

    {{-- Con valor inicial --}}
    <section class="space-y-4">
        <h2 class="text-xs font-semibold uppercase tracking-widest text-muted-foreground">Con valor seleccionado</h2>
        <div class="max-w-xs">
            <x-ui.combobox
                name="country"
                value="ar"
                :options="[
                    'ar' => 'Argentina',
                    'br' => 'Brasil',
                    'cl' => 'Chile',
                    'uy' => 'Uruguay',
                    'py' => 'Paraguay',
                    'bo' => 'Bolivia',
                    'pe' => 'Perú',
                    'co' => 'Colombia',
                    've' => 'Venezuela',
                    'ec' => 'Ecuador',
                ]"
                placeholder="Seleccioná un país..."
            />
        </div>
    </section>

    <x-ui.separator />

    {{-- Tamaños --}}
    <section class="space-y-4">
        <h2 class="text-xs font-semibold uppercase tracking-widest text-muted-foreground">Tamaños</h2>
        <div class="space-y-3 max-w-xs">
            @foreach(['sm' => 'Small', 'md' => 'Medium (default)', 'lg' => 'Large'] as $size => $label)
                <x-ui.form-field>
                    <x-ui.label>{{ $label }}</x-ui.label>
                    <x-ui.combobox
                        size="{{ $size }}"
                        placeholder="Seleccioná..."
                        :options="['opt1' => 'Opción 1', 'opt2' => 'Opción 2', 'opt3' => 'Opción 3']"
                    />
                </x-ui.form-field>
            @endforeach
        </div>
    </section>

    <x-ui.separator />

    {{-- Estados semánticos --}}
    <section class="space-y-4">
        <h2 class="text-xs font-semibold uppercase tracking-widest text-muted-foreground">Estados semánticos</h2>
        <div class="space-y-4 max-w-xs">
            <x-ui.form-field state="destructive" message="Seleccioná un rol válido.">
                <x-ui.label state="destructive">Rol</x-ui.label>
                <x-ui.combobox state="destructive" placeholder="Seleccioná..." :options="['admin' => 'Admin', 'editor' => 'Editor']" />
            </x-ui.form-field>
            <x-ui.form-field state="success" message="Rol disponible.">
                <x-ui.label state="success">Rol</x-ui.label>
                <x-ui.combobox state="success" value="editor" :options="['admin' => 'Admin', 'editor' => 'Editor']" />
            </x-ui.form-field>
        </div>
    </section>

    <x-ui.separator />

    {{-- En contexto --}}
    <section class="space-y-4">
        <h2 class="text-xs font-semibold uppercase tracking-widest text-muted-foreground">En contexto — formulario</h2>
        <x-ui.card class="max-w-sm">
            <x-ui.card.header>
                <x-ui.card.title>Nuevo proyecto</x-ui.card.title>
                <x-ui.card.description>Configurá los detalles del proyecto.</x-ui.card.description>
            </x-ui.card.header>
            <x-ui.card.content class="space-y-4">
                <x-ui.form-field>
                    <x-ui.label>Framework</x-ui.label>
                    <x-ui.combobox
                        name="framework"
                        placeholder="Buscar framework..."
                        :options="['laravel' => 'Laravel', 'next' => 'Next.js', 'nuxt' => 'Nuxt.js', 'remix' => 'Remix', 'astro' => 'Astro']"
                    />
                </x-ui.form-field>
                <x-ui.form-field>
                    <x-ui.label>Base de datos</x-ui.label>
                    <x-ui.combobox
                        name="db"
                        value="postgres"
                        :options="['postgres' => 'PostgreSQL', 'mysql' => 'MySQL', 'sqlite' => 'SQLite', 'mongo' => 'MongoDB']"
                    />
                </x-ui.form-field>
            </x-ui.card.content>
            <x-ui.card.footer>
                <x-ui.button size="sm">Crear proyecto</x-ui.button>
            </x-ui.card.footer>
        </x-ui.card>
    </section>

</div>
</x-layouts.showcase>
