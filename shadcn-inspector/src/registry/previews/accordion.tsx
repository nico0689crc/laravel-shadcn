import { Accordion, AccordionContent, AccordionItem, AccordionTrigger } from '@/components/ui/accordion'

export const code = `import { Accordion, AccordionContent, AccordionItem, AccordionTrigger } from "@/components/ui/accordion"

<Accordion type="single" collapsible>
  <AccordionItem value="item-1">
    <AccordionTrigger>¿Es accesible?</AccordionTrigger>
    <AccordionContent>Sí, usa WAI-ARIA.</AccordionContent>
  </AccordionItem>
</Accordion>`

export function Preview() {
  return (
    <div className="max-w-md">
      <Accordion type="single" collapsible defaultValue="item-1">
        <AccordionItem value="item-1">
          <AccordionTrigger>¿Es accesible?</AccordionTrigger>
          <AccordionContent>Sí, cumple con los estándares WAI-ARIA para accesibilidad.</AccordionContent>
        </AccordionItem>
        <AccordionItem value="item-2">
          <AccordionTrigger>¿Es customizable?</AccordionTrigger>
          <AccordionContent>Sí, usando los tokens del design system podés cambiar colores, radios y tipografía.</AccordionContent>
        </AccordionItem>
        <AccordionItem value="item-3">
          <AccordionTrigger>¿Tiene animaciones?</AccordionTrigger>
          <AccordionContent>Sí, usa CSS animations con los tokens de duración y easing del sistema.</AccordionContent>
        </AccordionItem>
      </Accordion>
    </div>
  )
}
