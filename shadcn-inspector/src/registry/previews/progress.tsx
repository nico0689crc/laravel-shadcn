import { Progress } from '@/components/ui/progress'
import { useState, useEffect } from 'react'

export const code = `import { Progress } from "@/components/ui/progress"

<Progress value={60} />`

export function Preview() {
  const [value, setValue] = useState(30)
  useEffect(() => {
    const t = setInterval(() => setValue(v => v >= 100 ? 0 : v + 5), 500)
    return () => clearInterval(t)
  }, [])
  return (
    <div className="space-y-6 max-w-sm">
      <div className="space-y-1.5">
        <p className="text-xs text-muted-foreground uppercase tracking-wide">Animado</p>
        <Progress value={value} />
        <p className="text-xs text-right text-muted-foreground">{value}%</p>
      </div>
      <div className="space-y-1.5">
        <p className="text-xs text-muted-foreground uppercase tracking-wide">25%</p>
        <Progress value={25} />
      </div>
      <div className="space-y-1.5">
        <p className="text-xs text-muted-foreground uppercase tracking-wide">75%</p>
        <Progress value={75} />
      </div>
      <div className="space-y-1.5">
        <p className="text-xs text-muted-foreground uppercase tracking-wide">100%</p>
        <Progress value={100} />
      </div>
    </div>
  )
}
