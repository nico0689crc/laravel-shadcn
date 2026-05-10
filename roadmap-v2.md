# Roadmap v2 — Componentes Pendientes

Análisis basado en lectura directa del código fuente en `shadcn-inspector/src/components/ui/`. Cada componente incluye: sub-componentes, variantes/props clave, estrategia Alpine.js, dependencias, y estimación de complejidad.

---

## Resumen de estado

| Estado | Cantidad |
|---|---|
| Implementados en Blade | 28 |
| **Pendientes (este roadmap)** | **32** |
| Total del sistema | 60 |

---

## Fase 0 — Prerequisito: sistema de iconos

**Debe implementarse antes que cualquier otro componente pendiente.** Actualmente hay 70+ SVGs hardcodeados inline en los componentes Blade. No existe abstracción de íconos.

### `icon` — componente `<x-ui.icon>`

**Complejidad:** ⭐⭐ (implementación inicial) + ⭐⭐⭐ (migración de componentes existentes)

**Problema actual:** cada componente embebe el `<svg>` completo inline. El inspector React usa `lucide-react`, los Blade usan paths de Heroicons outline. No hay consistencia ni punto único de cambio.

---

#### Diseño del componente

```blade
{{-- Uso básico --}}
<x-ui.icon name="check" />

{{-- Con size explícito --}}
<x-ui.icon name="chevron-down" size="sm" />

{{-- Con clases extra (color, margin, etc.) --}}
<x-ui.icon name="x" class="text-muted-foreground" />

{{-- Icono accesible (para iconos sin texto adyacente) --}}
<x-ui.icon name="search" aria-label="Buscar" />
```

**Props:**
| Prop | Tipo | Default | Descripción |
|---|---|---|---|
| `name` | string | requerido | Nombre del ícono (ej: `check`, `chevron-down`) |
| `size` | `sm\|md\|lg\|auto` | `auto` | `sm`=size-3.5, `md`=size-4, `lg`=size-[18px]. `auto` hereda del padre vía `[&_svg]` |
| `aria-hidden` | boolean | `true` | `false` solo cuando el ícono tiene significado semántico |
| `aria-label` | string | null | Requiere `aria-hidden="false"` implícito |
| `stroke-width` | string | `1.5` | Ancho del trazo (Lucide default) |
| `class` | string | — | Clases adicionales |

**Implementación del componente Blade:**
```blade
@props([
    'name'         => null,
    'size'         => 'auto',
    'strokeWidth'  => '1.5',
    'ariaLabel'    => null,
])

@php
$sizeClass = match($size) {
    'sm'   => 'size-3.5',
    'md'   => 'size-4',
    'lg'   => 'size-[18px]',
    default => '',  // auto: el padre controla via [&_svg]:size-*
};

$ariaHidden = $ariaLabel ? 'false' : 'true';

// Obtiene el path del registro de íconos
$iconData = config("icons.{$name}");
@endphp

<svg
    xmlns="http://www.w3.org/2000/svg"
    viewBox="0 0 24 24"
    fill="none"
    stroke="currentColor"
    stroke-width="{{ $strokeWidth }}"
    stroke-linecap="round"
    stroke-linejoin="round"
    aria-hidden="{{ $ariaHidden }}"
    @if($ariaLabel) aria-label="{{ $ariaLabel }}" role="img" @endif
    {{ $attributes->class($sizeClass) }}
>
    {!! $iconData ?? $slot !!}
</svg>
```

---

#### Registro de íconos — `config/icons.php`

Cada ícono es el contenido interno del SVG (paths, circles, etc.). Nombres en **kebab-case**, alineados con Lucide.

**Set mínimo requerido por los componentes existentes:**

```php
return [
    // Navigation
    'chevron-down'      => '<path d="m6 9 6 6 6-6"/>',
    'chevron-up'        => '<path d="m18 15-6-6-6 6"/>',
    'chevron-left'      => '<path d="m15 18-6-6 6-6"/>',
    'chevron-right'     => '<path d="m9 18 6-6-6-6"/>',
    'chevrons-up-down'  => '<path d="m7 15 5 5 5-5"/><path d="m7 9 5-5 5 5"/>',
    'arrow-up'          => '<path d="m5 12 7-7 7 7"/><path d="M12 19V5"/>',
    'arrow-down'        => '<path d="m19 12-7 7-7-7"/><path d="M12 5v14"/>',

    // Actions
    'check'             => '<path d="M20 6 9 17l-5-5"/>',
    'x'                 => '<path d="M18 6 6 18"/><path d="m6 6 12 12"/>',
    'plus'              => '<path d="M5 12h14"/><path d="M12 5v14"/>',
    'minus'             => '<path d="M5 12h14"/>',
    'search'            => '<circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/>',
    'dots-horizontal'   => '<circle cx="12" cy="12" r="1"/><circle cx="19" cy="12" r="1"/><circle cx="5" cy="12" r="1"/>',
    'dots-vertical'     => '<circle cx="12" cy="12" r="1"/><circle cx="12" cy="5" r="1"/><circle cx="12" cy="19" r="1"/>',
    'filter'            => '<polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/>',

    // Status / Feedback
    'circle-check'      => '<circle cx="12" cy="12" r="10"/><path d="m9 12 2 2 4-4"/>',
    'circle-x'          => '<circle cx="12" cy="12" r="10"/><path d="m15 9-6 6"/><path d="m9 9 6 6"/>',
    'circle-alert'      => '<circle cx="12" cy="12" r="10"/><line x1="12" x2="12" y1="8" y2="12"/><line x1="12" x2="12.01" y1="16" y2="16"/>',
    'triangle-alert'    => '<path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3"/>',
    'info'              => '<circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/>',
    'octagon-x'         => '<polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"/><path d="m15 9-6 6"/><path d="m9 9 6 6"/>',

    // UI Controls
    'eye'               => '<path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/>',
    'eye-off'           => '<path d="M9.88 9.88a3 3 0 1 0 4.24 4.24"/><path d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68"/><path d="M6.61 6.61A13.526 13.526 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61"/><line x1="2" x2="22" y1="2" y2="22"/>',
    'copy'              => '<rect width="14" height="14" x="8" y="8" rx="2" ry="2"/><path d="M4 16c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2"/>',
    'external-link'     => '<path d="M15 3h6v6"/><path d="M10 14 21 3"/><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/>',
    'panel-left'        => '<rect width="18" height="18" x="3" y="3" rx="2"/><path d="M9 3v18"/>',
    'grip-vertical'     => '<circle cx="9" cy="12" r="1"/><circle cx="9" cy="5" r="1"/><circle cx="9" cy="19" r="1"/><circle cx="15" cy="12" r="1"/><circle cx="15" cy="5" r="1"/><circle cx="15" cy="19" r="1"/>',

    // Loading
    'loader-2'          => '<path d="M21 12a9 9 0 1 1-6.219-8.56"/>',

    // Misc
    'moon'              => '<path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z"/>',
    'sun'               => '<circle cx="12" cy="12" r="4"/><path d="M12 2v2M12 20v2M4.93 4.93l1.41 1.41M17.66 17.66l1.41 1.41M2 12h2M20 12h2M6.34 17.66l-1.41 1.41M19.07 4.93l-1.41 1.41"/>',
];
```

---

#### Estrategia de migración

Los 70+ SVGs inline en los componentes existentes deben reemplazarse con `<x-ui.icon>`. Es un refactor puro — no cambia la apariencia si los paths son equivalentes.

**Prioridad de migración:**

| Componente | SVGs inline | Íconos usados |
|---|---|---|
| `data-table.blade.php` | ~12 | search, chevrons-up-down, arrow-up, arrow-down, check, filter, dots-horizontal |
| `toaster.blade.php` | ~6 | circle-check, octagon-x, triangle-alert, info, x, loader-2 |
| `pagination/` | ~4 | chevron-left, chevron-right, dots-horizontal |
| `helper-text.blade.php` | ~4 | circle-check, circle-x, triangle-alert, info |
| `alert.blade.php` | 0 (usa slot) | — (el caller pasa el svg) |
| `dialog/content.blade.php` | 1 | x |
| `sheet.blade.php` | 1 | x |
| `accordion/trigger.blade.php` | 1 | chevron-down |
| `select/trigger.blade.php` | 1 | chevrons-up-down |
| `select/item.blade.php` | 1 | check |
| `breadcrumb/separator.blade.php` | 1 | chevron-right |
| `breadcrumb/ellipsis.blade.php` | 1 | dots-horizontal |
| `checkbox.blade.php` | 1 | check |

**Proceso:**
1. Crear `resources/views/components/ui/icon.blade.php`
2. Crear `config/icons.php` con el set mínimo
3. Migrar un componente a la vez, verificando visualmente
4. Extender el set de íconos a medida que los nuevos componentes lo requieran

---

#### Íconos requeridos por los componentes pendientes

| Componente pendiente | Íconos necesarios |
|---|---|
| `alert-dialog` | (ninguno propio, los pasa el caller) |
| `drawer` | x |
| `command` | search, check |
| `dropdown-menu` | check, chevron-right |
| `context-menu` | check, chevron-right |
| `menubar` | check, chevron-right |
| `navigation-menu` | chevron-down |
| `calendar` | chevron-left, chevron-right, chevron-down |
| `carousel` | chevron-left, chevron-right |
| `sidebar` | panel-left, chevron-right, dots-horizontal |
| `sonner` | circle-check, info, triangle-alert, octagon-x, loader-2 |
| `input-group` | search (addon ejemplo) |
| `input-otp` | minus |
| `resizable` | grip-vertical |
| `hover-card` | (ninguno propio) |
| `collapsible` | chevron-down (opcional) |

---

## Fase A — Quick wins (sin JS o Alpine trivial)

Componentes que son CSS puro o requieren Alpine.js mínimo. Ideal para implementar en lote.

### A1 — `aspect-ratio`

**Complejidad:** ⭐ Mínima — CSS puro, sin Alpine

**Sub-componentes:** `<x-ui.aspect-ratio>`

**Props:**
- `ratio` (number, requerido) — ej: `ratio="16/9"`, `ratio="1"`, `ratio="4/3"`
- `class` (passthrough)

**Implementación Blade:**
```blade
<x-ui.aspect-ratio ratio="{{ $ratio }}" {{ $attributes }}>
    {{ $slot }}
</x-ui.aspect-ratio>
```
Usa CSS custom property `--ratio` + `aspect-[var(--ratio)]` en Tailwind v4.

**Uso típico:** wrapper de imágenes, videos, mapas.

---

### A2 — `scroll-area`

**Complejidad:** ⭐ Mínima — CSS + scrollbar custom

**Sub-componentes:**
- `<x-ui.scroll-area>` — raíz
- `scroll-area/scrollbar.blade.php` — scrollbar custom (opcional, interno)

**Props:**
- `orientation` (vertical | horizontal, default: vertical)
- `class`

**Implementación:** `overflow-auto` con scrollbar estilizado via CSS (`scrollbar-width: thin` + `scrollbar-color`). En Tailwind v4 se puede hacer con utilidades nativas.

---

### A3 — `toggle`

**Complejidad:** ⭐⭐ Baja — Alpine `x-data` + `aria-pressed`

**Sub-componentes:** `<x-ui.toggle>`

**Variantes:**
- `variant`: `default` | `outline`
- `size`: `default` (h-8) | `sm` (h-7) | `lg` (h-9)

**Props:**
- `variant`, `size`, `pressed` (boolean, estado inicial), `disabled`

**Alpine.js:**
```js
x-data="{ pressed: {{ $pressed ? 'true' : 'false' }} }"
@click="pressed = !pressed"
:aria-pressed="pressed"
:data-state="pressed ? 'on' : 'off'"
```

**Estados CSS:** `aria-pressed:bg-muted`, `data-[state=on]:bg-muted`

---

### A4 — `toggle-group`

**Complejidad:** ⭐⭐ Baja — Alpine para selección

**Sub-componentes:**
- `<x-ui.toggle-group>` — contenedor
- `toggle-group/item.blade.php` — ítem individual

**Props del grupo:**
- `variant`: `default` | `outline`
- `size`: `default` | `sm` | `lg`
- `orientation`: `horizontal` | `vertical`
- `spacing`: `0` (sin gap, bordes fusionados) | `n` (gap en px múltiplo de 4)
- `multiple`: boolean (default: false — selección única)
- `value`: valor inicial

**Alpine.js:**
```js
// selección única
x-data="{ value: '{{ $value }}' }"

// selección múltiple
x-data="{ values: [] }"
```

**CSS especial:** cuando `spacing=0`, los items se fusionan como segmented control (border collapse + primero/último redondeados).

---

### A5 — `collapsible`

**Complejidad:** ⭐⭐ Baja — Alpine `x-show` + `x-collapse`

**Sub-componentes:**
- `<x-ui.collapsible>` — raíz
- `collapsible/trigger.blade.php`
- `collapsible/content.blade.php`

**Props:**
- `open` (boolean, default: false) — estado inicial
- `disabled`

**Alpine.js:**
```js
// Raíz
x-data="{ open: {{ $open ? 'true' : 'false' }} }"
:data-state="open ? 'open' : 'closed'"

// Trigger
@click="open = !open"
:aria-expanded="open"

// Content
x-show="open"
x-collapse  // plugin Alpine para animación de altura
```

**Nota:** Requiere el plugin `@alpinejs/collapse` para la animación de altura suave.

---

### A6 — `kbd`

**Complejidad:** ⭐ Mínima — HTML semántico + estilos

**Sub-componentes:** `<x-ui.kbd>`

**Props:** texto del slot, `class`

**Implementación:** `<kbd>` con `font-mono text-xs bg-muted border border-border rounded px-1.5 py-0.5 shadow-sm`

**Uso típico:** documentación de atajos de teclado, hints en interfaces.

---

### A7 — `native-select`

**Complejidad:** ⭐ Mínima — `<select>` nativo estilizado

**Sub-componentes:** `<x-ui.native-select>`

**Props:** `size` (sm|md|lg), `state` (default|error|success|warning), `disabled`, `placeholder`, `name`, `id`, todos los atributos nativos de `<select>`

**Diferencia vs `x-ui.select`:** sin Alpine, sin popup custom — el `<select>` nativo del navegador. Más accesible en mobile, menos control visual.

**Estados:** mismos tokens que `input` (`border-destructive-border`, etc.)

---

### A8 — `typography`

**Complejidad:** ⭐ Mínima — clases Tailwind + tokens tipográficos

**Sub-componentes (todos como Blade components independientes):**

| Componente | Tag | Clases clave |
|---|---|---|
| `<x-ui.typography.h1>` | `<h1>` | `text-4xl font-bold leading-[1.1] tracking-tight` |
| `<x-ui.typography.h2>` | `<h2>` | `text-3xl font-semibold leading-[1.2]` |
| `<x-ui.typography.h3>` | `<h3>` | `text-2xl font-semibold leading-[1.25]` |
| `<x-ui.typography.h4>` | `<h4>` | `text-xl font-medium leading-[1.3]` |
| `<x-ui.typography.p>` | `<p>` | `text-sm leading-relaxed max-w-prose` |
| `<x-ui.typography.lead>` | `<p>` | `text-xl text-muted-foreground leading-relaxed` |
| `<x-ui.typography.large>` | `<div>` | `text-lg font-semibold` |
| `<x-ui.typography.small>` | `<small>` | `text-sm font-medium leading-none` |
| `<x-ui.typography.muted>` | `<p>` | `text-sm text-muted-foreground` |
| `<x-ui.typography.code>` | `<code>` | `font-mono text-sm bg-muted rounded px-1.5 py-0.5` |
| `<x-ui.typography.blockquote>` | `<blockquote>` | `border-l-2 pl-6 italic text-muted-foreground` |
| `<x-ui.typography.list>` | `<ul>` | `list-disc list-inside space-y-1 text-sm` |

**Alternativa:** un único `<x-ui.text>` con prop `as` (h1|h2|...|p|lead|...) para evitar proliferación de archivos.

---

### A9 — `empty-state`

**Complejidad:** ⭐ Mínima — componente de display

**Sub-componentes:** `<x-ui.empty-state>`

**Props:**
- `title` (string)
- `description` (string, opcional)
- `icon` (nombre Heroicon/Lucide, opcional)
- `action` (slot opcional para botón CTA)

**Layout:** centrado verticalmente, ícono arriba, título, descripción, acción. Usa tokens: `text-muted-foreground`, `bg-muted/30`.

**Ya referenciado** en `CLAUDE.md` como `x-ui.empty-state` pero el archivo no existe aún.

---

### A10 — `button-group`

**Complejidad:** ⭐ Mínima — CSS wrapper, sin JS

**Sub-componentes:** `<x-ui.button-group>`

**Props:**
- `orientation`: `horizontal` | `vertical`
- `size`: propaga a todos los botones hijos

**Implementación:** wrapper `flex` que colapsa los `border-radius` internos de los `<x-ui.button>` hijos (similar a `spacing=0` de ToggleGroup). Usa selectores CSS `:first-child`, `:last-child`, `:not(:first-child):not(:last-child)`.

---

### A11 — `item`

**Complejidad:** ⭐ Mínima — list item genérico

**Sub-componentes:** `<x-ui.item>`

**Props:**
- `as`: `li` | `div` (default: `div`)
- `inset`: boolean (añade padding-left para alinear con items que tienen ícono)

**Uso:** ítem genérico de lista, base para construir listas de configuración, perfiles, settings. Padding `px-3 py-2`, `gap-2`, `items-center`.

---

## Fase B — Overlays y paneles (Alpine.js medio)

Componentes que son paneles flotantes o modales. Comparten patrón Alpine: un store o `x-data` en el componente raíz, un trigger que lo activa, y un portal/overlay.

**Patrón Alpine base para overlays:**
```js
x-data="{ open: false }"
// Trigger: @click="open = true"
// Close: @click="open = false" / @keydown.escape.window="open = false"
// Overlay: x-show="open", @click="open = false"
// Content: x-show="open", @click.stop, x-trap.inert.noscroll="open"
```

---

### B1 — `alert-dialog`

**Complejidad:** ⭐⭐⭐ Media — Alpine, foco trampa, confirmación destructiva

**Sub-componentes:**
- `<x-ui.alert-dialog>` — raíz (x-data)
- `alert-dialog/trigger.blade.php`
- `alert-dialog/content.blade.php` — overlay + popup fusionados
- `alert-dialog/header.blade.php`
- `alert-dialog/footer.blade.php`
- `alert-dialog/media.blade.php` — ícono/imagen decorativa en header
- `alert-dialog/title.blade.php`
- `alert-dialog/description.blade.php`
- `alert-dialog/action.blade.php` — botón de confirmación (delega a x-ui.button)
- `alert-dialog/cancel.blade.php` — botón cancelar (cierra el diálogo)

**Props de content:**
- `size`: `default` (max-w-sm en desktop) | `sm` (max-w-xs, 2 columnas en footer)

**Diferencia vs `dialog`:** footer siempre visible, sin botón X de cierre, semántica de confirmación. Foco trampa obligatorio.

**Alpine.js:**
```js
// Raíz
x-data="{ open: false }"
// Content: focus trap
x-trap.inert.noscroll="open"
// Overlay: bloquea scroll, backdrop blur
x-show="open"
@click="open = false"
// Escape desde cualquier lugar
@keydown.escape.window="open && (open = false)"
```

---

### B2 — `hover-card`

**Complejidad:** ⭐⭐ Baja — Alpine con delay de hover

**Sub-componentes:**
- `<x-ui.hover-card>` — raíz
- `hover-card/trigger.blade.php`
- `hover-card/content.blade.php`

**Props de content:**
- `side`: `top` | `bottom` | `left` | `right` (default: bottom)
- `align`: `start` | `center` | `end` (default: center)
- `side-offset`: `4`

**Tamaño fijo:** `w-64` (256px)

**Alpine.js:** hover con delay para evitar cierres accidentales:
```js
x-data="{ open: false, timeout: null }"
@mouseenter="clearTimeout(timeout); timeout = setTimeout(() => open = true, 150)"
@mouseleave="timeout = setTimeout(() => open = false, 200)"
```

---

### B3 — `drawer`

**Complejidad:** ⭐⭐⭐ Media — Alpine, animaciones de deslizamiento, gestos touch opcionales

**Librería original:** [Vaul](https://vaul.emilkowal.ski/api) de Emil Kowalski. En Blade se reimplementa el comportamiento visual con Alpine.js — sin drag-to-dismiss nativo ni snap points en la primera versión.

---

#### Sub-componentes

| Componente | Descripción |
|---|---|
| `<x-ui.drawer>` | Raíz — provee `x-data` con el estado `open` y la prop `direction` |
| `drawer/trigger.blade.php` | Botón que abre el drawer (`@click="open = true"`) |
| `drawer/close.blade.php` | Botón que cierra el drawer (`@click="open = false"`) |
| `drawer/overlay.blade.php` | Backdrop semitransparente (`fixed inset-0 bg-black/10 backdrop-blur-xs`) |
| `drawer/content.blade.php` | El panel deslizante — recibe `direction` y aplica las clases correctas |
| `drawer/handle.blade.php` | Barra de arrastre visual (solo visible en `direction=bottom`) |
| `drawer/header.blade.php` | Zona de título (`p-4`, centrado en bottom/top, left en md+) |
| `drawer/footer.blade.php` | Zona de acciones (`mt-auto flex flex-col gap-2 p-4`) |
| `drawer/title.blade.php` | Título accesible (`font-heading text-base font-medium`) |
| `drawer/description.blade.php` | Descripción accesible (`text-sm text-muted-foreground`) |

---

#### Props de la raíz (`<x-ui.drawer>`)

Mapeadas directamente desde la API de Vaul:

| Prop | Tipo | Default | Descripción |
|---|---|---|---|
| `direction` | `bottom\|top\|left\|right` | `bottom` | Dirección desde la que emerge el panel |
| `open` | boolean | `false` | Estado inicial (controlado desde PHP) |
| `dismissible` | boolean | `true` | Si `false`, solo puede cerrarse con el botón Close — sin click en overlay ni Escape |
| `modal` | boolean | `true` | Si `false`, el fondo es interactivo mientras el drawer está abierto (no bloquea el scroll) |

**Props avanzadas (v2 — no en primera implementación):**

| Prop | Tipo | Descripción |
|---|---|---|
| `snap-points` | array JSON | Posiciones de snap como porcentaje o px (ej: `[0.4, 1]`) |
| `active-snap-point` | string | Snap point activo controlado desde PHP |
| `fade-from-index` | number | Índice del snap point a partir del cual aparece el overlay |
| `snap-to-sequential-point` | boolean | Desactiva saltar puntos por velocidad de drag |

---

#### Comportamiento por dirección — clases CSS

El componente original usa el data attribute `data-vaul-drawer-direction` que Vaul inyecta automáticamente. En Alpine, se emula con `:data-direction="direction"` y las variantes en Tailwind.

| Direction | Clases del panel |
|---|---|
| `bottom` | `inset-x-0 bottom-0 mt-24 max-h-[80vh] rounded-t-xl border-t` |
| `top` | `inset-x-0 top-0 mb-24 max-h-[80vh] rounded-b-xl border-b` |
| `left` | `inset-y-0 left-0 w-3/4 sm:max-w-sm rounded-r-xl border-r` |
| `right` | `inset-y-0 right-0 w-3/4 sm:max-w-sm rounded-l-xl border-l` |

**Handle visual:** `mx-auto mt-4 h-1 w-[100px] shrink-0 rounded-full bg-muted` — solo visible cuando `direction=bottom`.

**Header:** texto centrado en `bottom` y `top`, alineado a la izquierda en `left` y `right` (y en `md:` en todos).

---

#### Alpine.js

```js
// Raíz: x-data con direction, dismissible y modal
x-data="{
  open: {{ $open ? 'true' : 'false' }},
  direction: '{{ $direction }}',
  dismissible: {{ $dismissible ? 'true' : 'false' }},
  modal: {{ $modal ? 'true' : 'false' }},
}"
// Evita scroll del body cuando modal=true
x-effect="modal && open ? document.body.style.overflow = 'hidden' : document.body.style.overflow = ''"

// Overlay: solo si modal=true
x-show="open"
@click="dismissible && (open = false)"

// Content: focus trap + Escape
x-show="open"
x-trap.inert.noscroll="open"
@keydown.escape.window="dismissible && (open = false)"
```

**Animaciones `x-transition` por dirección:**

```js
// bottom
:x-transition:enter-start="translate-y-full"
:x-transition:enter-end="translate-y-0"
:x-transition:leave-start="translate-y-0"
:x-transition:leave-end="translate-y-full"

// top → translate-y negativo
// left → -translate-x-full
// right → translate-x-full
```

---

#### Diferencias con Vaul (limitaciones en Blade v1)

| Feature Vaul | En Blade Alpine |
|---|---|
| Drag-to-dismiss con gestos touch | ❌ No — solo botón Close y click overlay |
| Snap points | ❌ No en v1 — requiere lógica de drag compleja |
| `repositionInputs` (scroll al foco en mobile) | ✅ Nativo del browser |
| `onAnimationEnd` callback | Via `@transitionend.window` si se necesita |
| Portal al `body` | ✅ Emulado con `fixed` + z-index alto |

---

## Fase C — Sistemas de menú (Alpine.js complejo)

Componentes con posicionamiento dinámico, submenús, keyboard navigation. Son los más complejos de replicar sin Radix/Base UI.

**Estrategia Alpine para menús:**
- Posicionamiento: CSS `absolute` relativo al trigger, no portal real. Para casos edge usar `@floating-ui/dom` vía CDN si el proyecto lo justifica.
- Keyboard nav: `@keydown.arrow-down`, `@keydown.arrow-up`, `@keydown.enter`, `@keydown.escape`
- Submenús: `x-data` anidado en el sub-trigger

---

### C1 — `dropdown-menu`

**Complejidad:** ⭐⭐⭐⭐ Alta — posicionamiento, submenús, keyboard nav

**Sub-componentes:**
- `<x-ui.dropdown-menu>` — raíz
- `dropdown-menu/trigger.blade.php`
- `dropdown-menu/content.blade.php` — el panel flotante
- `dropdown-menu/group.blade.php`
- `dropdown-menu/label.blade.php` — cabecera de grupo (`inset` prop)
- `dropdown-menu/item.blade.php` — ítem estándar (`variant: default|destructive`, `inset`, `disabled`)
- `dropdown-menu/checkbox-item.blade.php` — ítem con checkbox
- `dropdown-menu/radio-group.blade.php`
- `dropdown-menu/radio-item.blade.php`
- `dropdown-menu/separator.blade.php`
- `dropdown-menu/shortcut.blade.php` — texto de atajo de teclado (ml-auto)
- `dropdown-menu/sub.blade.php` — sub-menú raíz
- `dropdown-menu/sub-trigger.blade.php` — trigger de sub-menú (ChevronRight)
- `dropdown-menu/sub-content.blade.php` — panel del sub-menú

**Props de content:**
- `side`: `bottom` (default) | `top` | `left` | `right`
- `align`: `start` (default) | `center` | `end`
- `side-offset`: `4`
- `align-offset`: `0`

**Ancho:** `w-(--anchor-width) min-w-32` — el panel es al menos tan ancho como el trigger.

**Alpine.js:**
```js
// Raíz
x-data="{ open: false }"
// Content: posición relativa al trigger
// Submenú: x-data anidado con open propio
// Keyboard: arrow navigation entre items
```

---

### C2 — `context-menu`

**Complejidad:** ⭐⭐⭐⭐ Alta — mismo que dropdown pero activado por click derecho

**Sub-componentes:** idénticos a `dropdown-menu` (misma API, prefijo `context-menu-`)

**Diferencia clave:** activado con `@contextmenu.prevent` en el trigger. La posición del panel sigue a las coordenadas del click.

**Alpine.js:**
```js
x-data="{ open: false, x: 0, y: 0 }"
@contextmenu.prevent="open = true; x = $event.clientX; y = $event.clientY"
// Content: position: fixed, :style="`left: ${x}px; top: ${y}px`"
```

**Nota:** los `side` y `align` estáticos no aplican — el panel se posiciona en las coordenadas del cursor.

---

### C3 — `menubar`

**Complejidad:** ⭐⭐⭐⭐ Alta — barra horizontal, un menú abierto a la vez, keyboard nav entre menús

**Sub-componentes:**
- `<x-ui.menubar>` — barra horizontal (`h-8 flex items-center gap-0.5 rounded-lg border p-[3px]`)
- `menubar/menu.blade.php` — un ítem de la barra (wrapper de dropdown)
- `menubar/trigger.blade.php` — trigger del menú (`px-1.5 py-[2px] text-sm rounded-sm`)
- `menubar/content.blade.php` — panel del menú
- `menubar/item.blade.php` — ítem (`variant: default|destructive`, `inset`)
- `menubar/checkbox-item.blade.php`
- `menubar/radio-group.blade.php`
- `menubar/radio-item.blade.php`
- `menubar/label.blade.php`
- `menubar/separator.blade.php`
- `menubar/shortcut.blade.php`
- `menubar/sub.blade.php`
- `menubar/sub-trigger.blade.php`
- `menubar/sub-content.blade.php`

**Comportamiento especial:** al abrir un menú y mover el cursor a otro trigger, este se abre automáticamente (hover navigation). Alpine con `$store` o `x-data` en el `menubar` raíz con el índice del menú activo.

**Alpine.js:**
```js
// Menubar raíz
x-data="{ active: null }"
// Trigger: @mouseenter="active !== null && (active = index)"
//          @click="active = active === index ? null : index"
// Content: x-show="active === index"
```

---

### C4 — `navigation-menu`

**Complejidad:** ⭐⭐⭐⭐⭐ Muy alta — animación de viewport compartido entre items, transiciones complejas

**Sub-componentes:**
- `<x-ui.navigation-menu>` — raíz (`align: start|center|end`)
- `navigation-menu/list.blade.php` — lista de items
- `navigation-menu/item.blade.php` — ítem individual
- `navigation-menu/trigger.blade.php` — trigger con ChevronDown animado
- `navigation-menu/content.blade.php` — contenido del panel (va al viewport)
- `navigation-menu/link.blade.php` — link simple (sin popup)
- `navigation-menu/indicator.blade.php` — flecha decorativa (opcional)

**Animación:** el viewport es compartido entre todos los items. Al cambiar de un trigger a otro, el contenido se anima horizontalmente (slide-in-from-left o right según la dirección del cambio). Esta animación es la parte más compleja.

**Alpine.js:**
```js
// Raíz: rastrea el item activo y la dirección del cambio
x-data="{
  active: null,
  previous: null,
  direction: 'right',
  setActive(value) {
    this.direction = (this.items.indexOf(value) > this.items.indexOf(this.active)) ? 'right' : 'left';
    this.previous = this.active;
    this.active = value;
  }
}"
```

**Alternativa simplificada:** implementar versión sin animación de viewport compartido para una primera iteración — cada item tiene su propio dropdown (como `menubar`), sin el efecto de transición de shadcn.

---

## Fase D — Inputs complejos

### D1 — `input-group`

**Complejidad:** ⭐⭐ Baja — CSS + composición, sin JS

**Sub-componentes:**
- `<x-ui.input-group>` — wrapper (`h-8 flex items-center rounded-lg border border-input`)
- `input-group/addon.blade.php` — addon con alineación (`align: inline-start|inline-end|block-start|block-end`)
- `input-group/button.blade.php` — botón dentro del input (`size: xs|icon-xs|icon-sm`, `variant`)
- `input-group/text.blade.php` — texto/ícono estático (span)
- `input-group/input.blade.php` — input interno (sin bordes, sin ring propio)
- `input-group/textarea.blade.php` — textarea interno (sin bordes, sin ring propio)

**Props de addon:**
- `align`: `inline-start` (left icon) | `inline-end` (right icon/button) | `block-start` (label flotante arriba) | `block-end` (helper text integrado abajo)

**CSS especial:** el grupo entero recibe el ring de foco cuando el input interno tiene focus (`has-[[data-slot=input-group-control]:focus-visible]:ring-3`). Aplica el estado `aria-invalid` del input interno.

---

### D2 — `input-otp`

**Complejidad:** ⭐⭐⭐ Media — input segmentado, JS para manejo de slots

**Sub-componentes:**
- `<x-ui.input-otp>` — wrapper del input nativo oculto
- `input-otp/group.blade.php` — grupo de slots
- `input-otp/slot.blade.php` — slot individual (carácter + cursor parpadeante)
- `input-otp/separator.blade.php` — separador visual (guión) entre grupos

**Props:**
- `maxlength` (requerido) — longitud total del OTP
- `pattern` (regexp) — validación de caracteres
- `disabled`

**Implementación Alpine:** un `<input type="text">` oculto + slots visuales que muestran los caracteres. Alpine sincroniza el valor del input con los slots.

```js
x-data="{
  value: '',
  slots: Array(maxlength).fill(''),
  update(val) {
    this.value = val.slice(0, maxlength);
    this.slots = this.value.split('').concat(Array(maxlength - this.value.length).fill(''));
  }
}"
```

**Estados:** `aria-invalid` propaga `border-destructive` y `ring-destructive/20` al grupo.

---

### D3 — `combobox`

**Complejidad:** ⭐⭐⭐ Media — compuesto: Command + Popover

**No es un componente shadcn independiente** — se construye combinando `<x-ui.popover>` + `<x-ui.command>`.

**Sub-componentes necesarios:** los de `popover` (ya implementado) + los de `command` (Fase D5)

**Props clave:**
- `options` (array de `{value, label}`)
- `value` (valor seleccionado)
- `placeholder`
- `search-placeholder`
- `empty-text`

**Alpine.js:**
```js
x-data="{
  open: false,
  value: '',
  search: '',
  get filtered() {
    return options.filter(o => o.label.toLowerCase().includes(this.search.toLowerCase()))
  }
}"
```

---

### D4 — `date-picker`

**Complejidad:** ⭐⭐⭐ Media — compuesto: Calendar + Popover

**No es un componente shadcn independiente** — se construye combinando `<x-ui.popover>` + `<x-ui.calendar>`.

**Sub-componentes necesarios:** `popover` (ya implementado) + `calendar` (Fase E1)

**Props clave:**
- `value` (fecha ISO o null)
- `format` (string de formato para mostrar)
- `placeholder` (texto cuando no hay fecha)
- `min-date`, `max-date`
- `disabled-dates` (array)

**Alpine.js:** el trigger muestra la fecha formateada. El calendario se renderiza dentro del popover. Al seleccionar una fecha, cierra el popover y actualiza el input oculto.

---

### D5 — `command`

**Complejidad:** ⭐⭐⭐⭐ Alta — búsqueda en tiempo real, keyboard navigation, grupos

**Sub-componentes:**
- `<x-ui.command>` — contenedor principal (`flex flex-col overflow-hidden rounded-xl bg-popover`)
- `command/dialog.blade.php` — versión en modal (cmd+K palette)
- `command/input.blade.php` — input de búsqueda con ícono Search
- `command/list.blade.php` — lista de resultados (max-h-72 overflow-y-auto)
- `command/empty.blade.php` — estado vacío (`py-6 text-center text-sm`)
- `command/group.blade.php` — grupo de items con heading opcional
- `command/item.blade.php` — ítem de resultado (`data-selected` = bg-muted, CheckIcon automático)
- `command/separator.blade.php` — separador horizontal
- `command/shortcut.blade.php` — texto de atajo (ml-auto, monospace)

**Alpine.js:**
```js
x-data="{
  search: '',
  selectedIndex: 0,
  get visibleItems() { /* filtra por search */ }
}"
@keydown.arrow-down.prevent="selectedIndex = Math.min(selectedIndex + 1, visibleItems.length - 1)"
@keydown.arrow-up.prevent="selectedIndex = Math.max(selectedIndex - 1, 0)"
@keydown.enter.prevent="selectItem(visibleItems[selectedIndex])"
```

**Nota:** el filtrado se hace en Alpine (no server-side) para la versión base. Para datasets grandes, añadir prop `remote-search` que dispara un evento Livewire/axios.

---

## Fase E — Data display complejo

### E1 — `calendar`

**Complejidad:** ⭐⭐⭐⭐ Alta — lógica de fechas, múltiples modos de selección

**Sub-componentes:**
- `<x-ui.calendar>` — raíz
- `calendar/day-button.blade.php` — botón de día individual

**Props:**
- `mode`: `single` | `multiple` | `range`
- `value` (fecha ISO string o null)
- `caption-layout`: `label` | `dropdown` (selects de mes/año)
- `show-outside-days`: boolean (default: true)
- `button-variant`: variante de los botones de nav (`ghost` default)
- `min-date`, `max-date`
- `disabled-dates` (array de fechas ISO)
- `locale`: código de locale (default: navigator.language)

**Modos:**
- `single`: un `data-selected-single` por día
- `range`: `data-range-start`, `data-range-middle`, `data-range-end`
- `multiple`: múltiples días con `data-selected`

**CSS especial:** días en rango usan `bg-muted` con pseudo-elementos `after:` para el relleno visual del rango. Ver clases `.range_start`, `.range_middle`, `.range_end` del fuente.

**Alpine.js:** gestión de mes activo, navegación prev/next, selección de días con lógica de rango.

**Dependencia:** usa tokens CSS `--cell-size` (--spacing(7) = 28px) y `--cell-radius` (var(--radius-md)).

---

### E2 — `carousel`

**Complejidad:** ⭐⭐⭐⭐ Alta — scroll snap, touch events, keyboard nav

**Sub-componentes:**
- `<x-ui.carousel>` — raíz con contexto
- `carousel/content.blade.php` — overflow-hidden + flex container
- `carousel/item.blade.php` — slide individual (basis-full shrink-0)
- `carousel/previous.blade.php` — botón prev (absolute, left o top)
- `carousel/next.blade.php` — botón next (absolute, right o bottom)

**Props de raíz:**
- `orientation`: `horizontal` (default) | `vertical`
- Los botones prev/next tienen: `variant: outline` (default), `size: icon-sm`

**Alpine.js:** scroll snap via CSS + Alpine para gestionar el estado de navegación:
```js
x-data="{
  index: 0,
  total: 0,
  canPrev: false,
  canNext: true,
  scrollTo(i) { /* scroll al slide i */ },
  prev() { this.scrollTo(this.index - 1) },
  next() { this.scrollTo(this.index + 1) }
}"
// Botones deshabilitados según canPrev/canNext
// Keyboard: arrow keys
```

**CSS:** `scroll-snap-type: x mandatory` en el viewport, `scroll-snap-align: start` en cada item.

---

### E3 — `chart`

**Complejidad:** ⭐⭐⭐ Media — wrapper de Chart.js

**Sub-componentes:**
- `<x-ui.chart>` — contenedor (`aspect-video` + inyecta CSS variables de colores)
- `chart/tooltip.blade.php` — tooltip customizado (opcional, Chart.js tiene el propio)
- `chart/legend.blade.php` — leyenda customizada

**Props:**
- `config` (JSON o PHP array) — mapeo de series a colores/labels:
  ```php
  // PHP
  $config = [
    'desktop' => ['label' => 'Desktop', 'color' => 'var(--chart-1)'],
    'mobile'  => ['label' => 'Mobile',  'color' => 'var(--chart-2)'],
  ]
  ```
- `type`: `bar` | `line` | `area` | `pie` | `donut` | `radar`
- `data` (JSON)
- `height` (default: aspect-video)

**Implementación:** Blade renderiza el `<canvas>` + Alpine inicializa Chart.js con la configuración. Los colores vienen de los tokens CSS `--chart-1` a `--chart-5`.

**Diferencia con shadcn:** la versión React usa Recharts. En Blade usamos **Chart.js** (más liviano, sin React). La API de `config` se mantiene igual para consistencia.

---

### E4 — `resizable`

**Complejidad:** ⭐⭐⭐ Media — drag handles, tamaños en porcentaje

**Sub-componentes:**
- `<x-ui.resizable.panel-group>` — flex container (`aria-orientation: horizontal|vertical`)
- `resizable/panel.blade.php` — panel individual (flex-grow dinámico)
- `resizable/handle.blade.php` — separador draggable (`withHandle` prop para barra visual)

**Props de panel-group:**
- `direction`: `horizontal` | `vertical`

**Props de handle:**
- `with-handle`: boolean — muestra la barra gris central

**Alpine.js:** mouse drag para redimensionar paneles:
```js
x-data="{
  dragging: false,
  startX: 0,
  startSizes: [],
  onMousedown(e, index) {
    this.dragging = true;
    this.startX = e.clientX;
    this.startSizes = this.getPanelSizes();
  }
}"
@mousemove.window="dragging && resize($event)"
@mouseup.window="dragging = false"
```

**Nota:** los tamaños se almacenan como porcentajes en CSS variables. Para una implementación inicial, limitar a 2 paneles horizontales.

---

## Fase F — Layout y sistema

### F1 — `sidebar`

**Complejidad:** ⭐⭐⭐⭐⭐ Muy alta — el componente más complejo del sistema

**Sub-componentes (20+):**

| Componente | Descripción |
|---|---|
| `<x-ui.sidebar.provider>` | Contexto global: estado open/collapsed, mobile detection |
| `<x-ui.sidebar>` | Panel principal (`side: left\|right`, `variant: sidebar\|floating\|inset`, `collapsible: offcanvas\|icon\|none`) |
| `sidebar/trigger.blade.php` | Botón toggle (PanelLeft icon), shortcut `⌘B` |
| `sidebar/rail.blade.php` | Borde interactivo para colapsar con hover |
| `sidebar/inset.blade.php` | Área de contenido principal (`<main>`, flex-1) |
| `sidebar/input.blade.php` | Input de búsqueda dentro del sidebar |
| `sidebar/header.blade.php` | Zona superior del sidebar |
| `sidebar/footer.blade.php` | Zona inferior del sidebar |
| `sidebar/separator.blade.php` | Separador horizontal |
| `sidebar/content.blade.php` | Zona scrolleable central |
| `sidebar/group.blade.php` | Sección con label |
| `sidebar/group-label.blade.php` | Título de sección |
| `sidebar/group-action.blade.php` | Acción en el label de grupo |
| `sidebar/group-content.blade.php` | Contenido de la sección |
| `sidebar/menu.blade.php` | `<ul>` de items de navegación |
| `sidebar/menu-item.blade.php` | `<li>` contenedor |
| `sidebar/menu-button.blade.php` | Botón de nav (`variant: default\|outline`, `size: default\|sm`) |
| `sidebar/menu-action.blade.php` | Acción secundaria en un item (ej: "..." dots) |
| `sidebar/menu-badge.blade.php` | Badge de contador en un item |
| `sidebar/menu-skeleton.blade.php` | Skeleton de carga del menú |
| `sidebar/menu-sub.blade.php` | Sub-menú anidado (`<ul>`) |
| `sidebar/menu-sub-item.blade.php` | Item del sub-menú |
| `sidebar/menu-sub-button.blade.php` | Botón del sub-menú (size-sm) |

**Variantes de Sidebar:**
- `variant=sidebar`: sidebar estándar con borde
- `variant=floating`: sidebar flotante con sombra (rounded, separado)
- `variant=inset`: el contenido principal tiene indentación (sidebar "inside")

**Modos de colapso:**
- `collapsible=offcanvas`: desaparece del layout (mobile default)
- `collapsible=icon`: se reduce a solo íconos (64px) — tooltips en cada item
- `collapsible=none`: siempre visible, no colapsable

**Mobile:** en `< 768px`, el sidebar se muestra como `Sheet` (panel lateral deslizante). El Trigger activa el Sheet.

**CSS variables:** `--sidebar-width: 16rem`, `--sidebar-width-icon: 3rem`, `--sidebar-width-mobile: 18rem`

**Cookie:** persiste el estado `expanded/collapsed` en `sidebar_state` cookie (7 días).

**Alpine.js:**
```js
// Provider global
x-data="{
  open: getCookie('sidebar_state') !== 'false',
  isMobile: window.innerWidth < 768,
  toggle() {
    this.open = !this.open;
    setCookie('sidebar_state', this.open, 7);
  }
}"
// Keyboard shortcut
@keydown.meta.b.window="toggle()"
// Mobile: usa x-ui.sheet
```

---

### F2 — `sonner`

**Complejidad:** ⭐⭐⭐ Media — reemplazar/complementar el toaster existente

**Sub-componentes:** `<x-ui.sonner>` (alias o reemplaza `<x-ui.toaster>`)

**Diferencias con el Toast actual:**
- Stack de toasts en vez de lista
- Tipos con íconos automáticos: `success` (CircleCheck), `info` (Info), `warning` (TriangleAlert), `error` (OctagonX), `loading` (Loader2 animate-spin)
- Soporte para promise toasts (loading → success/error)
- Swipe para cerrar

**CSS tokens usados:**
```css
--normal-bg: var(--popover)
--normal-text: var(--popover-foreground)
--normal-border: var(--border)
--border-radius: var(--radius)
```

**Implementación Alpine:** un `$store.toasts` global con array de toasts. `window.toast()` como función global para llamarlo desde cualquier lado.

```js
// En app.js
Alpine.store('toasts', {
  items: [],
  add(message, options = {}) {
    const id = Date.now();
    this.items.push({ id, message, type: 'default', ...options });
    if (options.duration !== Infinity) {
      setTimeout(() => this.remove(id), options.duration ?? 4000);
    }
    return id;
  },
  remove(id) { this.items = this.items.filter(t => t.id !== id); }
});
window.toast = (msg, opts) => Alpine.store('toasts').add(msg, opts);
```

---

## Matriz de prioridad e implementación

| # | Componente | Fase | Complejidad | Dependencias | Prioridad |
|---|---|---|---|---|---|
| 0 | `icon` | 0 | ⭐⭐ impl + ⭐⭐⭐ migración | config/icons.php | **Crítica — prerequisito** |
| 1 | `kbd` | A6 | ⭐ | ninguna | Alta |
| 2 | `empty-state` | A9 | ⭐ | ninguna | Alta |
| 3 | `aspect-ratio` | A1 | ⭐ | ninguna | Media |
| 4 | `native-select` | A7 | ⭐ | ninguna | Alta |
| 5 | `typography` | A8 | ⭐ | ninguna | Media |
| 6 | `button-group` | A10 | ⭐ | button | Alta |
| 7 | `item` | A11 | ⭐ | ninguna | Baja |
| 8 | `scroll-area` | A2 | ⭐ | ninguna | Media |
| 9 | `toggle` | A3 | ⭐⭐ | ninguna | Alta |
| 10 | `toggle-group` | A4 | ⭐⭐ | toggle | Alta |
| 11 | `collapsible` | A5 | ⭐⭐ | Alpine collapse plugin | Alta |
| 12 | `hover-card` | B2 | ⭐⭐ | ninguna | Baja |
| 13 | `input-group` | D1 | ⭐⭐ | input, button | Alta |
| 14 | `alert-dialog` | B1 | ⭐⭐⭐ | button | Alta |
| 15 | `drawer` | B3 | ⭐⭐⭐ | ninguna | Alta |
| 16 | `input-otp` | D2 | ⭐⭐⭐ | ninguna | Media |
| 17 | `resizable` | E4 | ⭐⭐⭐ | ninguna | Baja |
| 18 | `carousel` | E2 | ⭐⭐⭐⭐ | button | Media |
| 19 | `chart` | E3 | ⭐⭐⭐ | Chart.js CDN | Media |
| 20 | `sonner` | F2 | ⭐⭐⭐ | Alpine store | Alta |
| 21 | `command` | D5 | ⭐⭐⭐⭐ | input-group | Alta |
| 22 | `dropdown-menu` | C1 | ⭐⭐⭐⭐ | ninguna | Alta |
| 23 | `context-menu` | C2 | ⭐⭐⭐⭐ | dropdown-menu | Media |
| 24 | `combobox` | D3 | ⭐⭐⭐ | popover + command | Alta |
| 25 | `calendar` | E1 | ⭐⭐⭐⭐ | button | Alta |
| 26 | `date-picker` | D4 | ⭐⭐⭐ | calendar + popover | Alta |
| 27 | `menubar` | C3 | ⭐⭐⭐⭐ | dropdown-menu | Media |
| 28 | `navigation-menu` | C4 | ⭐⭐⭐⭐⭐ | ninguna | Media |
| 29 | `sidebar` | F1 | ⭐⭐⭐⭐⭐ | button, input, separator, skeleton, tooltip, sheet | Alta |

---

## Orden de implementación recomendado

### Sprint 0 — Sistema de íconos (prerequisito absoluto)
1. Crear `<x-ui.icon>` + `config/icons.php` con el set mínimo (30 íconos)
2. Migrar todos los SVGs inline de los componentes existentes
3. Verificar visualmente cada componente migrado

### Sprint 1 — Sin JS, valor inmediato
`kbd` → `empty-state` → `native-select` → `button-group` → `aspect-ratio` → `scroll-area` → `typography`

### Sprint 2 — Alpine trivial + collapsible
`toggle` → `toggle-group` → `collapsible` (requiere @alpinejs/collapse)

### Sprint 3 — Overlays esenciales
`alert-dialog` → `drawer` → `hover-card` → `sonner`

### Sprint 4 — Inputs avanzados
`input-group` → `input-otp` → `command` → `combobox` → `calendar` → `date-picker`

### Sprint 5 — Menús
`dropdown-menu` → `context-menu` → `menubar` → `navigation-menu`

### Sprint 6 — Data display
`carousel` → `chart` → `resizable`

### Sprint 7 — Sidebar (sprint propio por complejidad)
`sidebar` (todos los sub-componentes en una sola sesión)

---

## Dependencias externas nuevas

| Librería | Componentes que la usan | CDN disponible |
|---|---|---|
| `@alpinejs/collapse` | collapsible, accordion | ✅ |
| `Chart.js` | chart | ✅ |
| `@floating-ui/dom` (opcional) | dropdown-menu, context-menu | ✅ |

Los componentes de menú pueden funcionar sin `@floating-ui/dom` usando posicionamiento CSS `absolute` simple. Para casos edge (overflow del viewport), `@floating-ui/dom` resuelve el flip automático.

---

## Showcase pages pendientes

Para cada componente implementado, crear el archivo Blade en `resources/views/showcase/components/`:

```
icon.blade.php
toggle.blade.php
toggle-group.blade.php
collapsible.blade.php
aspect-ratio.blade.php
scroll-area.blade.php
kbd.blade.php
native-select.blade.php
typography.blade.php
empty-state.blade.php
button-group.blade.php
item.blade.php
alert-dialog.blade.php
hover-card.blade.php
drawer.blade.php
input-group.blade.php
input-otp.blade.php
command.blade.php
combobox.blade.php
calendar.blade.php
date-picker.blade.php
dropdown-menu.blade.php
context-menu.blade.php
menubar.blade.php
navigation-menu.blade.php
carousel.blade.php
chart.blade.php
resizable.blade.php
sonner.blade.php
sidebar.blade.php
```
