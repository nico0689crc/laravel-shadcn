import { Input } from '@/components/ui/input'
import { Label } from '@/components/ui/label'

export const code = `import { Input } from "@/components/ui/input"
import { Label } from "@/components/ui/label"

// Default
<div className="grid gap-2">
  <Label htmlFor="email">Email</Label>
  <Input id="email" type="email" placeholder="nombre@ejemplo.com" />
</div>

// Disabled
<Input disabled placeholder="Disabled" />

// Con error
<Input aria-invalid className="border-destructive" placeholder="Email inválido" />`

export function Preview() {
  return (
    <div className="space-y-8 max-w-sm">
      <Section label="Default">
        <div className="grid gap-2 w-full">
          <Label htmlFor="email">Email</Label>
          <Input id="email" type="email" placeholder="nombre@ejemplo.com" />
        </div>
      </Section>

      <Section label="Tipos">
        <div className="grid gap-3 w-full">
          <Input type="text" placeholder="Text" />
          <Input type="password" placeholder="Password" />
          <Input type="number" placeholder="Number" />
          <Input type="search" placeholder="Search..." />
        </div>
      </Section>

      <Section label="Estados">
        <div className="grid gap-3 w-full">
          <Input disabled placeholder="Disabled" />
          <Input aria-invalid="true" className="border-destructive ring-destructive" placeholder="Error state" />
        </div>
      </Section>
    </div>
  )
}

function Section({ label, children }: { label: string; children: React.ReactNode }) {
  return (
    <div className="space-y-2 w-full">
      <p className="text-xs font-medium text-muted-foreground uppercase tracking-wide">{label}</p>
      {children}
    </div>
  )
}
