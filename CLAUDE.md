# CLAUDE.md — Design System shadcn → Laravel Blade

Este archivo se carga automáticamente en cada sesión. Contiene las reglas de diseño que el agente debe aplicar siempre al generar o revisar interfaces, componentes Blade o tokens CSS.

---

## Contexto del proyecto

Dos proyectos complementarios:

- **`shadcn-inspector/`** — React + shadcn/ui. Inspector visual. Dev server: `cd shadcn-inspector && pnpm dev`
- **`laravel-app/`** — Laravel 12 + Tailwind v4 + Alpine.js + Blade. Destino final del design system.

Referencia completa del sistema: [`roadmap.md`](./roadmap.md)

---

## Reglas de diseño — APLICAR SIEMPRE

### 1. Grilla de 4px (regla más importante)

Todo valor de espaciado es múltiplo de 4px. Nunca usar valores arbitrarios.

```
✅  gap-2 (8px)  p-4 (16px)  mt-6 (24px)  mb-8 (32px)
❌  gap-[7px]    p-[11px]    mt-[13px]
```

Los valores más usados y su equivalente en Tailwind:

| px | Tailwind | Uso típico |
|---|---|---|
| 4px | `gap-1` / `p-1` | Micro: ícono + texto |
| 8px | `gap-2` / `p-2` | Dentro de un componente |
| 12px | `gap-3` / `p-3` | Padding sm |
| 16px | `gap-4` / `p-4` | Separar componentes relacionados |
| 24px | `gap-6` / `p-6` | Entre secciones relacionadas |
| 32px | `gap-8` / `p-8` | Entre secciones de página |
| 48px | `gap-12` / `p-12` | Entre bloques principales |
| 64px | `gap-16` / `p-16` | Grandes separaciones de página |

---

### 2. Jerarquía de espaciado (proximidad)

Lo relacionado está más cerca. Usar siempre en este orden:

```
Micro (4–8px)     → ícono+texto, label+input, input+helper
Inset (8–20px)    → padding interno de componentes
Stack (8–16px)    → entre campos/elementos del mismo grupo
Section (24–40px) → entre secciones relacionadas
Block (48–96px)   → entre bloques principales de página
```

---

### 3. Sistema de tamaños — escala fija sm / md / lg

Todos los componentes interactivos comparten esta escala. **No mezclar sizes distintos en el mismo formulario o grupo de acciones.**

| Propiedad | `sm` | `md` | `lg` |
|---|---|---|---|
| Altura | 32px (`h-8`) | 40px (`h-10`) | 48px (`h-12`) |
| Padding X | 12px (`px-3`) | 16px (`px-4`) | 20px (`px-5`) |
| Padding Y | 6px (`py-1.5`) | 8px (`py-2`) | 10px (`py-2.5`) |
| Font size | 13px (`text-[13px]`) | 14px (`text-sm`) | 16px (`text-base`) |
| Ícono | 14px (`size-3.5`) | 16px (`size-4`) | 18px (`size-[18px]`) |
| Gap interno | 6px (`gap-1.5`) | 8px (`gap-2`) | 10px (`gap-2.5`) |

El `md` es el tamaño por defecto si no se especifica.

---

### 4. Responsive — reglas obligatorias

#### Padding de página por viewport

```html
<!-- Siempre usar este patrón para contenedores de página -->
<div class="px-4 sm:px-6 lg:px-8 xl:px-10">
```

#### Max-width de contenedores

```html
<!-- Formularios y contenido centrado -->
<div class="max-w-lg mx-auto">

<!-- Página estándar con sidebar -->
<div class="max-w-5xl mx-auto">

<!-- Layout full -->
<div class="max-w-7xl mx-auto">
```

#### Patrones por tipo de pantalla

```html
<!-- Formulario: 1 col en mobile, 2 col en desktop -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">

<!-- Cards: escala de 1 a 4 columnas -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">

<!-- Stack → Row en mobile/desktop -->
<div class="flex flex-col sm:flex-row gap-3">

<!-- Acciones de formulario: full-width mobile, auto desktop -->
<div class="flex flex-col sm:flex-row-reverse gap-2">
  <button class="w-full sm:w-auto">Guardar</button>
  <button class="w-full sm:w-auto">Cancelar</button>
</div>
```

---

### 5. Tipografía — usar `<x-ui.typography>` siempre

Nunca usar tags HTML crudos (`<h1>`, `<p>`, `<code>`, etc.) para texto. Siempre usar el componente:

```html
<x-ui.typography as="variante">Texto</x-ui.typography>
```

#### Tabla de variantes

| `as=` | Tag | Cuándo usar |
|---|---|---|
| `h1` | `<h1>` | Título único de página |
| `h2` | `<h2>` | Título de sección principal |
| `h3` | `<h3>` | Sub-sección dentro de una sección |
| `h4` | `<h4>` | Nivel más bajo de jerarquía de títulos |
| `lead` | `<p>` | Subtítulo o introducción prominente de sección |
| `large` | `<div>` | Énfasis visual sin jerarquía semántica |
| `p` | `<p>` | Cuerpo de texto con color `foreground` normal |
| `muted` | `<p>` | Descripción, helper text, información secundaria |
| `small` | `<small>` | Label compacto, metadata (`font-medium`) |
| `code` | `<code>` | Código inline, nombres de props, tokens |
| `section-label` | `<h2>` | Etiqueta de sección: `text-xs uppercase tracking-widest` |
| `blockquote` | `<blockquote>` | Citas, fragmentos destacados |
| `list` | `<ul>` | Listas de items |

#### Reglas de uso

- **`lead` vs `muted`**: `lead` es visible/prominente (subtítulo de hero), `muted` es texto gris secundario
- **`large` vs `h4`**: `h4` si está en jerarquía semántica, `large` si es solo énfasis visual
- **`small` vs `muted`**: `small` tiene `font-medium` (label de dato), `muted` es descriptivo sin peso
- **`p` vs `muted`**: `p` tiene color `foreground` normal, `muted` tiene `text-muted-foreground`
- Todo `p` y `muted` de párrafo llevan `class="max-w-prose"` — sin esto el texto se vuelve ilegible en pantallas anchas
- Para display (hero/marketing), override sobre `h1`: `<x-ui.typography as="h1" class="text-5xl sm:text-[60px]">`
- Para `section-label` con tag semántico distinto: `<x-ui.typography as="section-label" element="p">`

---

### 6. Tokens semánticos — usar siempre en lugar de colores hardcodeados

```html
<!-- ✅ Correcto: usa tokens del sistema -->
<div class="bg-background text-foreground">
<div class="bg-card text-card-foreground border border-border">
<p class="text-muted-foreground">
<div class="bg-primary text-primary-foreground">

<!-- ❌ Incorrecto: valor hardcodeado que ignora el tema -->
<div class="bg-white text-gray-900">
<div class="bg-zinc-100">
<p class="text-gray-500">
```

#### Estados semánticos en componentes

Cada estado tiene 6 tokens. Usar el correcto según el contexto:

| Uso | Token |
|---|---|
| Fondo sólido (botón filled) | `bg-{state}` + `text-{state}-foreground` |
| Fondo suave (alert, highlight) | `bg-{state}-subtle` + `text-{state}-subtle-foreground` |
| Borde de estado (input error) | `border-{state}-border` |
| Texto sobre fondo neutro (helper text) | `text-{state}` |

Donde `{state}` es: `destructive` / `success` / `warning` / `info`

---

### 7. Touch targets en mobile

Todo elemento interactivo: **mínimo 44×44px de área táctil**.

```html
<!-- Si el elemento es visualmente pequeño, agrandar el área táctil -->
<button class="p-3 -m-1"> <!-- padding compensa el margen negativo -->
  <svg class="size-4">...</svg>
</button>

<!-- Checkboxes y radios en mobile: agrandar el hit area -->
<label class="flex items-center gap-3 py-2 cursor-pointer">
  <input type="checkbox" class="size-4">
  <span>Opción</span>
</label>
```

---

### 8. Estados de UI — siempre definir los tres

Toda sección que muestra datos debe tener:

```html
<!-- 1. Estado de carga -->
@if($loading)
  <x-ui.skeleton class="h-32 w-full" />

<!-- 2. Estado vacío -->
@elseif($items->isEmpty())
  <x-ui.empty-state title="Sin resultados" description="..." />

<!-- 3. Estado con datos -->
@else
  {{-- contenido normal --}}
@endif
```

---

### 9. Densidad

Setear `data-density` en el layout raíz según el contexto de la pantalla:

```html
<!-- Dashboards y tablas de datos -->
<div data-density="compact">

<!-- App estándar (default, no necesita el atributo) -->
<div data-density="default">

<!-- Onboarding, marketing, páginas de bienvenida -->
<div data-density="comfortable">
```

---

### 10. Estructura de página estándar

#### Anatomía y espaciado

Toda página tiene tres zonas. El espaciado entre zonas es fijo:

```
┌─────────────────────────────────────────────┐
│  PAGE HEADER      space-y-1 interno         │  ← h1 + muted + acción primaria
│  (h1 / muted / button)                      │
├─────────────────────────────────────────────┤
│                  ↕ space-y-8                │
│  CONTENT                                    │  ← cards, tablas, listas
│  (x-ui.card / x-ui.table / etc.)           │
├─────────────────────────────────────────────┤
│                  ↕ space-y-4 (dentro card)  │
│  ACTIONS (si aplica)                        │  ← al pie de formulario o card
└─────────────────────────────────────────────┘
```

```blade
<x-layouts.app>
    <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8 py-8 space-y-8">

        {{-- PAGE HEADER --}}
        <div class="flex items-start justify-between gap-4">
            <div class="space-y-1">
                <x-ui.typography as="h1">Título de página</x-ui.typography>
                <x-ui.typography as="muted" class="max-w-prose">
                    Descripción breve de la sección.
                </x-ui.typography>
            </div>
            {{-- Acción primaria siempre top-right --}}
            <x-ui.button>Acción principal</x-ui.button>
        </div>

        {{-- CONTENT --}}
        <x-ui.card>

            {{-- Sub-sección dentro de la card --}}
            <x-ui.card.content class="p-6 space-y-6">
                <x-ui.typography as="section-label">Sub-sección</x-ui.typography>
                {{-- contenido --}}
            </x-ui.card.content>

            {{-- ACTIONS al pie de la card --}}
            <x-ui.card.footer class="justify-end gap-2">
                <x-ui.button variant="ghost">Cancelar</x-ui.button>
                <x-ui.button>Guardar</x-ui.button>
            </x-ui.card.footer>

        </x-ui.card>

    </div>
</x-layouts.app>
```

#### Tipografía por zona

| Zona | Componente | Variante |
|---|---|---|
| Título de página | `<x-ui.typography>` | `as="h1"` |
| Descripción de página | `<x-ui.typography>` | `as="muted" class="max-w-prose"` |
| Título de sección/card | `<x-ui.card.title>` o `<x-ui.typography as="h2">` | — |
| Descripción de card | `<x-ui.card.description>` o `as="muted"` | — |
| Etiqueta de sub-sección | `<x-ui.typography>` | `as="section-label"` |
| Texto de cuerpo | `<x-ui.typography>` | `as="p" class="max-w-prose"` |

#### Acciones — tres patrones

**1. Acción de página** (crear, importar): top-right del page header.
```blade
<div class="flex items-start justify-between gap-4">
    <div class="space-y-1">...</div>
    <x-ui.button>Nueva entrada</x-ui.button>
</div>
```

**2. Acciones de card/formulario**: pie de la card, alineadas a la derecha. El botón primario va último (más a la derecha).
```blade
<x-ui.card.footer class="justify-end gap-2">
    <x-ui.button variant="ghost">Cancelar</x-ui.button>
    <x-ui.button>Guardar</x-ui.button>
</x-ui.card.footer>
```

**3. Acciones destructivas**: siempre separadas del grupo principal, con `state="destructive"`.
```blade
<x-ui.card.footer class="justify-between">
    <x-ui.button variant="ghost" state="destructive">Eliminar</x-ui.button>
    <div class="flex gap-2">
        <x-ui.button variant="ghost">Cancelar</x-ui.button>
        <x-ui.button>Guardar</x-ui.button>
    </div>
</x-ui.card.footer>
```

---

### 11. Composición de pantallas — checklist

Antes de dar una pantalla por completa, verificar:

- [ ] H1 único en la página
- [ ] Máximo 3 niveles de anidación visual
- [ ] Acciones al final del flujo (bottom-right desktop / full-width mobile)
- [ ] Texto de párrafo con `max-w-prose`
- [ ] Todos los campos de formulario del mismo `size`
- [ ] Definidos: estado cargando, estado vacío, estado con datos
- [ ] Verificado en mobile (< 640px) y desktop (≥ 1280px)
- [ ] Todos los tokens de color son semánticos (sin hardcoding)
- [ ] Espaciados son múltiplos de 4px

---

## Branding — adaptar el sistema a un producto

Cuando se pida adaptar el design system al branding de un producto, la regla principal es: **solo modificar `design-tokens.css`, nunca los componentes `ui/`**. Los componentes consumen tokens; cambiar los tokens propaga el cambio a toda la interfaz.

### Las cinco palancas (en orden de impacto)

**1. Color de marca**

Tres pasos en `design-tokens.css`:

```css
/* Paso 1 — agregar paleta primitiva (sección 1, con la misma escala de 11 pasos) */
--brand-600: oklch(0.540 0.230 260);   /* color principal de marca */
/* ... resto de la escala --brand-50 a --brand-950 */

/* Paso 2 — redirigir semánticos (sección 2, tema claro) */
--primary:            var(--brand-600);
--primary-foreground: var(--neutral-50);
--ring:               var(--brand-500);

/* Paso 3 — ajustar dark (sección 3, tema oscuro) */
--primary:            var(--brand-400);
--primary-foreground: var(--neutral-950);
```

**2. Tipografía**

En `design-tokens.css` sección 4:
```css
--font-sans: 'Plus Jakarta Sans', ui-sans-serif, system-ui, sans-serif;
```
En `app.css`, antes de los imports:
```css
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');
```

**3. Border radius** — solo una variable, el resto se deduce:

```css
/* sección 2 de design-tokens.css */
--radius: 0.375rem;   /* 0: formal · 0.5rem: equilibrado (default) · 1rem: amigable */
```

**4. Movimiento:**

```css
/* sección 7 de design-tokens.css */
--duration-fast:   75ms;    /* herramienta profesional */
--duration-fast:   150ms;   /* producto consumer/delightful */
```

**5. Densidad** — en el `<body>` o layout raíz:

```html
<body data-density="compact">      <!-- dashboards, data-heavy -->
<body data-density="comfortable">  <!-- consumer, onboarding -->
```

### Arquetipos frecuentes

| Producto | Primary | Fuente | Radius | Densidad |
|---|---|---|---|---|
| Fintech / Banco | Neutral o azul oscuro | Inter | 4–6px | Compact |
| SaaS B2B | Brand color moderado | Plus Jakarta | 8px | Default |
| App consumer | Brand color vivo | DM Sans | 12–16px | Comfortable |
| Dev tool | Neutral o verde | IBM Plex | 4px | Compact |

### Lo que NO modificar al rebrandear

- Los archivos en `components/ui/` — nunca
- Los tokens de estado (`--destructive`, `--success`, `--warning`, `--info`) — tienen significado universal
- La estructura de la paleta primitiva existente (Neutral, Red, Green, etc.) — solo agregar nuevas

---

## Arquitectura de carpetas — vistas y componentes

### Estructura de `resources/views/`

```
resources/views/
│
├── components/
│   ├── ui/                    ← design system puro (no modificar)
│   ├── layouts/               ← layouts de la app (app.blade.php, auth.blade.php)
│   ├── shared/                ← componentes usados en 2+ features
│   │   ├── page-header.blade.php      → x-shared.page-header
│   │   ├── empty-card.blade.php       → x-shared.empty-card
│   │   └── stats/                     ← sub-carpeta cuando hay 3+ del mismo dominio
│   │       ├── metric-card.blade.php  → x-shared.stats.metric-card
│   │       └── trend-badge.blade.php  → x-shared.stats.trend-badge
│   └── [feature]/             ← componentes específicos de una sola feature
│       ├── members/
│       │   └── row.blade.php          → x-members.row
│       └── plans/
│           └── price-card.blade.php   → x-plans.price-card
│
├── [feature]/                 ← páginas (espeja la estructura de URLs)
│   ├── index.blade.php
│   ├── show.blade.php
│   ├── create.blade.php
│   ├── edit.blade.php
│   └── _partial.blade.php     ← fragmento interno (@include, sin @props)
│
├── auth/                      ← login, register, forgot-password
├── errors/                    ← 404, 500, 503
└── emails/                    ← plantillas de mail
```

### Tres niveles de componentes

| Prefijo | Carpeta | Qué va ahí |
|---|---|---|
| `x-ui.*` | `components/ui/` | Primitivos del design system. Sin lógica de negocio. |
| `x-shared.*` | `components/shared/` | Componentes reutilizados en 2+ features. |
| `x-[feature].*` | `components/[feature]/` | Específicos de una sola feature. |

### Regla de ciclo de vida de un componente

1. **Nace** en `components/[feature]/` — específico de una página
2. **Sube** a `components/shared/` — cuando una segunda feature lo necesita
3. **Se agrupa** en `components/shared/[grupo]/` — cuando hay 3+ del mismo dominio

Nunca al revés. Un componente no baja de `shared/` a `[feature]/`.

### Componente vs. partial

- **Componente** (`components/[carpeta]/nombre.blade.php`): necesita `@props`, se reutiliza, se invoca con `<x-*>`.
- **Partial** (`[feature]/_nombre.blade.php`): fragmento de una sola vista, usa variables del contexto, se invoca con `@include`. Prefijo `_` para distinguirlo de páginas.

### Ejemplo concreto — componente de feature

```blade
{{-- components/members/row.blade.php --}}
@props(['member'])

<x-ui.table.row>
    <x-ui.table.cell>{{ $member->name }}</x-ui.table.cell>
    <x-ui.table.cell>
        <x-ui.badge :state="$member->active ? 'success' : 'destructive'" :subtle="true">
            {{ $member->active ? 'Activo' : 'Inactivo' }}
        </x-ui.badge>
    </x-ui.table.cell>
</x-ui.table.row>
```

Usado en la página:

```blade
{{-- members/index.blade.php --}}
@foreach($members as $member)
    <x-members.row :member="$member" />
@endforeach
```

---

## Alpine.js — reglas de uso

### Cuándo usar cada patrón

| Caso | Patrón |
|---|---|
| 1–2 propiedades reactivas, sin métodos | `x-data="{ open: false }"` inline |
| Componente con métodos o 5+ líneas de JS | `Alpine.data('nombre', ...)` en `app.js` |
| Estado compartido entre componentes no relacionados | `Alpine.store('nombre', ...)` en `app.js` |

### Alpine.data() — patrón estándar para componentes complejos

Los componentes Alpine se separan en archivos por feature bajo `resources/js/alpine/`:

```
resources/js/
├── app.js                    ← stores + imports + Alpine.start()
└── alpine/
    ├── members-table.js
    ├── invite-dialog.js
    └── settings-form.js
```

Cada archivo exporta una función que recibe `Alpine` y registra sus componentes:

```js
// alpine/members-table.js
export default (Alpine) => {
    Alpine.data('memberTable', (initialIds) => ({
        search: '',
        visibleIds: initialIds,

        get allSelected() { ... },
        filterRows() { ... },
    }))
}
```

`app.js` solo importa y registra, sin lógica de componentes:

```js
import membersTable from './alpine/members-table'

membersTable(Alpine)

window.Alpine = Alpine
Alpine.start()
```

Usar en el template pasando datos del servidor como argumento:

```html
<div x-data="memberTable(@js($ids))" x-effect="filterRows()">
```

**Ventajas sobre inline:** el template queda legible, el JS tiene syntax highlighting y es testeable, cada feature vive en su propio archivo.

---

## Stack técnico

| Capa | Tecnología |
|---|---|
| Framework | Laravel 12 |
| CSS | Tailwind v4 (CSS-first, sin `tailwind.config.js`) |
| Interactividad | Alpine.js |
| Templating | Blade components (`<x-ui.*>`) |
| Colores | OKLCH + CSS custom properties |
| Temas | `.dark` class en `<html>` |

## Archivos clave

| Archivo | Rol |
|---|---|
| `laravel-app/resources/css/design-tokens.css` | Fuente de verdad de todos los tokens |
| `laravel-app/resources/views/components/ui/` | Componentes Blade |
| `shadcn-inspector/src/registry/` | Metadata y previews de componentes |
| `roadmap.md` | Plan completo del proyecto |
