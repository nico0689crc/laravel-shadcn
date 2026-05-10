import { Separator } from '@/components/ui/separator'

export const code = `import { Separator } from "@/components/ui/separator"

<Separator />
<Separator orientation="vertical" />`

export function Preview() {
  return (
    <div className="space-y-8">
      <div>
        <p className="text-xs text-muted-foreground mb-2 uppercase tracking-wide">Horizontal</p>
        <div className="space-y-4">
          <p className="text-sm">Elemento arriba</p>
          <Separator />
          <p className="text-sm">Elemento abajo</p>
        </div>
      </div>
      <div>
        <p className="text-xs text-muted-foreground mb-2 uppercase tracking-wide">Vertical</p>
        <div className="flex items-center gap-4 h-8">
          <span className="text-sm">Izquierda</span>
          <Separator orientation="vertical" />
          <span className="text-sm">Derecha</span>
        </div>
      </div>
    </div>
  )
}
