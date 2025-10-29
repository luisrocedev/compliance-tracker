# Guía de Documentación y Estado del Proyecto

## 1. Introducción

Este documento organiza y resume la documentación existente del proyecto Compliance Tracker, compara el estado actual del software con la guía de avance definida en `readme_principal_proyecto.md` y establece recomendaciones para la documentación y el desarrollo futuro.

## 2. Documentos existentes

-   `README.md`: Resumen general, instalación rápida, acceso demo, características principales y roadmap.
-   `readme_principal_proyecto.md`: Guía principal de requisitos, funcionalidades, estructura, instalación detallada, uso, seguridad, testing y despliegue.
-   `RESUMEN_FINAL.md`: Estado funcional al cierre del 28/10/2025, módulos implementados, pendientes y observaciones.

## 3. Estado actual vs. guía de avance

### Estado actual (al 29/10/2025)

-   Lógica principal y módulos CRUD de normativas, documentos, alertas y auditoría: **completos y funcionales**.
-   Autenticación, roles y control de acceso: **implementados**.
-   Navegación y vistas principales: **operativas**.
-   Auditoría y trazabilidad: **implementadas**.
-   Seeders y migraciones: **funcionando**.
-   Reportes básicos y exportación: **inicial**.
-   API REST: **implementada y documentada**.
-   Lógica IA eliminada/desactivada para máxima velocidad.

### Pendientes respecto a la guía de avance (`readme_principal_proyecto.md`)

-   Mejoras visuales avanzadas (responsive, branding, UI/UX superior).
-   Integraciones externas (Slack, WhatsApp, API REST, PWA, firma digital).
-   Reportes avanzados y analíticas.
-   Pruebas unitarias/funcionales y cobertura.
-   Documentación de usuario y manuales.
-   Automatización de tareas programadas y workers en producción.
-   Dockerización (opcional).

## 4. Organización recomendada de la documentación

Colocar en la carpeta `/doc`:

-   `guia_avance.md`: Resumen de funcionalidades implementadas vs. planificadas, checklist de avance y próximos pasos.
-   `manual_usuario.md`: Guía para usuarios finales (pendiente de desarrollo).
-   `manual_admin.md`: Guía para administradores y despliegue (pendiente de desarrollo).
-   `integraciones.md`: Estado y guía de integraciones externas (pendiente de desarrollo).
-   `roadmap.md`: Roadmap actualizado y sugerencias de evolución.

## 5. Próximos pasos sugeridos

1. Mantener actualizado el checklist de avance en `guia_avance.md`.
2. Desarrollar documentación de usuario y administración.
3. Priorizar mejoras visuales y reportes avanzados.
4. Planificar y documentar integraciones externas.
5. Añadir ejemplos de uso y casos de prueba en la documentación.

---

_Este archivo debe ser el punto de partida para cualquier consulta sobre el estado y la documentación del proyecto._
