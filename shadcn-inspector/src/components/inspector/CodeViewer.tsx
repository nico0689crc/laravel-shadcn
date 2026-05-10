import { useEffect, useState } from 'react'
import { createHighlighter, type Highlighter } from 'shiki'
import { Check, Copy } from 'lucide-react'
import { Button } from '@/components/ui/button'
import { useTheme } from '@/hooks/use-theme'

let highlighterPromise: Promise<Highlighter> | null = null

function getHighlighter() {
  if (!highlighterPromise) {
    highlighterPromise = createHighlighter({
      themes: ['github-light', 'github-dark'],
      langs: ['tsx', 'php', 'html', 'bash'],
    })
  }
  return highlighterPromise
}

interface CodeViewerProps {
  code: string
  lang?: 'tsx' | 'php' | 'html' | 'bash'
}

export function CodeViewer({ code, lang = 'tsx' }: CodeViewerProps) {
  const { theme } = useTheme()
  const [html, setHtml] = useState('')
  const [copied, setCopied] = useState(false)

  useEffect(() => {
    let cancelled = false
    getHighlighter().then(hl => {
      if (cancelled) return
      const result = hl.codeToHtml(code.trim(), {
        lang,
        theme: theme === 'dark' ? 'github-dark' : 'github-light',
      })
      setHtml(result)
    })
    return () => { cancelled = true }
  }, [code, lang, theme])

  const handleCopy = () => {
    navigator.clipboard.writeText(code.trim())
    setCopied(true)
    setTimeout(() => setCopied(false), 2000)
  }

  return (
    <div className="relative rounded-lg border border-border overflow-hidden text-sm">
      <Button
        variant="ghost"
        size="icon"
        onClick={handleCopy}
        className="absolute top-2 right-2 z-10 size-7"
        aria-label="Copy code"
      >
        {copied ? <Check className="size-3.5 text-green-500" /> : <Copy className="size-3.5" />}
      </Button>
      {html
        ? <div
            className="overflow-auto max-h-[500px] [&>pre]:p-4 [&>pre]:m-0 [&>pre]:h-full"
            dangerouslySetInnerHTML={{ __html: html }}
          />
        : <pre className="p-4 bg-muted text-muted-foreground overflow-auto max-h-[500px]">
            <code>{code.trim()}</code>
          </pre>
      }
    </div>
  )
}
