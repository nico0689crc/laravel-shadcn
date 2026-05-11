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

### Fase 9 — Páginas de ejemplo

**Objetivo:** demostrar el sistema de diseño aplicado en contextos reales de SaaS. Cada página cubre combinaciones de componentes que en el showcase individual no se pueden ver juntos. Entre las 12 páginas se ejercita cada componente del catálogo al menos una vez.

**Convenciones de cada página:**

- Ruta dentro de `resources/views/` siguiendo la jerarquía de carpetas del CLAUDE.md
- Los tres estados de UI definidos: skeleton de carga, empty-state, contenido real
- Densidad seteada en el contenedor raíz con `data-density`
- Un solo `<h1>` por página, tokens semánticos en todos los colores
- Acciones: bottom-right en desktop, full-width en mobile

---

#### Resumen — tabla de páginas

| # | Nombre | Ruta vista | Densidad | Componentes destacados |
|---|---|---|---|---|
| 1 | Dashboard principal | `dashboard/index` | compact | card, chart, data-table, badge, avatar, progress, skeleton |
| 2 | Configuración con tabs | `settings/index` | default | tabs, form-field, switch, select, avatar, alert-dialog |
| 3 | Lista con filtros avanzados | `members/index` | compact | input, combobox, data-table, checkbox, badge, pagination, sheet |
| 4 | Flujo de onboarding multi-paso | `onboarding/index` | comfortable | progress, radio-group, toggle-group, checkbox, combobox, card |
| 5 | Centro de notificaciones | `notifications/index` | default | tabs, badge, avatar, switch, empty-state, scroll-area, skeleton |
| 6 | Perfil de usuario detallado | `users/show` | default | avatar, card, tabs, hover-card, collapsible, breadcrumb, badge |
| 7 | Facturación y planes | `billing/index` | default | card, badge, progress, table, input-group, alert, dialog |
| 8 | Editor de contenido | `posts/create` | default | textarea, combobox, select, switch, date-picker, dialog, sheet |
| 9 | Analytics y reportes | `analytics/index` | compact | date-picker, chart, card, dropdown-menu, select, tooltip, table |
| 10 | Flujo de autenticación | `auth/login` + `auth/register` + `auth/verify` | comfortable | form-field (estados), input-otp, alert, spinner, separator |
| 11 | Búsqueda global / command palette | `search/index` | default | command, dialog, kbd, avatar, badge, empty-state |
| 12 | Crear / editar producto | `products/create` | default | accordion, input-group, slider, radio-group, toggle, native-select |

---

#### Página 1 — Dashboard principal

**Ruta:** `resources/views/dashboard/index.blade.php`
**Layout:** `x-layouts.app` con sidebar
**Densidad:** `compact`

**Zonas:**

- **Metric row** — 4 `x-ui.card` en grid 4 col: número grande (`typography as="h2"`), label muted, variación con `badge` (success/destructive según signo), mini `progress` de uso
- **Gráfico principal** — `x-ui.card` full-width con `x-ui.chart` (área) y selector de período (`button-group` sm)
- **Tabla de actividad reciente** — `x-ui.data-table` con `avatar` + nombre en celda, `badge` de estado, `dropdown-menu` de acciones por fila
- **Panel lateral interno** — tareas pendientes con `x-ui.collapsible` por categoría, cada ítem con `checkbox` + texto + `badge` de prioridad
- **Estado carga:** `x-ui.skeleton` reemplaza cada zona independientemente
- **Breadcrumb:** `x-ui.breadcrumb` en header de página

**Componentes nuevos que debuta:** `chart`, combinación `data-table` + `avatar` + `dropdown-menu` en misma fila

---

#### Página 2 — Configuración con tabs

**Ruta:** `resources/views/settings/index.blade.php`
**Layout:** `x-layouts.app`
**Densidad:** `default`

**Zonas (4 tabs):**

- **Tab "Perfil"** — `avatar` grande con botón "Cambiar foto" superpuesto; form 2-col: nombre, apellido, bio (`textarea`), timezone (`select`), idioma (`native-select`); `card.footer` con acciones
- **Tab "Notificaciones"** — grupos de `switch` separados por `separator` y `section-label`: Email / Push / Resumen semanal; descripción muted bajo cada switch
- **Tab "Seguridad"** — change password (form 1-col, `input` type password × 3); `separator`; 2FA: `switch` que al activar abre un `dialog` con QR + `input-otp`; sessions list con `table` compacta + botón "Cerrar sesión" por fila
- **Tab "Danger Zone"** — `card` con `border-destructive-border`; texto explicativo muted; botón "Eliminar cuenta" que abre `alert-dialog` con confirmación escribiendo el nombre del workspace

**Componentes nuevos que debuta:** `input-otp` en contexto real (2FA), `alert-dialog` de acción destructiva

---

#### Página 3 — Lista con filtros avanzados

**Ruta:** `resources/views/members/index.blade.php`
**Layout:** `x-layouts.app`
**Densidad:** `compact`

**Zonas:**

- **Toolbar** — `input` con `x-lucide-search` en slot leading (búsqueda en vivo Alpine); `combobox` de rol; `native-select` de estado; botón "Filtros" (abre `sheet` desde la derecha en mobile con filtros completos); count de resultados (`typography as="muted"`)
- **Bulk actions bar** — aparece cuando hay `checkbox` seleccionados: count + `dropdown-menu` de acciones masivas (exportar, archivar, eliminar) con `alert-dialog` para la destructiva
- **Tabla** — `data-table` con: `checkbox` en primera col, `avatar` + nombre + email, `badge` de rol, `badge` de estado (subtle success/destructive), fecha de ingreso, `dropdown-menu` de acciones por fila con sub-menú de permisos
- **Paginación** — `x-ui.pagination` completa
- **Estado vacío:** `x-ui.empty-state` con ícono users, título, descripción y botón "Invitar miembro"
- **Estado carga:** `skeleton` de filas (5 filas de altura fija)

**Componentes nuevos que debuta:** `sheet` como panel de filtros mobile, bulk actions con `checkbox` múltiple, `dropdown-menu` con `sub-trigger`

---

#### Página 4 — Flujo de onboarding multi-paso

**Ruta:** `resources/views/onboarding/index.blade.php`
**Layout:** `x-layouts.app` (sin sidebar, centrado)
**Densidad:** `comfortable`

**Zonas:**

- **Header de progreso** — `progress` bar + indicadores de paso: número + label + línea conectora; estado visual por paso: completado (success), activo (primary), pendiente (muted)
- **Paso 1 "Tu cuenta"** — grid 2-col: nombre, apellido; email full-width; password + confirm; `helper-text` de requisitos (lista de criterios con checkmarks Alpine)
- **Paso 2 "Tu equipo"** — `radio-group` de rol (cards grandes con ícono, título y descripción — no radio clásico); `toggle-group` de tamaño de empresa
- **Paso 3 "Integraciones"** — grid de cards de servicio con `checkbox` superpuesto; `combobox` de timezone; `switch` de notificaciones por email
- **Paso 4 "Confirmación"** — resumen read-only en `card` sections: datos ingresados en cada paso con `section-label` separando grupos; ningún input, solo texto
- **Footer fijo** — `flex-row-reverse`: "Finalizar" / "Siguiente" a la derecha, "Anterior" a la izquierda; en mobile full-width stack

**Componentes nuevos que debuta:** `radio-group` en variante card visual, `toggle-group` como selector de opciones

---

#### Página 5 — Centro de notificaciones

**Ruta:** `resources/views/notifications/index.blade.php`
**Layout:** `x-layouts.app`
**Densidad:** `default`

**Zonas:**

- **Page header** — h1 "Notificaciones" + badge count no leídas (destructive filled); botón "Marcar todo como leído" (ghost); `dropdown-menu` "Más opciones" (pausar notifs, preferencias)
- **Tabs** — Todas / Sin leer / Menciones / Sistema; cada tab con `badge` de count secundario
- **Lista agrupada** — `section-label` por grupo (Hoy / Ayer / Esta semana / Este mes); cada ítem: `avatar` + texto con mention en **bold** + timestamp muted + punto indicador si no leída; hover muestra acciones: marcar leída, archivar, silenciar
- **Panel de preferencias** — `collapsible` al pie: lista de `switch` por tipo de notificación con `separator` entre grupos
- **Estado vacío:** `empty-state` con ícono bell-off, título "Sin notificaciones", descripción muted
- **Estado carga:** `skeleton` de 6 ítems con avatar + líneas de texto

**Componentes nuevos que debuta:** `scroll-area` wrapeando la lista, `hover-card` sobre el avatar del emisor mostrando perfil rápido

---

#### Página 6 — Perfil de usuario detallado

**Ruta:** `resources/views/users/show.blade.php`
**Layout:** `x-layouts.app`
**Densidad:** `default`

**Zonas:**

- **Breadcrumb** — Equipo › Miembros › {nombre}
- **Hero section** — `avatar` xl (80px) + nombre (`typography as="h1"`) + cargo muted + `badge` de rol (outline) + `badge` de estado (subtle success/destructive); `button-group` de acciones: "Editar", "Enviar mensaje", `dropdown-menu` "Más"
- **Stats row** — 3 `card` compactas: proyectos activos, tareas completadas, días en el equipo; número grande + label muted
- **Tabs de contenido:**
  - "Actividad" — timeline vertical: ícono de acción + texto + timestamp; `hover-card` en mentions de otros usuarios mostrando mini perfil
  - "Permisos" — `accordion` por módulo (Proyectos, Facturación, Equipo, Config): dentro `checkbox` por permiso con descripción muted
  - "Dispositivos" — `table` compacta: dispositivo + SO + última sesión + ubicación + botón revocar
  - "Auditoría" — `data-table` con filtro de tipo de acción (`combobox`) + timestamps + IP

**Componentes nuevos que debuta:** `hover-card` como mini-perfil en mentions, `breadcrumb` multi-nivel, `button-group` de acciones de perfil

---

#### Página 7 — Facturación y planes

**Ruta:** `resources/views/billing/index.blade.php`
**Layout:** `x-layouts.app`
**Densidad:** `default`

**Zonas:**

- **Alert contextual** — `alert` state warning si trial expira en < 7 días: ícono automático + texto + botón "Actualizar plan" inline
- **Plan actual** — `card` con `badge` "Plan Pro" (primary outline) en título; features en lista con ícono check-circle success; `progress` de 3 quotas (usuarios, proyectos, almacenamiento) con label y porcentaje; botón "Cambiar plan" (outline)
- **Selector de planes** — toggle anual/mensual (`toggle-group`) + grid 3 col de `card` por plan: `badge` "Popular" (primary filled) en el recomendado; lista de features con check/x; botón "Seleccionar" que abre `dialog` de confirmación con detalle de cambio y cargo prorrateado
- **Historial de facturas** — `table`: fecha / descripción / monto / estado (`badge` subtle) / acción descarga (`button` ghost size sm con ícono)
- **Método de pago** — `card` con form inline: `input-group` (ícono tarjeta + número) + `input` mes/año en grid 2-col + `input` CVV + botón guardar; `badge` de tarjeta activa actual

**Componentes nuevos que debuta:** `input-group` con addon de ícono en contexto de tarjeta de crédito, `dialog` de confirmación de cambio de plan con cálculo de prorate

---

#### Página 8 — Editor de contenido

**Ruta:** `resources/views/posts/create.blade.php`
**Layout:** `x-layouts.app` (sin max-width limitado, usa todo el ancho)
**Densidad:** `default`

**Zonas:**

- **Toolbar superior** — `breadcrumb` (Contenido › Posts › Nuevo); `button-group` derecha: "Vista previa" (abre `dialog` fullscreen), "Guardar borrador" (ghost), "Publicar" (primary)
- **Layout 2 columnas** — editor 65% + sidebar metadatos 35%
- **Columna editor:**
  - `input` xl para título (sin borde, font grande, placeholder "Título del artículo")
  - `separator`
  - `textarea` extendido (mínimo 400px de alto, auto-grow Alpine)
- **Columna sidebar metadatos** — sticky al scroll:
  - `select` de estado (Borrador / Revisión / Publicado)
  - `switch` de visibilidad (Público / Privado)
  - `date-picker` de fecha de publicación (con `calendar` desplegable)
  - `combobox` multiselect de categorías
  - `combobox` multiselect de tags con opción de crear nuevo inline
  - `accordion` "SEO": inputs de meta-título, meta-descripción (`textarea` sm), URL slug (`input-group` con prefijo de dominio)
- **En mobile** — sidebar se convierte en `sheet` activado por botón "Configuración" flotante

**Componentes nuevos que debuta:** `date-picker` con `calendar` integrado, `combobox` con creación de items nuevos, `input-group` con addon de texto (prefijo URL)

---

#### Página 9 — Analytics y reportes

**Ruta:** `resources/views/analytics/index.blade.php`
**Layout:** `x-layouts.app`
**Densidad:** `compact`

**Zonas:**

- **Toolbar** — `date-picker` de rango (con `calendar` dual mostrando 2 meses); `combobox` de canal (Todos / Email / Web / App); `combobox` de segmento; `dropdown-menu` "Exportar" (CSV, PDF, imagen) con `separator` entre formatos
- **KPI row** — 4 `card` compactas: métrica principal grande + variación (`badge` success/destructive con flecha) + sparkline inline (`chart` mini de 30px de alto)
- **Gráfico principal** — `card` full-width: `tabs` (Usuarios / Eventos / Conversión / Retención) en header + `chart` tipo line/bar; `button-group` sm derecha para cambiar tipo de gráfico; `tooltip` en puntos de datos
- **Tabs de detalle** — Por canal / Por campaña / Por geografía
  - Contenido: `table` con sort por columna + `badge` de variación en celdas numéricas
- **Paginación** — `pagination` al pie de cada tabla de detalle

**Componentes nuevos que debuta:** `date-picker` de rango con `calendar` dual, `chart` en variante sparkline, `tooltip` sobre elementos de gráfico

---

#### Página 10 — Flujo de autenticación

**Ruta:** `resources/views/auth/login.blade.php` + `auth/register.blade.php` + `auth/verify.blade.php`
**Layout:** `x-layouts.auth` (centrado, sin sidebar)
**Densidad:** `comfortable`

**Vista Login:**
- Logo + `typography as="h1"` + lead muted
- `alert` state destructive si hay error de credenciales (aparece sobre el form)
- `form-field` email con estado destructive y helper-text si hay error de validación
- `form-field` password con `input` que tiene trailing slot (ícono ojo toggle visible/oculto Alpine)
- `checkbox` "Recordarme" con label clickeable
- Link "¿Olvidaste tu contraseña?" (ghost, text-sm, alineado derecha)
- `button` full-width "Iniciar sesión" con `spinner` inline cuando loading (Alpine)
- `separator` con texto "o continuar con"
- Botones OAuth: GitHub + Google (`button` variant outline full-width, ícono SVG + texto)

**Vista Register:**
- Grid 2-col: nombre, apellido; email full-width; password full-width; confirm password full-width
- `alert` state destructive mostrando lista de errores de validación Laravel (`$errors->all()`)
- `checkbox` de términos con link inline
- `button` full-width "Crear cuenta"
- Link "¿Ya tenés cuenta? Iniciar sesión"

**Vista Verify OTP:**
- `typography as="h2"` centrado + muted explicando que se envió código a {email}
- `input-otp` centrado (6 dígitos, auto-avance Alpine)
- Countdown "Reenviar en 0:45" con `spinner` → link "Reenviar código" cuando llega a 0
- Link "Usar otro email" (ghost sm)

**Componentes nuevos que debuta:** `input-otp` en flujo de verificación, `spinner` en botón de submit, estados de validación Laravel en form completo

---

#### Página 11 — Búsqueda global / command palette

**Ruta:** `resources/views/search/index.blade.php` (también disponible como overlay desde cualquier página)
**Layout:** `x-layouts.app` (la página) + overlay `dialog` (el modal)
**Densidad:** `default`

**Como overlay (`⌘K` desde cualquier página):**
- `command.dialog` que abre un `dialog` de ancho medio
- `command.input` con ícono search y placeholder "Buscar..."
- Grupos con `command.group` + `command.label`:
  - "Recientes" — ítems con `avatar` o ícono de tipo + título + subtítulo muted
  - "Acciones rápidas" — ítems con ícono + label + `kbd` de shortcut al final
  - "Páginas" — ítems con ícono de página + ruta muted
  - "Miembros" — ítems con `avatar` + nombre + cargo
- `command.empty` cuando no hay resultados: ícono search + "Sin resultados para «{query}»"
- `command.separator` entre grupos
- Footer del dialog: hints de `kbd` (↑↓ navegar, Enter seleccionar, Esc cerrar)

**Como página dedicada:**
- Page header: h1 "Buscar" + input grande de búsqueda
- Resultados organizados por tipo con `section-label` + `badge` count por sección
- `empty-state` completo cuando no hay resultados

**Componentes nuevos que debuta:** `command` completo con todos sus sub-componentes, `kbd` en contexto de shortcuts de navegación

---

#### Página 12 — Crear / editar producto

**Ruta:** `resources/views/products/create.blade.php`
**Layout:** `x-layouts.app`
**Densidad:** `default`

**Zonas:**

- **Breadcrumb** — Catálogo › Productos › Nuevo producto
- **Sección "Información básica"** (siempre visible, fuera del accordion):
  - `input` nombre del producto full-width
  - `textarea` descripción
  - `combobox` de categoría
  - `native-select` de marca
- **`accordion`** con 4 secciones colapsables:
  - **"Precios y stock"** — `input-group` precio con addon `$` al inicio + `input` costo; grid 2-col: `input` stock inicial + `input` stock mínimo; `slider` de margen de ganancia con valor en tiempo real (Alpine); `switch` "Gestionar stock" que muestra/oculta campos de stock
  - **"Variantes"** — `toggle-group` de tallas disponibles (XS/S/M/L/XL); `toggle-group` de colores (con dot de color); tabla inline de combinaciones variante-precio-stock
  - **"SEO y visibilidad"** — `radio-group` vertical de visibilidad (Público / Solo con link / Privado); `input-group` URL slug con prefijo; `input` meta-título con contador de caracteres (Alpine); `textarea` meta-descripción con contador
  - **"Configuración avanzada"** — `switch` "Producto digital" (cambia campos de envío); `switch` "Requiere dirección de envío"; `native-select` de clase impositiva; `input` peso + dimensiones en grid 4-col
- **Card.footer sticky** — "Cancelar" (ghost) + "Guardar borrador" (outline) + "Publicar" (primary)

**Componentes nuevos que debuta:** `accordion` como estructura de formulario multi-sección, `slider` con valor reactivo, `toggle-group` de selección visual (colores/tallas), `radio-group` en variante lista vertical

---

#### Estado de construcción — Fase 9

| # | Página | Estado |
|---|---|---|
| 1 | Dashboard principal | ⬜ No iniciado |
| 2 | Configuración con tabs | ⬜ No iniciado |
| 3 | Lista con filtros avanzados | ⬜ No iniciado |
| 4 | Flujo de onboarding multi-paso | ⬜ No iniciado |
| 5 | Centro de notificaciones | ⬜ No iniciado |
| 6 | Perfil de usuario detallado | ⬜ No iniciado |
| 7 | Facturación y planes | ⬜ No iniciado |
| 8 | Editor de contenido | ⬜ No iniciado |
| 9 | Analytics y reportes | ⬜ No iniciado |
| 10 | Flujo de autenticación (3 vistas) | ⬜ No iniciado |
| 11 | Búsqueda global / command palette | ⬜ No iniciado |
| 12 | Crear / editar producto | ⬜ No iniciado |

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
| `laravel-app` | ✅ Base lista |
| Design tokens | ✅ Completo |
| Componentes Fase 3 — Primitivos | ✅ Completo |
| Componentes Fase 4 — Superficies y overlays | ✅ Completo |
| Componentes Fase 5 — Formularios avanzados | ✅ Completo |
| Componentes Fase 6 — Navegación | ✅ Completo |
| Componentes Fase 7 — Data display | ✅ Completo |
| Componentes Fase 8 — Feedback | ✅ Completo |
| **Páginas Fase 9** | **⬜ Planificado** |
| — P01 Dashboard principal | ✅ Completo |
| — P02 Configuración con tabs | ⬜ No iniciado |
| — P03 Lista con filtros avanzados | ⬜ No iniciado |
| — P04 Onboarding multi-paso | ⬜ No iniciado |
| — P05 Centro de notificaciones | ⬜ No iniciado |
| — P06 Perfil de usuario | ⬜ No iniciado |
| — P07 Facturación y planes | ⬜ No iniciado |
| — P08 Editor de contenido | ⬜ No iniciado |
| — P09 Analytics y reportes | ⬜ No iniciado |
| — P10 Flujo de autenticación | ✅ Completo |
| — P11 Búsqueda / command palette | ⬜ No iniciado |
| — P12 Crear / editar producto | ⬜ No iniciado |
