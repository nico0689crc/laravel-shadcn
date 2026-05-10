import { Suspense, lazy, useEffect, useState } from 'react'
import { useParams, Link } from 'react-router-dom'
import { ArrowLeft, ExternalLink } from 'lucide-react'
import { getByName } from '@/registry'
import { PREVIEWS } from '@/registry/previews'
import { CodeViewer } from '@/components/inspector/CodeViewer'
import { Tabs, TabsContent, TabsList, TabsTrigger } from '@/components/ui/tabs'
import { Skeleton } from '@/components/ui/skeleton'
import { Badge } from '@/components/ui/badge'
import type { ComponentType } from 'react'

export function ComponentPage() {
  const { name } = useParams<{ name: string }>()
  const meta = name ? getByName(name) : undefined
  const [PreviewComp, setPreviewComp] = useState<ComponentType | null>(null)
  const [code, setCode] = useState('')
  const [loading, setLoading] = useState(true)

  useEffect(() => {
    if (!name || !PREVIEWS[name]) return
    setLoading(true)
    setPreviewComp(null)
    PREVIEWS[name]().then(mod => {
      setPreviewComp(() => mod.Preview)
      setCode(mod.code)
      setLoading(false)
    })
  }, [name])

  if (!meta) {
    return (
      <div className="flex flex-col items-center justify-center h-full gap-3 text-muted-foreground">
        <p>Componente no encontrado.</p>
        <Link to="/" className="text-sm underline">← Volver al inicio</Link>
      </div>
    )
  }

  return (
    <div className="flex flex-col h-full">
      {/* Header */}
      <div className="px-8 py-5 border-b border-border flex items-center justify-between">
        <div className="flex items-center gap-3">
          <Link to="/" className="text-muted-foreground hover:text-foreground transition-colors">
            <ArrowLeft className="size-4" />
          </Link>
          <div>
            <div className="flex items-center gap-2">
              <h1 className="text-lg font-semibold">{meta.title}</h1>
              <Badge variant="secondary" className="text-xs capitalize">{meta.category}</Badge>
            </div>
            <p className="text-sm text-muted-foreground">{meta.description}</p>
          </div>
        </div>
        <a
          href={`https://ui.shadcn.com/docs/components/${meta.name}`}
          target="_blank"
          rel="noopener noreferrer"
          className="flex items-center gap-1.5 text-xs text-muted-foreground hover:text-foreground transition-colors"
        >
          <ExternalLink className="size-3" />
          Docs
        </a>
      </div>

      {/* Content */}
      <div className="flex-1 overflow-auto">
        <Tabs defaultValue="preview" className="h-full flex flex-col">
          <div className="px-8 pt-4 border-b border-border">
            <TabsList>
              <TabsTrigger value="preview">Preview</TabsTrigger>
              <TabsTrigger value="code">Código JSX</TabsTrigger>
              <TabsTrigger value="blade" disabled>Blade (próximamente)</TabsTrigger>
            </TabsList>
          </div>

          <TabsContent value="preview" className="flex-1 px-8 py-8 mt-0">
            {loading ? (
              <div className="space-y-4">
                <Skeleton className="h-10 w-48" />
                <Skeleton className="h-10 w-32" />
                <Skeleton className="h-10 w-40" />
              </div>
            ) : PreviewComp ? (
              <Suspense fallback={<Skeleton className="h-40 w-full" />}>
                <PreviewComp />
              </Suspense>
            ) : null}
          </TabsContent>

          <TabsContent value="code" className="px-8 py-8 mt-0">
            {code ? (
              <CodeViewer code={code} lang="tsx" />
            ) : (
              <Skeleton className="h-40 w-full" />
            )}
          </TabsContent>

          <TabsContent value="blade" className="px-8 py-8 mt-0">
            <div className="flex items-center justify-center h-32 rounded-lg border border-dashed border-border text-muted-foreground text-sm">
              El equivalente Blade se generará durante la Fase 3 del proyecto.
            </div>
          </TabsContent>
        </Tabs>
      </div>

      {/* Footer: blade file path */}
      <div className="px-8 py-3 border-t border-border bg-muted/30">
        <p className="text-xs text-muted-foreground font-mono">
          → Laravel: <span className="text-foreground">resources/views/{meta.bladeEquivalent}</span>
        </p>
      </div>
    </div>
  )
}
