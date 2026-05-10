<x-layouts.showcase title="Input OTP — Showcase">
<div class="mx-auto max-w-[--container-lg] px-4 sm:px-6 lg:px-8 py-10 space-y-12">

    <div>
        <h1 class="text-3xl font-bold tracking-tight">Input OTP</h1>
        <p class="mt-1 text-muted-foreground max-w-prose">Input segmentado para códigos de verificación. Soporta paste, navegación con flechas y validación por patrón.</p>
    </div>

    <section class="space-y-4">
        <h2 class="text-xs font-semibold uppercase tracking-widest text-muted-foreground">Básico — 6 dígitos</h2>
        <x-ui.input-otp :length="6" name="otp" />
    </section>

    <x-ui.separator />

    <section class="space-y-4">
        <h2 class="text-xs font-semibold uppercase tracking-widest text-muted-foreground">Solo números (pattern)</h2>
        <x-ui.input-otp :length="6" name="pin" pattern="[0-9]" />
    </section>

    <x-ui.separator />

    <section class="space-y-4">
        <h2 class="text-xs font-semibold uppercase tracking-widest text-muted-foreground">4 dígitos</h2>
        <x-ui.input-otp :length="4" name="code4" pattern="[0-9]" />
    </section>

    <x-ui.separator />

    <section class="space-y-4">
        <h2 class="text-xs font-semibold uppercase tracking-widest text-muted-foreground">Con valor inicial</h2>
        <x-ui.input-otp :length="6" value="123456" name="prefilled" />
    </section>

    <x-ui.separator />

    <section class="space-y-4">
        <h2 class="text-xs font-semibold uppercase tracking-widest text-muted-foreground">Estado error</h2>
        <x-ui.input-otp :length="6" state="destructive" />
        <p class="text-sm text-destructive">Código incorrecto. Intentá de nuevo.</p>
    </section>

    <x-ui.separator />

    <section class="space-y-4">
        <h2 class="text-xs font-semibold uppercase tracking-widest text-muted-foreground">En un formulario</h2>
        <div class="max-w-sm space-y-4">
            <x-ui.form-field message="Ingresá el código que enviamos a tu email.">
                <x-ui.label>Código de verificación</x-ui.label>
                <x-ui.input-otp :length="6" name="verify_code" pattern="[0-9]" />
            </x-ui.form-field>
            <x-ui.button class="w-full">Verificar</x-ui.button>
        </div>
    </section>

</div>
</x-layouts.showcase>
