import { Link } from 'react-router-dom'
import { CATEGORIES, COMPONENTS, type ComponentCategory } from '@/registry'
import { Badge } from '@/components/ui/badge'

const CATEGORY_LABELS: Record<ComponentCategory, string> = {
  inputs:     'Inputs',
  surfaces:   'Surfaces',
  navigation: 'Navigation',
  data:       'Data',
  feedback:   'Feedback',
  layout:     'Layout',
}

export function HomePage() {
  return (
    <div className="px-8 py-8">
      <div className="mb-8">
        <h1 className="text-2xl font-bold tracking-tight">shadcn Inspector</h1>
        <p className="text-muted-foreground mt-1">
          {COMPONENTS.length} componentes · Inspección visual + código · Base para el design system Laravel
        </p>
      </div>

      <div className="space-y-10">
        {CATEGORIES.map(cat => {
          const items = COMPONENTS.filter(c => c.category === cat.key)
          return (
            <section key={cat.key}>
              <div className="flex items-center gap-2 mb-4">
                <h2 className="text-sm font-semibold uppercase tracking-widest text-muted-foreground">
                  {CATEGORY_LABELS[cat.key]}
                </h2>
                <Badge variant="secondary" className="text-xs">{items.length}</Badge>
              </div>
              <div className="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-3">
                {items.map(item => (
                  <Link
                    key={item.name}
                    to={`/components/${item.name}`}
                    className="group flex flex-col gap-1 rounded-lg border border-border bg-card p-4 hover:border-primary/50 hover:bg-accent/30 transition-all"
                  >
                    <span className="font-medium text-sm group-hover:text-primary transition-colors">
                      {item.title}
                    </span>
                    <span className="text-xs text-muted-foreground line-clamp-2">
                      {item.description}
                    </span>
                  </Link>
                ))}
              </div>
            </section>
          )
        })}
      </div>
    </div>
  )
}
