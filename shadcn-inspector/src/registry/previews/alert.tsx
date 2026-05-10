import { Alert, AlertDescription, AlertTitle } from '@/components/ui/alert'
import { Terminal, CircleCheck, TriangleAlert, Info } from 'lucide-react'

export const code = `import { Alert, AlertDescription, AlertTitle } from "@/components/ui/alert"
import { Terminal } from "lucide-react"

<Alert>
  <Terminal className="size-4" />
  <AlertTitle>Heads up!</AlertTitle>
  <AlertDescription>
    You can add components to your app using the cli.
  </AlertDescription>
</Alert>

<Alert variant="destructive">
  <AlertTitle>Error</AlertTitle>
  <AlertDescription>Something went wrong.</AlertDescription>
</Alert>`

export function Preview() {
  return (
    <div className="space-y-4 max-w-lg">
      <Alert>
        <Terminal className="size-4" />
        <AlertTitle>Default</AlertTitle>
        <AlertDescription>Podés agregar componentes usando la CLI.</AlertDescription>
      </Alert>

      <Alert variant="destructive">
        <TriangleAlert className="size-4" />
        <AlertTitle>Error</AlertTitle>
        <AlertDescription>Algo salió mal. Intentá de nuevo.</AlertDescription>
      </Alert>

      {/* Custom states usando clases — base para los tokens del sistema */}
      <Alert className="border-green-500/50 text-green-700 dark:text-green-400 [&>svg]:text-green-600">
        <CircleCheck className="size-4" />
        <AlertTitle>Éxito</AlertTitle>
        <AlertDescription>La operación se completó correctamente.</AlertDescription>
      </Alert>

      <Alert className="border-yellow-500/50 text-yellow-700 dark:text-yellow-400 [&>svg]:text-yellow-600">
        <TriangleAlert className="size-4" />
        <AlertTitle>Advertencia</AlertTitle>
        <AlertDescription>Revisá esta información antes de continuar.</AlertDescription>
      </Alert>

      <Alert className="border-blue-500/50 text-blue-700 dark:text-blue-400 [&>svg]:text-blue-600">
        <Info className="size-4" />
        <AlertTitle>Información</AlertTitle>
        <AlertDescription>Este dato puede ser relevante para vos.</AlertDescription>
      </Alert>
    </div>
  )
}
