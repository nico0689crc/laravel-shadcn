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

### 5. Tipografía responsive

```html
<!-- Display -->
<h1 class="text-4xl sm:text-5xl lg:text-[60px] font-bold leading-[1.1]">

<!-- H1 de página -->
<h1 class="text-2xl sm:text-3xl lg:text-4xl font-semibold leading-[1.15]">

<!-- H2 de sección -->
<h2 class="text-xl sm:text-2xl font-semibold leading-[1.2]">

<!-- H3 de sub-sección -->
<h3 class="text-lg sm:text-xl font-medium leading-[1.25]">

<!-- Body con legibilidad -->
<p class="text-sm sm:text-base leading-relaxed max-w-prose">

<!-- Caption / helper text -->
<p class="text-xs text-muted-foreground leading-normal">
```

**Regla:** texto de párrafo siempre con `max-w-prose` (≈65ch). Sin esta restricción el texto se vuelve ilegible en pantallas anchas.

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

### 10. Composición de pantallas — checklist

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
