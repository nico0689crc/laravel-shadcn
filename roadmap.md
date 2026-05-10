# Roadmap: Design System shadcn → Laravel Blade

## Objetivo

Construir un sistema de diseño escalable y altamente customizable basado en shadcn/ui, con dos proyectos complementarios:

- **`shadcn-inspector`** — React + shadcn/ui. Fuente de verdad visual. Permite inspeccionar cada componente, sus variantes y su código Tailwind real.
- **`laravel-app`** — Laravel + Tailwind + Blade. Destino final. Componentes Blade que replican fielmente shadcn/ui, sin dependencia de React.

Un único archivo (`design-tokens.css`) controla toda la apariencia del sistema.

---

## Arquitectura

```
laravel-shadcn/
├── shadcn-inspector/         ← Vite + React + TypeScript + Tailwind v4 + shadcn/ui
│   ├── src/
│   │   ├── components/ui/    ← todos los componentes shadcn instalados
│   │   ├── registry/         ← metadata de componentes (nombre, categoría, descripción)
│   │   └── app/              ← UI del inspector (sidebar + preview + code)
│   ├── components.json
│   └── tailwind.config.ts
│
└── laravel-app/              ← Laravel 12 + Tailwind v4 + Alpine.js + Blade
    ├── resources/
    │   ├── css/
    │   │   ├── app.css                ← punto de entrada
    │   │   └── design-tokens.css      ← archivo único de customización ★
    │   ├── views/
    │   │   ├── components/ui/         ← componentes Blade
    │   │   └── showcase/              ← páginas de demostración
    │   └── js/app.js
    ├── tailwind.config.js             ← mapea CSS variables a clases Tailwind
    └── config/design-system.php      ← acceso server-side a tokens
```

---

## Design Tokens (design-tokens.css)

El archivo `design-tokens.css` es el núcleo del sistema. Cambiar un valor aquí propaga el cambio a todos los componentes, en ambos temas.

### Estructura del archivo

```css
/* ─────────────────────────────────────────
   TEMA CLARO
───────────────────────────────────────── */
:root {
  /* Colores base */
  /* Superficies */
  /* Semánticos */
  /* Estados de feedback (destructive, success, warning, info) */
  /* UI (borde, input, ring) */
  /* Charts */
  /* Sidebar */
  /* Radio */
  /* Tipografía */
  /* Sombras */
  /* Animaciones */
}

/* ─────────────────────────────────────────
   TEMA OSCURO
───────────────────────────────────────── */
.dark {
  /* mismas variables, distintos valores */
}
```

### Tokens completos

| Categoría | Variables |
|---|---|
| **Paleta primitiva** | `--blue-50` … `--blue-950`, `--green-50` … `--green-950`, `--yellow-50` … `--yellow-950`, `--red-50` … `--red-950`, `--neutral-50` … `--neutral-950` (escala raw de 12 pasos por color, base del sistema semántico) |
| **Base** | `--background`, `--foreground` |
| **Superficies** | `--surface-0` (base), `--surface-1` (cards/inputs), `--surface-2` (dropdowns/hover), `--surface-3` (modales/tooltips), `--surface-overlay` (backdrop) |
| **Superficies nombradas** | `--card`, `--card-foreground`, `--popover`, `--popover-foreground` |
| **Semánticos de rol** | `--primary`, `--primary-foreground`, `--secondary`, `--secondary-foreground`, `--muted`, `--muted-foreground`, `--accent`, `--accent-foreground` |
| **Estados de feedback** | Ver tabla de sistema de estados abajo ★ |
| **Texto** | `--text-primary`, `--text-secondary`, `--text-tertiary`, `--text-disabled`, `--text-placeholder`, `--text-inverse`, `--text-success`, `--text-warning`, `--text-destructive`, `--text-info` |
| **UI** | `--border`, `--border-width`, `--input`, `--ring`, `--ring-width`, `--ring-offset`, `--ring-offset-color` |
| **Z-index** | `--z-base`, `--z-dropdown`, `--z-sticky`, `--z-fixed`, `--z-overlay`, `--z-modal`, `--z-popover`, `--z-tooltip`, `--z-toast` |
| **Charts** | `--chart-1` … `--chart-5` |
| **Sidebar** | `--sidebar`, `--sidebar-foreground`, `--sidebar-primary`, `--sidebar-primary-foreground`, `--sidebar-accent`, `--sidebar-accent-foreground`, `--sidebar-border`, `--sidebar-ring` |
| **Radio** | `--radius` (base), derivados `sm / md / lg / xl` |
| **Tipografía — familias** | `--font-sans`, `--font-mono`, `--font-serif` |
| **Tipografía — escala** | `--text-xs` … `--text-5xl` (tamaño + line-height pareados) |
| **Tipografía — pesos** | `--font-thin`, `--font-light`, `--font-normal`, `--font-medium`, `--font-semibold`, `--font-bold`, `--font-extrabold` |
| **Tipografía — tracking** | `--tracking-tighter`, `--tracking-tight`, `--tracking-normal`, `--tracking-wide`, `--tracking-wider`, `--tracking-widest` |
| **Tipografía — roles** | `--text-display`, `--text-heading`, `--text-subheading`, `--text-body`, `--text-label`, `--text-caption`, `--text-code` |
| **Componentes — alturas** | `--height-sm`, `--height-md`, `--height-lg` |
| **Componentes — iconos** | `--icon-size-sm`, `--icon-size-md`, `--icon-size-lg` |
| **Espaciado semántico** | `--spacing-component-gap`, `--spacing-section-gap`, `--spacing-page-padding` |
| **Contenedores** | `--container-sm`, `--container-md`, `--container-lg`, `--container-xl`, `--container-2xl` |
| **Sombras** | `--shadow-sm`, `--shadow-md`, `--shadow-lg`, `--shadow-xl`, `--shadow-2xl` |
| **Animaciones** | `--duration-fast`, `--duration-normal`, `--duration-slow`, `--ease-default`, `--ease-in`, `--ease-out`, `--ease-spring` |
| **Transiciones** | `--transition-colors`, `--transition-opacity`, `--transition-transform`, `--transition-shadow` |

Todos los valores usan formato OKLCH (igual que shadcn) para compatibilidad con alpha channel en Tailwind.

---

### Sistema de estados semánticos ★

Los estados `success`, `warning`, `destructive` e `info` son un sistema transversal. Cada estado expone **6 tokens** que cubren todos los contextos de uso:

| Token | Uso |
|---|---|
| `--{state}` | Fondo sólido (botón filled, badge filled) |
| `--{state}-foreground` | Texto/ícono sobre fondo sólido |
| `--{state}-subtle` | Fondo suave/tintado (alert background, row highlight) |
| `--{state}-subtle-foreground` | Texto sobre fondo suave |
| `--{state}-border` | Borde en ese estado (input con error, card de warning) |
| `--text-{state}` | Texto coloreado sobre fondo neutro (helper text, label, inline message) |

**Ejemplo visual por estado:**

```
destructive:
  ┌─ bg-destructive ──────────────────────────────┐  ← fondo sólido (botón danger)
  │  text-destructive-foreground                  │  ← texto sobre fondo sólido
  └───────────────────────────────────────────────┘

  ┌─ bg-destructive-subtle ───────────────────────┐  ← fondo suave (alert de error)
  │  text-destructive-subtle-foreground           │  ← texto sobre fondo suave
  │  border-destructive-border                    │  ← borde del alert
  └───────────────────────────────────────────────┘

  <p class="text-destructive">Este campo es requerido</p>  ← texto sobre fondo neutro
```

**Componentes que consumen estados semánticos:**

| Componente | Cómo aplica el estado |
|---|---|
| `button` | `variant="success|warning|destructive|info"` → fondo sólido + foreground |
| `badge` | `variant="success|warning|destructive|info"` → filled o subtle |
| `alert` | `variant="success|warning|destructive|info"` → subtle bg + border |
| `input` | `state="error|success|warning"` → border + ring + helper text |
| `textarea` | `state="error|success|warning"` → igual que input |
| `select` | `state="error|success|warning"` → igual que input |
| `form-field` | wrapper que propaga el state a label + input + helper text |
| `toast` | `variant="success|warning|destructive|info"` → fondo sólido o subtle |
| `progress` | `variant="success|warning|destructive|info"` → color de la barra |
| `card` | `state="success|warning|destructive|info"` → border coloreado |
| `table` row | `state="success|warning|destructive|info"` → subtle row highlight |
| `label` | recibe `state` del `form-field` padre → `text-{state}` |
| `helper-text` | recibe `state` del `form-field` padre → ícono + `text-{state}` |
| `tooltip` | `variant="success|warning|destructive|info"` → fondo semántico |

**Regla de propagación en formularios:**

```html
{{-- El form-field propaga el estado a todos sus hijos --}}
<x-ui.form-field state="error" message="Este campo es requerido">
    <x-ui.label>Email</x-ui.label>         {{-- se tiñe con text-destructive --}}
    <x-ui.input type="email" />             {{-- borde destructive-border + ring --}}
    {{-- helper-text se renderiza automáticamente con ícono ✕ + text-destructive --}}
</x-ui.form-field>

<x-ui.form-field state="success" message="Email disponible">
    <x-ui.label>Email</x-ui.label>         {{-- text-success --}}
    <x-ui.input type="email" />             {{-- borde success-border --}}
    {{-- helper-text con ícono ✓ + text-success --}}
</x-ui.form-field>
```

---

## Tailwind Config

`tailwind.config.js` mapea 1:1 las CSS variables a clases utilitarias de Tailwind. Ningún valor de color, radio, fuente o sombra está hardcodeado en el config.

```js
// Resultado: bg-primary, text-muted-foreground, rounded-lg, shadow-md
// → todos apuntan a CSS variables
// → un cambio en design-tokens.css cambia todo el sistema
```

---

## UI del Inspector (shadcn-inspector)

```
┌──────────────────────────────────────────────────────────┐
│  shadcn inspector              🌙 dark  ☀️ light  [tema] │
├─────────────┬────────────────────────────────────────────┤
│  Sidebar    │  Preview area                              │
│             │  ┌──────────────────────────────────────┐  │
│  Inputs     │  │  [componente renderizado]            │  │
│   Button    │  └──────────────────────────────────────┘  │
│   Input     │                                            │
│   Checkbox  │  ╔════════════╦═════════════╗             │
│   Select    │  ║  Preview   ║  Code       ║             │
│   Textarea  │  ╠════════════╩═════════════╣             │
│   Switch    │  ║  <Button variant=        ║             │
│   Slider    │  ║    "default">            ║             │
│             │  ║    Click me              ║             │
│  Surfaces   │  ║  </Button>               ║             │
│   Card      │  ╚═══════════════════════════╝             │
│   Alert     │                                            │
│   Dialog    │  Variantes:  [default] [outline] [ghost]   │
│   Sheet     │  Tamaños:    [sm]      [md]      [lg]      │
│   Drawer    │                                            │
│   Tooltip   │  → Blade equivalent: resources/views/      │
│             │    components/ui/button.blade.php          │
│  Navigation │                                            │
│   Tabs      │                                            │
│   Breadcrumb│                                            │
│   Sidebar   │                                            │
│             │                                            │
│  Data       │                                            │
│   Table     │                                            │
│   Avatar    │                                            │
│   Progress  │                                            │
│   Skeleton  │                                            │
└─────────────┴────────────────────────────────────────────┘
```

**Funcionalidades del inspector:**
- Sidebar con componentes agrupados por categoría
- Toggle claro/oscuro
- Selector de preset de color (basado en los temas de shadcn)
- Panel de preview con el componente renderizado y sus variantes
- Panel de código con el JSX de shadcn y el Blade equivalente en tabs
- Link directo al archivo Blade correspondiente en `laravel-app`

---

## Arquitectura de Componentes Blade

Cada componente sigue el mismo contrato. Hay dos ejes ortogonales: **variante** (rol visual) y **state** (estado semántico):

```php
@props([
    // Eje 1 — rol visual
    'variant' => 'default',   // default | outline | ghost | secondary | link
    'size'    => 'md',        // sm | md | lg | icon

    // Eje 2 — estado semántico (se aplica sobre cualquier variante)
    'state'   => null,        // success | warning | destructive | info | null
])

// Las clases base vienen de 'variant'
// El estado sobreescribe solo los tokens de color afectados (border, ring, text)
// ARIA: aria-invalid para destructive/error, role="status" para success
// $attributes->merge() para extensibilidad total
// Alpine.js para estados interactivos
```

**Separación de responsabilidades:**

```
variant  →  define la forma y peso visual del componente
state    →  tiñe el componente con el color semántico correspondiente
size     →  controla las dimensiones (height, padding, font-size)
```

**Ejemplo — Button con ambos ejes:**

```html
{{-- Forma: outline / Estado: destructive --}}
<x-ui.button variant="outline" state="destructive">Eliminar</x-ui.button>

{{-- Forma: filled / Estado: success --}}
<x-ui.button variant="default" state="success">Confirmado</x-ui.button>

{{-- Sin estado (comportamiento shadcn estándar) --}}
<x-ui.button variant="ghost">Cancelar</x-ui.button>
```

**Composición para componentes complejos:**

```html
<x-ui.card>
    <x-ui.card.header>
        <x-ui.card.title>Título</x-ui.card.title>
        <x-ui.card.description>Descripción</x-ui.card.description>
    </x-ui.card.header>
    <x-ui.card.content>
        Contenido
    </x-ui.card.content>
    <x-ui.card.footer>
        <x-ui.button>Acción</x-ui.button>
    </x-ui.card.footer>
</x-ui.card>
```

---

## Fases de Implementación

### Fase 1 — shadcn-inspector

**Objetivo:** inspector funcional con todos los componentes shadcn instalados.

- [ ] Crear proyecto Vite + React + TypeScript
- [ ] Instalar Tailwind CSS v4
- [ ] Inicializar shadcn/ui (`pnpm dlx shadcn@latest init`)
- [ ] Instalar todos los componentes shadcn
- [ ] Configurar shadcn MCP (`pnpm dlx shadcn@latest mcp init --client claude`)
- [ ] Construir layout del inspector (sidebar + preview + code tabs)
- [ ] Registrar todos los componentes con metadata (nombre, categoría, variantes disponibles)
- [ ] Implementar toggle claro/oscuro
- [ ] Implementar selector de preset de color
- [ ] Implementar panel de código con syntax highlighting

**Stack:** Vite 6, React 19, TypeScript, Tailwind v4, shadcn/ui, shadcn MCP

---

### Fase 2 — laravel-app: base del sistema

**Objetivo:** proyecto Laravel listo para recibir componentes Blade.

- [ ] Crear proyecto Laravel 12
- [ ] Instalar Tailwind CSS v4
- [ ] Instalar Alpine.js
- [ ] Crear `design-tokens.css` completo (todos los tokens listados arriba, light + dark)
- [ ] Configurar `tailwind.config.js` mapeando todas las CSS variables
- [ ] Crear `config/design-system.php` para acceso server-side a tokens
- [ ] Crear layout base con toggle de tema claro/oscuro
- [ ] Crear página de showcase (índice de todos los componentes)

---

### Fase 3 — Componentes primitivos

**Objetivo:** componentes base sin dependencias entre sí.

- [ ] `button` — variantes: default, outline, ghost, secondary, link / states: success, warning, destructive, info / tamaños: sm, md, lg, icon
- [ ] `badge` — variantes: default, secondary, outline / states: success, warning, destructive, info (filled + subtle)
- [ ] `label` — con `for` binding, hereda state del form-field padre
- [ ] `helper-text` — ícono + mensaje, hereda state del form-field padre (success ✓, warning ⚠, destructive ✕, info ℹ)
- [ ] `input` — states: success, warning, destructive (border + ring + helper text)
- [ ] `textarea` — states: success, warning, destructive
- [ ] `separator` — horizontal y vertical
- [ ] `skeleton`
- [ ] `avatar` — con fallback a iniciales
- [ ] `progress` — states: success, warning, destructive, info (color de la barra)
- [ ] `spinner` (extra, no en shadcn base)

---

### Fase 4 — Superficies y overlays

**Objetivo:** componentes de contenedor y capas.

- [ ] `card` — states: success, warning, destructive, info (borde coloreado lateral o completo)
- [ ] `card.header` + `card.title` + `card.description` + `card.content` + `card.footer`
- [ ] `alert` — states: success, warning, destructive, info (subtle bg + border + ícono automático)
- [ ] `alert-dialog` — Alpine.js
- [ ] `dialog` — Alpine.js
- [ ] `sheet` — Alpine.js (slide desde cualquier lado)
- [ ] `drawer` — Alpine.js
- [ ] `tooltip` — states: success, warning, destructive, info / variantes: default, dark
- [ ] `popover` — Alpine.js
- [ ] `hover-card` — Alpine.js

---

### Fase 5 — Formularios avanzados

**Objetivo:** inputs complejos con accesibilidad completa.

- [ ] `form-field` — wrapper que propaga `state` a label + input + helper-text hijos ★
- [ ] `select` — Alpine.js + ARIA / states: success, warning, destructive
- [ ] `checkbox` — estados: default, indeterminate / states: success, warning, destructive
- [ ] `radio-group` + `radio` — states: destructive (validación)
- [ ] `switch` — states: success, destructive
- [ ] `slider` — states: success, warning, destructive (color del track)
- [ ] `toggle` + `toggle-group`
- [ ] `calendar` / `date-picker` — Alpine.js
- [ ] `form` — wrapper raíz con integración de errores de validación Laravel (`$errors`)

---

### Fase 6 — Navegación

**Objetivo:** componentes de navegación y estructura.

- [ ] `tabs` + `tab` + `tab-content` — Alpine.js
- [ ] `breadcrumb` + `breadcrumb.item`
- [ ] `pagination`
- [ ] `navigation-menu` — Alpine.js
- [ ] `sidebar` — Alpine.js (colapsable)
- [ ] `collapsible` — Alpine.js
- [ ] `accordion` — Alpine.js
- [ ] `command` / `combobox` — Alpine.js + búsqueda

---

### Fase 7 — Data display

**Objetivo:** componentes para mostrar datos estructurados.

- [ ] `table` + `table.head` + `table.row` + `table.cell` + `table.foot`
- [ ] `data-table` — con sort, filtros, paginación server-side (Livewire o Alpine)
- [ ] `chart` — wrapper para Chart.js usando tokens del sistema
- [ ] `carousel` — Alpine.js

---

### Fase 7 — Data display (actualizado)

**Objetivo:** componentes para mostrar datos estructurados.

- [ ] `table` + `table.head` + `table.row` + `table.cell` + `table.foot`
- [ ] `table.row` — states: success, warning, destructive, info (subtle row highlight)
- [ ] `data-table` — con sort, filtros, paginación server-side (Livewire o Alpine)
- [ ] `chart` — wrapper para Chart.js usando tokens del sistema
- [ ] `carousel` — Alpine.js

---

### Fase 8 — Feedback y notificaciones

- [ ] `toast` — states: success, warning, destructive, info / variantes: filled, subtle / Alpine.js + stack
- [ ] `notification-badge` — states: success, warning, destructive, info

---

## Criterios de Diseño Base

> Estos criterios son la fuente de verdad para construir interfaces. Están replicados en `CLAUDE.md` para que el agente los aplique automáticamente.

---

### Regla fundamental: grilla de 4px

Todo valor de espaciado es múltiplo de 4px. Garantiza alineación visual sin trabajo manual.

```
4 → 8 → 12 → 16 → 20 → 24 → 32 → 40 → 48 → 64 → 80 → 96px
```

- **8px** — gap más común dentro de un componente
- **16px** — unidad de referencia para separar componentes relacionados
- Ningún valor de spacing puede ser arbitrario (no `7px`, no `11px`)

---

### Jerarquía de espaciado (principio de proximidad)

Lo relacionado está más cerca. Cinco niveles, de menor a mayor:

| Nivel | Dónde aplica | Rango |
|---|---|---|
| **Micro** | Ícono + texto, label + input, input + helper text | 4–8px |
| **Inset** | Padding interno de un componente | 8–20px según `size` |
| **Stack** | Entre elementos del mismo grupo (campos, botones) | 8–16px |
| **Section** | Entre secciones relacionadas de una página | 24–40px |
| **Block** | Entre bloques principales de una página | 48–96px |

---

### Sistema de tamaños sm / md / lg

Todos los componentes interactivos comparten la misma escala. Un `Input size="sm"` y un `Button size="sm"` tienen la misma altura — los formularios se alinean sin ajustes manuales.

| Token | `sm` | `md` | `lg` |
|---|---|---|---|
| `--height` | 32px | 40px | 48px |
| `--padding-x` | 12px | 16px | 20px |
| `--padding-y` | 6px | 8px | 10px |
| `--text-size` | 13px | 14px | 16px |
| `--icon-size` | 14px | 16px | 18px |
| `--gap-internal` | 6px | 8px | 10px |

**Regla:** todos los componentes en un mismo formulario o grupo de acciones usan el mismo `size`. No mezclar `sm` con `md` en el mismo contexto.

---

### Breakpoints y comportamiento responsive

#### Breakpoints (Tailwind estándar)

| Nombre | Ancho | Contexto |
|---|---|---|
| *(base)* | < 640px | Mobile portrait |
| `sm` | ≥ 640px | Mobile landscape |
| `md` | ≥ 768px | Tablet portrait |
| `lg` | ≥ 1024px | Tablet landscape / desktop chico |
| `xl` | ≥ 1280px | Desktop estándar |
| `2xl` | ≥ 1536px | Desktop wide |

#### Container y padding de página

| Viewport | Padding lateral | Max-width |
|---|---|---|
| < 640px | 16px | 100% |
| 640–1024px | 24px | 100% |
| 1024–1280px | 32px | 1024px |
| 1280–1536px | 40px | 1280px |
| > 1536px | 48px | 1536px |

#### Grid de columnas

| Viewport | Columnas | Gutter |
|---|---|---|
| < 640px | 4 | 16px |
| 640–1024px | 8 | 24px |
| > 1024px | 12 | 32px |

#### Patrones responsive por tipo de pantalla

| Patrón | Mobile | Desktop |
|---|---|---|
| Formulario | 1 col, full-width | 1–2 col, max-w-lg |
| Cards | 1 → 2 → 3 → 4 col | `grid-cols-*` |
| Tabla | scroll horizontal | completa |
| Sidebar nav | oculta + hamburger | fija visible |
| Modal / dialog | full-screen o bottom-sheet | centrado, max-w-lg |
| Header actions | solo íconos | íconos + texto |

---

### Tipografía responsive

Cabeceras escalan con el viewport. El cuerpo se mantiene estable.

| Rol semántico | Mobile | Desktop | Line-height | Max-width |
|---|---|---|---|---|
| Display | 36px | 60px | 1.1 | — |
| H1 | 28px | 40px | 1.15 | — |
| H2 | 22px | 30px | 1.2 | — |
| H3 | 18px | 22px | 1.25 | — |
| H4 | 16px | 18px | 1.3 | — |
| Body | 15px | 16px | 1.6 | 65ch |
| Small | 13px | 13px | 1.5 | — |
| Caption | 11px | 12px | 1.4 | — |
| Code | 13px | 13px | 1.7 | — |

**Regla:** texto de párrafo tiene `max-w-prose` (65ch). Más de 75 caracteres por línea fatiga la lectura.

---

### Touch targets (accesibilidad móvil)

Todo elemento interactivo tiene mínimo **44×44px** de área táctil (Apple HIG / WCAG 2.5.5).

- Si el elemento es visualmente más pequeño (checkbox, radio, switch), el padding invisible extiende el área táctil
- `size="sm"` en mobile se recomienda solo para elementos secundarios no críticos
- El `size="md"` (40px) es el mínimo recomendado para acciones principales en mobile

---

### Densidad del sistema

Tres modos que ajustan el espaciado interno vía una variable CSS raíz. No se crean variantes de componente — la misma clase se adapta al contexto:

```css
[data-density="compact"]     { --density-scale: 0.75; }  /* dashboards, tablas */
[data-density="default"]     { --density-scale: 1; }     /* app estándar */
[data-density="comfortable"] { --density-scale: 1.25; }  /* marketing, onboarding */
```

Los tokens de componente se calculan con `calc()`:

```css
--height-md:    calc(40px * var(--density-scale));
--padding-x-md: calc(16px * var(--density-scale));
```

---

### Reglas de composición de pantallas

1. **Una página = una jerarquía clara**: H1 único, H2 para secciones, H3 para sub-secciones
2. **Máximo 3 niveles de anidación visual** en una sola pantalla
3. **Formularios**: agrupar campos relacionados con `fieldset` semántico + gap `Section`
4. **Acciones**: siempre al final del flujo visual (bottom-right en desktop, full-width en mobile)
5. **Estados vacíos y de carga**: toda pantalla de datos define su empty state y skeleton
6. **No más de 2 niveles de grilla** en una sola sección (evitar grids dentro de grids)

---

## Flujo de trabajo: shadcn → Blade

Para cada componente nuevo:

```
1. Abrir shadcn-inspector → seleccionar componente
2. Revisar todas las variantes renderizadas
3. Ver el código JSX en el panel de código
4. Identificar las clases Tailwind clave
5. Reemplazar valores hardcoded por tokens:
      bg-zinc-900  →  bg-primary
      text-white   →  text-primary-foreground
      rounded-md   →  rounded-md (ya es un token)
6. Crear el componente Blade con @props, match(), @class
7. Agregar atributos ARIA y soporte de $attributes->merge()
8. Agregar Alpine.js si el componente tiene estado
9. Agregar a la página showcase de laravel-app
10. Verificar en claro y oscuro, en móvil y desktop
```

---

## Decisiones técnicas

| Decisión | Elección | Razón |
|---|---|---|
| Colores | OKLCH | Compatibilidad con alpha channel en Tailwind, mismo formato que shadcn |
| Interactividad | Alpine.js | Sin build step, sintaxis declarativa en HTML, no requiere React |
| Tailwind | v4 | CSS-first config, mejor performance, soporte nativo de CSS variables |
| Componentes | Composición | `<x-ui.card.header>` en lugar de props anidadas — más flexible en Blade |
| Temas | CSS variables + clase `.dark` | Un solo archivo para cambiar todo, compatible con Tailwind |
| Naming | kebab-case | Consistente con shadcn y convenciones de Blade |

---

## Estado actual

| Proyecto | Estado |
|---|---|
| `shadcn-inspector` | ⬜ No iniciado |
| `laravel-app` | ⬜ No iniciado |
| Design tokens | ⬜ No iniciado |
| Componentes Fase 3 | ⬜ No iniciado |
| Componentes Fase 4 | ⬜ No iniciado |
| Componentes Fase 5 | ⬜ No iniciado |
| Componentes Fase 6 | ⬜ No iniciado |
| Componentes Fase 7 | ⬜ No iniciado |
| Componentes Fase 8 | ⬜ No iniciado |
