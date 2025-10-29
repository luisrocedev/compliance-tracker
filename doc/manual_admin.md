# Manual de administración y despliegue (borrador)

## Instalación

-   Seguir pasos de `README.md` y `readme_principal_proyecto.md`.
-   Configurar `.env` y base de datos.
-   Ejecutar migraciones y seeders.

## Mantenimiento

-   Ejecutar `php artisan migrate` y `php artisan db:seed` para actualizar datos.
-   Revisar logs en `storage/logs/`.
-   Realizar backups periódicos de la base de datos y archivos.

## Despliegue

-   Usar `php artisan config:cache`, `route:cache`, `view:cache` para optimizar.
-   Configurar permisos de carpetas `storage` y `bootstrap/cache`.
-   (Opcional) Desplegar con Docker o en servidor Linux siguiendo la guía.

---

_Ampliar este manual según necesidades de producción._
