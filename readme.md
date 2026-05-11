# Design System — shadcn/ui → Laravel Blade

Sistema de diseño basado en shadcn/ui, portado a componentes Blade sin dependencia de React.

## Proyectos

| Directorio | Stack | Rol |
|---|---|---|
| `shadcn-inspector/` | React + shadcn/ui + Tailwind v4 | Fuente de verdad visual |
| `laravel-app/` | Laravel 12 + Tailwind v4 + Alpine.js | Destino final de los componentes |

Un único archivo controla toda la apariencia: `laravel-app/resources/css/design-tokens.css`

---

## Instalación

```bash
# Laravel app
cd laravel-app
composer install
cp .env.example .env
php artisan key:generate
npm install
npm run dev
php artisan serve
```

Showcase disponible en `http://localhost:8000/showcase`.

---

## Uso de componentes

Los componentes se consumen con el prefijo `<x-ui.*>`:

```html
<x-ui.button variant="default">Guardar</x-ui.button>
<x-ui.input placeholder="Email" />
<x-ui.badge state="success">Activo</x-ui.badge>
```

Consultar el showcase en `/showcase` para ver todas las variantes disponibles.

---

## Iconos

El sistema usa [Lucide](https://lucide.dev) — 1942 iconos SVG disponibles.

### Explorar iconos

Abrir `/showcase/components/icons` para buscar y filtrar todos los iconos por categoría.
Al hacer clic en un ícono se copia el tag al portapapeles.

### Uso básico

```html
<x-lucide-home />
<x-lucide-settings />
<x-lucide-arrow-left />
```

### Tamaño

Los iconos heredan el tamaño del contexto (`currentColor`, sin `width`/`height` fijos).
Controlar tamaño con clases Tailwind:

```html
<x-lucide-home class="size-4" />   {{-- 16px --}}
<x-lucide-home class="size-5" />   {{-- 20px --}}
<x-lucide-home class="size-6" />   {{-- 24px (default visual) --}}
```

### Color

Los iconos usan `stroke="currentColor"` — heredan el color del texto del padre:

```html
<x-lucide-check class="size-4 text-success" />
<x-lucide-alert-triangle class="size-4 text-warning" />
<x-lucide-info class="size-4 text-muted-foreground" />
```

### Grosor de trazo

```html
<x-lucide-home class="size-5 stroke-[1]" />    {{-- fino --}}
<x-lucide-home class="size-5 stroke-[1.5]" />  {{-- regular --}}
<x-lucide-home class="size-5 stroke-[2]" />    {{-- default --}}
<x-lucide-home class="size-5 stroke-[2.5]" />  {{-- bold --}}
```

### Dentro de botones

Los botones del sistema aceptan iconos directamente en el slot:

```html
<x-ui.button>
    <x-lucide-plus />
    Nuevo
</x-ui.button>

<x-ui.button size="icon" variant="ghost">
    <x-lucide-settings />
</x-ui.button>
```

### Dentro de inputs

```html
<x-ui.input placeholder="Buscar...">
    <x-slot:leading>
        <x-lucide-search />
    </x-slot:leading>
</x-ui.input>

<x-ui.input type="password" placeholder="Contraseña">
    <x-slot:leading><x-lucide-lock /></x-slot:leading>
    <x-slot:trailing><x-lucide-eye /></x-slot:trailing>
</x-ui.input>
```

### SVGs disponibles

Los SVGs se encuentran en:
```
vendor/mallardduck/blade-lucide-icons/resources/svg/
```

Cada archivo se corresponde con un componente: `home.svg` → `<x-lucide-home />`.

---

## Tokens de diseño

Todos los colores, tipografías y espaciados están definidos como CSS custom properties en `design-tokens.css`. Usar siempre tokens semánticos:

```html
{{-- ✅ tokens semánticos --}}
<div class="bg-background text-foreground">
<div class="bg-card border border-border">
<p class="text-muted-foreground">

{{-- ❌ valores hardcodeados --}}
<div class="bg-white text-gray-900">
```

---

## Estructura de archivos clave

```
laravel-app/
├── resources/
│   ├── css/
│   │   ├── design-tokens.css        ← tokens de color, tipografía, sombras
│   │   └── app.css                  ← entrada CSS
│   ├── js/
│   │   └── app.js                   ← Alpine.js + stores globales
│   └── views/
│       ├── components/ui/           ← componentes Blade (<x-ui.*>)
│       └── showcase/                ← páginas del design system
├── config/
│   └── icons.php                    ← iconos legacy (Heroicons, en desuso)
└── composer.json
```
