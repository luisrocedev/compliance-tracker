# 📋 Compliance Tracker - Gestor Inteligente de Cumplimiento Normativo

![Version](https://img.shields.io/badge/version-1.0.0-blue.svg)
![PHP](https://img.shields.io/badge/PHP-8.1%2B-777BB4?logo=php)
![Laravel](https://img.shields.io/badge/Laravel-10.x-FF2D20?logo=laravel)
![License](https://img.shields.io/badge/license-MIT-green.svg)

Compliance Tracker es un sistema integral para la gestión y seguimiento de cumplimiento normativo, diseñado para PYMEs que necesitan mantener control sobre licencias, certificados, auditorías y documentación regulatoria.

## 🚀 Estado actual del software

-   Gestión de normativas, documentos y alertas con CRUD completo
-   Auditoría de acciones y trazabilidad
-   Dashboard ejecutivo con KPIs y vencimientos
-   Filtros avanzados y búsqueda rápida
-   Gestión de responsables y roles
-   UI/UX moderno, minimalista y empresarial (Tailwind CSS)
-   Autenticación, roles y permisos
-   Reportes básicos y exportación

## 🛣️ Evolución esperada

-   Integración con Slack y WhatsApp Business
-   App móvil (PWA)
-   API REST completa
-   Firma digital de documentos
-   Inteligencia artificial para predicción de renovaciones
-   Reportes avanzados y analíticas

## ✨ Características principales

-   📅 Calendario inteligente de vencimientos
-   📄 Gestión documental centralizada y versionado
-   🔔 Alertas automáticas y personalizables
-   📊 Reportes y dashboard ejecutivo
-   👥 Gestión de responsables y tareas

## 🛠️ Instalación rápida

```bash
git clone https://github.com/luisrocedev/compliance-tracker.git
cd compliance-tracker
composer install
cp .env.example .env
php artisan key:generate
# Configura tu .env y ejecuta:

php artisan migrate --seed
php artisan storage:link
php artisan serve
```

### 🧪 Datos de prueba/demo

Para poblar el sistema con datos de ejemplo y ver el dashboard y las predicciones IA funcionando:

```bash
php artisan db:seed
```

Esto creará normativas, documentos y un usuario demo.

**Acceso demo:**

-   Usuario: `demo@demo.com`
-   Contraseña: `demo1234`

Cuando quieras limpiar los datos demo antes de entregar o vender el software, ejecuta:

```bash
php artisan demo:clean
```

Esto eliminará todos los datos de prueba (usuario demo, normativas y documentos demo) de forma segura.

Accede a: `http://localhost:8000`

## 📖 Documentación y detalles

Consulta el archivo `readme_principal_proyecto.md` para una descripción completa de funcionalidades, requisitos, estructura y roadmap.

## 📝 Licencia

MIT

---

**Desarrollado con ❤️ para mejorar el cumplimiento normativo en PYMEs.**
