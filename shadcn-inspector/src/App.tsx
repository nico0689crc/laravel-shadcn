import { BrowserRouter, Routes, Route } from 'react-router-dom'
import { TooltipProvider } from '@/components/ui/tooltip'
import { Sidebar } from '@/components/inspector/Sidebar'
import { ThemeToggle } from '@/components/inspector/ThemeToggle'
import { HomePage } from '@/pages/HomePage'
import { ComponentPage } from '@/pages/ComponentPage'

export default function App() {
  return (
    <BrowserRouter>
      <TooltipProvider>
        <div className="flex h-screen bg-background text-foreground overflow-hidden">
          <Sidebar />

          <div className="flex flex-col flex-1 overflow-hidden">
            <header className="h-12 px-4 flex items-center justify-between border-b border-border shrink-0 bg-background">
              <span className="text-xs text-muted-foreground">
                shadcn/ui → Laravel Blade Design System
              </span>
              <ThemeToggle />
            </header>

            <main className="flex-1 overflow-auto">
              <Routes>
                <Route path="/" element={<HomePage />} />
                <Route path="/components/:name" element={<ComponentPage />} />
              </Routes>
            </main>
          </div>
        </div>
      </TooltipProvider>
    </BrowserRouter>
  )
}
