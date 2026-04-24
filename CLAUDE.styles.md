# CLAUDE.styles.md — Validación CSS/JS front

## Fase 1 — Checklist de trabajo
- [x] Crear CLAUDE.styles.md
- [x] Diagnosticar project-detail.js (no importado)
- [x] Diagnosticar pagination.css (selectores desalineados con blade)
- [x] Verificar archivos sin uso (ninguno eliminado)

## Fase 2 — Fix app.js
- [x] Añadir `import './front/project-detail'` en `resources/js/app.js`

## Fase 3 — Fix pagination.css
- [x] Reescribir selectores para alinear con clases blade (`pagination-link`, `pagination-item.active`, etc.)

## Fase 4 — Actualizar CLAUDE.front.md
- [x] Eliminar dump de variables.css (referencia al archivo)
- [x] Trimear sección "Cuándo usar Alpine.js" a 2 líneas
- [x] Añadir `project-detail.js` a la estructura JS
- [x] Eliminar secciones Accesibilidad e i18n (cubiertas en CLAUDE.md)

## Fase 5 — Actualizar CLAUDE.admin.md
- [x] Eliminar tabla icofont (derivable del código)
- [x] Compactar ejemplos Alpine/Precognition

## Fase 6 — Actualizar CLAUDE.md raíz
- [x] Limpieza menor de texto redundante

## Verificación final
- [x] `npm run build` sin errores (580 módulos, 614ms)
- [ ] Carousel funciona en `/projects/{slug}` — verificar en browser
- [ ] Paginador con estilos correctos en `/projects` — verificar en browser
