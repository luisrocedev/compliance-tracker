# 📋 Compliance Tracker - Gestor Inteligente de Cumplimiento Normativo

![Version](https://img.shields.io/badge/version-1.0.0-blue.svg)
![PHP](https://img.shields.io/badge/PHP-8.1%2B-777BB4?logo=php)
![Laravel](https://img.shields.io/badge/Laravel-10.x-FF2D20?logo=laravel)
![License](https://img.shields.io/badge/license-MIT-green.svg)

Sistema integral para la gestión y seguimiento de cumplimiento normativo diseñado específicamente para PYMEs que necesitan mantener control sobre licencias, certificados, auditorías y documentación regulatoria.

## 🎯 Problema que Resuelve

Las pequeñas y medianas empresas enfrentan múltiples desafíos relacionados con el cumplimiento normativo:

* ❌ **Falta de control centralizado** sobre fechas de vencimiento
* ❌ **Documentación dispersa** entre diferentes áreas
* ❌ **Multas costosas** por vencimientos olvidados
* ❌ **Auditorías desorganizadas** sin trazabilidad
* ❌ **Pérdida de tiempo** buscando documentos específicos

## ✨ Solución

Compliance Tracker centraliza y automatiza todo el proceso de gestión normativa:

### Características Principales

* 📅 **Calendario Inteligente de Vencimientos**
  * Visualización clara de todas las fechas críticas
  * Seguimiento de licencias, certificados y permisos
  * Estados: Vigente, Por Vencer, Vencido, En Renovación
* 📄 **Gestión Documental Centralizada**
  * Almacenamiento organizado por normativa y área
  * Versionado de documentos
  * Búsqueda rápida y filtros avanzados
* 🔔 **Sistema de Alertas Automáticas**
  * Notificaciones por email programables
  * Integración con WhatsApp Business API
  * Alertas escalonadas (30, 15, 7 días antes del vencimiento)
  * Recordatorios personalizables por tipo de normativa
* 📊 **Reportes y Analíticas**
  * Reportes por área (laboral, ambiental, seguridad, datos)
  * Dashboard ejecutivo con KPIs
  * Historial de cumplimiento
  * Exportación a PDF/Excel
* 👥 **Gestión de Responsables**
  * Asignación de encargados por normativa
  * Seguimiento de tareas y renovaciones
  * Sistema de permisos y roles

## 🎯 Valor Agregado

* 💰 **Evita multas** por incumplimientos
* ⏱️ **Ahorra tiempo** en gestión administrativa
* 📈 **Mejora la organización** documental
* ✅ **Facilita auditorías** con trazabilidad completa
* 🛡️ **Reduce riesgos** operativos y legales

## 🏢 Nicho de Mercado

Ideal para:

* 🏭 **Industrias manufactureras** (cumplimiento ambiental y seguridad)
* 🏗️ **Constructoras** (licencias de obra y seguridad laboral)
* 🏥 **Centros de salud** (habilitaciones sanitarias)
* 🍴 **Restaurantes y hoteles** (permisos sanitarios)
* 💼 **Empresas de servicios** (protección de datos, GDPR)
* 🚚 **Transportes y logística** (licencias vehiculares y operativas)

---

## 🚀 Tecnologías

### Backend

* **PHP 8.1+** - Lenguaje principal
* **Laravel 10.x** - Framework PHP (único framework utilizado)
* **MySQL 8.0+** - Base de datos
* **Redis** (opcional) - Cache y colas de trabajos

### Frontend

* **HTML5, CSS3, JavaScript Vanilla** - Sin frameworks frontend
* **Alpine.js** (opcional) - Interactividad ligera
* **Tailwind CSS** - Estilos (vía CDN o compilado)

### Integraciones

* **PHPMailer** - Envío de correos
* **Twilio API** - WhatsApp Business
* **DomPDF** - Generación de reportes PDF

## 📋 Requisitos del Sistema

```
PHP >= 8.1
Composer >= 2.0
MySQL >= 8.0 o MariaDB >= 10.3
Servidor web: Apache 2.4+ o Nginx 1.18+
Extensiones PHP: OpenSSL, PDO, Mbstring, Tokenizer, XML, Ctype, JSON, BCMath, Fileinfo
```

## 🛠️ Instalación

### 1. Clonar el repositorio

```bash
git clone https://github.com/tu-usuario/compliance-tracker.git
cd compliance-tracker
```

### 2. Instalar dependencias

```bash
composer install
```

### 3. Configurar entorno

```bash
cp .env.example .env
php artisan key:generate
```

### 4. Configurar base de datos

Editar `.env` con tus credenciales:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=compliance_tracker
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_password
```

### 5. Ejecutar migraciones

```bash
php artisan migrate --seed
```

### 6. Configurar almacenamiento

```bash
php artisan storage:link
```

### 7. Configurar notificaciones (opcional)

#### Email:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=tu-email@gmail.com
MAIL_PASSWORD=tu-password
MAIL_ENCRYPTION=tls
```

#### WhatsApp Business (Twilio):

```env
TWILIO_SID=tu_account_sid
TWILIO_TOKEN=tu_auth_token
TWILIO_WHATSAPP_FROM=whatsapp:+14155238886
```

### 8. Iniciar servidor de desarrollo

```bash
php artisan serve
```

Acceder a: `http://localhost:8000`

### 9. Configurar tareas programadas (producción)

Agregar al crontab:

```bash
* * * * * cd /ruta-del-proyecto && php artisan schedule:run >> /dev/null 2>&1
```

### 10. Iniciar workers para colas (producción)

```bash
php artisan queue:work --tries=3
```

## 📁 Estructura del Proyecto

```
compliance-tracker/
├── app/
│   ├── Console/
│   │   └── Commands/          # Comandos artisan personalizados
│   ├── Http/
│   │   ├── Controllers/       # Controladores
│   │   ├── Middleware/        # Middlewares
│   │   └── Requests/          # Form Requests
│   ├── Models/                # Modelos Eloquent
│   ├── Services/              # Lógica de negocio
│   └── Notifications/         # Notificaciones
├── database/
│   ├── migrations/            # Migraciones
│   └── seeders/               # Seeders
├── public/
│   ├── css/                   # Estilos
│   ├── js/                    # JavaScript
│   └── uploads/               # Archivos subidos
├── resources/
│   └── views/                 # Vistas Blade
├── routes/
│   └── web.php                # Rutas web
├── storage/
│   ├── app/                   # Almacenamiento de archivos
│   └── logs/                  # Logs
└── tests/                     # Tests
```

## 🔧 Configuración Inicial

### Crear usuario administrador

```bash
php artisan make:admin
```

### Cargar datos de ejemplo

```bash
php artisan db:seed --class=DemoDataSeeder
```

## 📖 Uso

### Dashboard Principal

Accede a `/dashboard` para ver:

* Resumen de normativas por estado
* Próximos vencimientos
* Alertas activas
* Estadísticas generales

### Gestionar Normativas

1. **Crear nueva normativa** : `Normativas > Nuevo`
2. **Configurar alertas** : Definir días de anticipación
3. **Asignar responsable** : Seleccionar usuario encargado
4. **Adjuntar documentos** : Subir certificados/licencias

### Configurar Notificaciones

1. Ir a `Configuración > Notificaciones`
2. Activar canales deseados (Email/WhatsApp)
3. Configurar plantillas personalizadas
4. Establecer frecuencia de envío

### Generar Reportes

1. `Reportes > Nuevo Reporte`
2. Seleccionar tipo (por área, por estado, histórico)
3. Definir rango de fechas
4. Exportar en formato deseado (PDF/Excel)

## 🔐 Seguridad

* ✅ Autenticación de usuarios con Laravel Sanctum
* ✅ Roles y permisos (Admin, Gestor, Visualizador)
* ✅ Protección CSRF en formularios
* ✅ Validación y sanitización de entradas
* ✅ Encriptación de datos sensibles
* ✅ Auditoría de acciones (logs)

## 🧪 Testing

Ejecutar tests:

```bash
php artisan test
```

Con cobertura:

```bash
php artisan test --coverage
```

## 📦 Deployment

### Producción (ejemplo con servidor Linux)

```bash
# Optimizar autoload
composer install --optimize-autoloader --no-dev

# Cachear configuración
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Configurar permisos
chmod -R 755 storage bootstrap/cache
```

### Docker (opcional)

```bash
docker-compose up -d
```

## 🤝 Contribuir

1. Fork el proyecto
2. Crea tu rama de características (`git checkout -b feature/AmazingFeature`)
3. Commit tus cambios (`git commit -m 'Add: nueva característica'`)
4. Push a la rama (`git push origin feature/AmazingFeature`)
5. Abre un Pull Request

## 📝 Roadmap

* [ ] v1.1: Integración con Slack
* [ ] v1.2: App móvil (PWA)
* [ ] v1.3: API REST completa
* [ ] v1.4: Firma digital de documentos
* [ ] v2.0: Inteligencia artificial para predicción de renovaciones

## 🐛 Reportar Bugs

Utiliza el [issue tracker](https://github.com/tu-usuario/compliance-tracker/issues) para reportar bugs.

## 📄 Licencia

Este proyecto está bajo la Licencia MIT - ver el archivo [LICENSE](https://claude.ai/chat/LICENSE) para más detalles.

## 👥 Autores

* **Tu Nombre** - *Desarrollo inicial* - [@tu-usuario](https://github.com/tu-usuario)

## 🙏 Agradecimientos

* Laravel Framework
* Comunidad PHP
* Todos los contribuidores

## 📞 Contacto

* Email: contacto@tuempresa.com
* Website: https://tuempresa.com
* LinkedIn: [Tu Perfil](https://linkedin.com/in/tu-perfil)

---

⭐ Si este proyecto te fue útil, considera darle una estrella en GitHub

**Desarrollado con ❤️ para mejorar el cumplimiento normativo en PYMEs**
