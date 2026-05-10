export type ComponentCategory =
  | 'inputs'
  | 'surfaces'
  | 'navigation'
  | 'data'
  | 'feedback'
  | 'layout'

export interface ComponentMeta {
  name: string
  title: string
  category: ComponentCategory
  description: string
  bladeEquivalent: string
}

export const CATEGORIES: { key: ComponentCategory; label: string }[] = [
  { key: 'inputs',     label: 'Inputs' },
  { key: 'surfaces',   label: 'Surfaces' },
  { key: 'navigation', label: 'Navigation' },
  { key: 'data',       label: 'Data' },
  { key: 'feedback',   label: 'Feedback' },
  { key: 'layout',     label: 'Layout' },
]

export const COMPONENTS: ComponentMeta[] = [
  // ── Inputs ───────────────────────────────────────────────
  { name: 'button',        title: 'Button',        category: 'inputs',     description: 'Acción primaria. Variantes filled, outline, ghost, link.',           bladeEquivalent: 'components/ui/button.blade.php' },
  { name: 'input',         title: 'Input',         category: 'inputs',     description: 'Campo de texto de línea única con soporte de estados.',              bladeEquivalent: 'components/ui/input.blade.php' },
  { name: 'textarea',      title: 'Textarea',       category: 'inputs',     description: 'Campo de texto multilínea.',                                         bladeEquivalent: 'components/ui/textarea.blade.php' },
  { name: 'label',         title: 'Label',          category: 'inputs',     description: 'Etiqueta accesible asociada a un campo.',                            bladeEquivalent: 'components/ui/label.blade.php' },
  { name: 'checkbox',      title: 'Checkbox',       category: 'inputs',     description: 'Selección booleana con estado indeterminate.',                       bladeEquivalent: 'components/ui/checkbox.blade.php' },
  { name: 'radio-group',   title: 'Radio Group',    category: 'inputs',     description: 'Selección exclusiva entre opciones.',                                bladeEquivalent: 'components/ui/radio-group.blade.php' },
  { name: 'switch',        title: 'Switch',         category: 'inputs',     description: 'Toggle binario con animación.',                                      bladeEquivalent: 'components/ui/switch.blade.php' },
  { name: 'select',        title: 'Select',         category: 'inputs',     description: 'Dropdown de selección única.',                                       bladeEquivalent: 'components/ui/select.blade.php' },
  { name: 'slider',        title: 'Slider',         category: 'inputs',     description: 'Input numérico mediante arrastre.',                                  bladeEquivalent: 'components/ui/slider.blade.php' },
  { name: 'toggle',        title: 'Toggle',         category: 'inputs',     description: 'Botón con estado activo/inactivo.',                                  bladeEquivalent: 'components/ui/toggle.blade.php' },
  { name: 'toggle-group',  title: 'Toggle Group',   category: 'inputs',     description: 'Grupo de toggles con selección simple o múltiple.',                  bladeEquivalent: 'components/ui/toggle-group.blade.php' },
  { name: 'input-otp',     title: 'Input OTP',      category: 'inputs',     description: 'Campo segmentado para códigos de verificación.',                     bladeEquivalent: 'components/ui/input-otp.blade.php' },
  { name: 'form',          title: 'Form',           category: 'inputs',     description: 'Wrapper de formulario con validación y propagación de errores.',     bladeEquivalent: 'components/ui/form.blade.php' },
  { name: 'calendar',      title: 'Calendar',       category: 'inputs',     description: 'Selector de fecha en vista de calendario.',                          bladeEquivalent: 'components/ui/calendar.blade.php' },

  // ── Surfaces ─────────────────────────────────────────────
  { name: 'card',           title: 'Card',          category: 'surfaces',   description: 'Contenedor principal de contenido con estructura header/content/footer.', bladeEquivalent: 'components/ui/card.blade.php' },
  { name: 'alert',          title: 'Alert',         category: 'surfaces',   description: 'Mensaje contextual con estados semánticos.',                         bladeEquivalent: 'components/ui/alert.blade.php' },
  { name: 'alert-dialog',   title: 'Alert Dialog',  category: 'surfaces',   description: 'Diálogo de confirmación bloqueante.',                                bladeEquivalent: 'components/ui/alert-dialog.blade.php' },
  { name: 'dialog',         title: 'Dialog',        category: 'surfaces',   description: 'Modal de propósito general.',                                        bladeEquivalent: 'components/ui/dialog.blade.php' },
  { name: 'sheet',          title: 'Sheet',         category: 'surfaces',   description: 'Panel lateral deslizante (side drawer).',                            bladeEquivalent: 'components/ui/sheet.blade.php' },
  { name: 'drawer',         title: 'Drawer',        category: 'surfaces',   description: 'Panel inferior deslizante (mobile-first).',                          bladeEquivalent: 'components/ui/drawer.blade.php' },
  { name: 'popover',        title: 'Popover',       category: 'surfaces',   description: 'Capa flotante anclada a un trigger.',                                bladeEquivalent: 'components/ui/popover.blade.php' },
  { name: 'hover-card',     title: 'Hover Card',    category: 'surfaces',   description: 'Tarjeta de preview al hacer hover sobre un elemento.',               bladeEquivalent: 'components/ui/hover-card.blade.php' },
  { name: 'tooltip',        title: 'Tooltip',       category: 'surfaces',   description: 'Etiqueta flotante de ayuda.',                                        bladeEquivalent: 'components/ui/tooltip.blade.php' },
  { name: 'collapsible',    title: 'Collapsible',   category: 'surfaces',   description: 'Sección expandible/colapsable.',                                     bladeEquivalent: 'components/ui/collapsible.blade.php' },
  { name: 'scroll-area',    title: 'Scroll Area',   category: 'surfaces',   description: 'Contenedor con scroll personalizado.',                               bladeEquivalent: 'components/ui/scroll-area.blade.php' },
  { name: 'resizable',      title: 'Resizable',     category: 'surfaces',   description: 'Paneles redimensionables mediante drag.',                            bladeEquivalent: 'components/ui/resizable.blade.php' },

  // ── Navigation ───────────────────────────────────────────
  { name: 'tabs',             title: 'Tabs',             category: 'navigation', description: 'Navegación por pestañas.',                                bladeEquivalent: 'components/ui/tabs.blade.php' },
  { name: 'accordion',        title: 'Accordion',        category: 'navigation', description: 'Lista de secciones expandibles, una a la vez.',          bladeEquivalent: 'components/ui/accordion.blade.php' },
  { name: 'breadcrumb',       title: 'Breadcrumb',       category: 'navigation', description: 'Ruta de navegación jerárquica.',                          bladeEquivalent: 'components/ui/breadcrumb.blade.php' },
  { name: 'pagination',       title: 'Pagination',       category: 'navigation', description: 'Navegación entre páginas de contenido.',                  bladeEquivalent: 'components/ui/pagination.blade.php' },
  { name: 'navigation-menu',  title: 'Navigation Menu',  category: 'navigation', description: 'Menú de navegación principal con submenús.',              bladeEquivalent: 'components/ui/navigation-menu.blade.php' },
  { name: 'menubar',          title: 'Menubar',          category: 'navigation', description: 'Barra de menús tipo desktop app.',                        bladeEquivalent: 'components/ui/menubar.blade.php' },
  { name: 'dropdown-menu',    title: 'Dropdown Menu',    category: 'navigation', description: 'Menú contextual desplegable.',                            bladeEquivalent: 'components/ui/dropdown-menu.blade.php' },
  { name: 'context-menu',     title: 'Context Menu',     category: 'navigation', description: 'Menú que aparece al hacer clic derecho.',                 bladeEquivalent: 'components/ui/context-menu.blade.php' },
  { name: 'command',          title: 'Command',          category: 'navigation', description: 'Paleta de comandos con búsqueda (tipo Spotlight).',       bladeEquivalent: 'components/ui/command.blade.php' },
  { name: 'sidebar',          title: 'Sidebar',          category: 'navigation', description: 'Panel lateral de navegación colapsable.',                 bladeEquivalent: 'components/ui/sidebar.blade.php' },

  // ── Data ─────────────────────────────────────────────────
  { name: 'table',        title: 'Table',       category: 'data',       description: 'Tabla de datos accesible con header, body y footer.',               bladeEquivalent: 'components/ui/table.blade.php' },
  { name: 'avatar',       title: 'Avatar',      category: 'data',       description: 'Imagen de usuario con fallback a iniciales.',                        bladeEquivalent: 'components/ui/avatar.blade.php' },
  { name: 'badge',        title: 'Badge',       category: 'data',       description: 'Etiqueta compacta para estados y categorías.',                       bladeEquivalent: 'components/ui/badge.blade.php' },
  { name: 'progress',     title: 'Progress',    category: 'data',       description: 'Barra de progreso con valor numérico.',                             bladeEquivalent: 'components/ui/progress.blade.php' },
  { name: 'skeleton',     title: 'Skeleton',    category: 'data',       description: 'Placeholder animado durante carga.',                                bladeEquivalent: 'components/ui/skeleton.blade.php' },
  { name: 'carousel',     title: 'Carousel',    category: 'data',       description: 'Carrusel de elementos con navegación.',                             bladeEquivalent: 'components/ui/carousel.blade.php' },
  { name: 'chart',        title: 'Chart',       category: 'data',       description: 'Wrapper para gráficos con tokens del sistema.',                     bladeEquivalent: 'components/ui/chart.blade.php' },
  { name: 'aspect-ratio', title: 'Aspect Ratio',category: 'data',       description: 'Contenedor que mantiene una proporción fija.',                       bladeEquivalent: 'components/ui/aspect-ratio.blade.php' },

  // ── Feedback ─────────────────────────────────────────────
  { name: 'sonner',       title: 'Toast (Sonner)', category: 'feedback', description: 'Sistema de notificaciones toast con stack.',                       bladeEquivalent: 'components/ui/toast.blade.php' },

  // ── Layout ───────────────────────────────────────────────
  { name: 'separator',    title: 'Separator',   category: 'layout',     description: 'Línea divisoria horizontal o vertical.',                            bladeEquivalent: 'components/ui/separator.blade.php' },
  { name: 'input-group',  title: 'Input Group', category: 'layout',     description: 'Agrupa un input con addons (ícono, botón, texto).',                 bladeEquivalent: 'components/ui/input-group.blade.php' },
]

export function getByCategory(category: ComponentCategory): ComponentMeta[] {
  return COMPONENTS.filter(c => c.category === category)
}

export function getByName(name: string): ComponentMeta | undefined {
  return COMPONENTS.find(c => c.name === name)
}
