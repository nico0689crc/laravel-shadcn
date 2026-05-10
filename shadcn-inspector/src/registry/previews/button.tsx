import { Button } from '@/components/ui/button'
import { Mail, Loader2 } from 'lucide-react'

export const code = `import { Button } from "@/components/ui/button"

// Variantes
<Button variant="default">Default</Button>
<Button variant="secondary">Secondary</Button>
<Button variant="outline">Outline</Button>
<Button variant="ghost">Ghost</Button>
<Button variant="link">Link</Button>
<Button variant="destructive">Destructive</Button>

// Tamaños
<Button size="sm">Small</Button>
<Button size="default">Default</Button>
<Button size="lg">Large</Button>
<Button size="icon"><Mail /></Button>

// Estados
<Button disabled>Disabled</Button>
<Button disabled><Loader2 className="animate-spin" /> Loading</Button>`

export function Preview() {
  return (
    <div className="space-y-8">
      <Section label="Variantes">
        <Button variant="default">Default</Button>
        <Button variant="secondary">Secondary</Button>
        <Button variant="outline">Outline</Button>
        <Button variant="ghost">Ghost</Button>
        <Button variant="link">Link</Button>
        <Button variant="destructive">Destructive</Button>
      </Section>

      <Section label="Tamaños">
        <Button size="sm">Small</Button>
        <Button size="default">Default</Button>
        <Button size="lg">Large</Button>
        <Button size="icon"><Mail className="size-4" /></Button>
      </Section>

      <Section label="Con ícono">
        <Button><Mail className="size-4" /> Send email</Button>
        <Button variant="outline"><Mail className="size-4" /> Send email</Button>
      </Section>

      <Section label="Estados">
        <Button disabled>Disabled</Button>
        <Button disabled><Loader2 className="size-4 animate-spin" /> Loading</Button>
      </Section>
    </div>
  )
}

function Section({ label, children }: { label: string; children: React.ReactNode }) {
  return (
    <div className="space-y-2">
      <p className="text-xs font-medium text-muted-foreground uppercase tracking-wide">{label}</p>
      <div className="flex flex-wrap gap-3 items-center">{children}</div>
    </div>
  )
}
