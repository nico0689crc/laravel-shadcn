import { NavLink } from 'react-router-dom'
import { CATEGORIES, COMPONENTS, type ComponentCategory } from '@/registry'
import { cn } from '@/lib/utils'
import { ScrollArea } from '@/components/ui/scroll-area'

export function Sidebar() {
  return (
    <aside className="w-56 shrink-0 border-r border-border bg-sidebar flex flex-col h-screen sticky top-0">
      <div className="px-4 py-4 border-b border-border">
        <p className="text-xs font-semibold text-muted-foreground uppercase tracking-widest">
          shadcn inspector
        </p>
      </div>

      <ScrollArea className="flex-1">
        <nav className="px-2 py-3 space-y-5">
          {CATEGORIES.map(cat => (
            <CategoryGroup key={cat.key} category={cat.key} label={cat.label} />
          ))}
        </nav>
      </ScrollArea>
    </aside>
  )
}

function CategoryGroup({ category, label }: { category: ComponentCategory; label: string }) {
  const items = COMPONENTS.filter(c => c.category === category)

  return (
    <div>
      <p className="px-2 mb-1 text-[11px] font-semibold uppercase tracking-widest text-muted-foreground">
        {label}
      </p>
      <ul className="space-y-0.5">
        {items.map(item => (
          <li key={item.name}>
            <NavLink
              to={`/components/${item.name}`}
              className={({ isActive }) =>
                cn(
                  'block px-2 py-1.5 rounded-md text-sm transition-colors',
                  isActive
                    ? 'bg-sidebar-accent text-sidebar-accent-foreground font-medium'
                    : 'text-sidebar-foreground hover:bg-sidebar-accent/50'
                )
              }
            >
              {item.title}
            </NavLink>
          </li>
        ))}
      </ul>
    </div>
  )
}
