# Integraciones externas (estado y guía)

## Estado actual

-   [ ] Slack: pendiente
-   [ ] WhatsApp Business: pendiente
-   [x] API REST: implementada (CRUD normativas, documentos, alertas, usuarios)
-   [ ] PWA: pendiente
-   [ ] Firma digital: pendiente

---

## API REST - Documentación básica

### Autenticación

La API está protegida con Laravel Sanctum. Para obtener un token:

1. Realiza un POST a `/api/login` con email y password válidos.
2. Usa el token devuelto en el header `Authorization: Bearer {token}` para todas las peticiones.

### Endpoints principales

Todos los endpoints requieren autenticación (`auth:sanctum`).

#### Normativas

-   `GET /api/normativas` — Listar (paginado, filtros: estado, área)
-   `POST /api/normativas` — Crear
-   `GET /api/normativas/{id}` — Ver detalle
-   `PUT/PATCH /api/normativas/{id}` — Actualizar
-   `DELETE /api/normativas/{id}` — Eliminar

#### Documentos

-   `GET /api/documentos` — Listar (paginado, filtro: normativa_id)
-   `POST /api/documentos` — Crear
-   `GET /api/documentos/{id}` — Ver detalle
-   `PUT/PATCH /api/documentos/{id}` — Actualizar
-   `DELETE /api/documentos/{id}` — Eliminar

#### Alertas

-   `GET /api/alertas` — Listar (paginado, filtro: normativa_id)
-   `POST /api/alertas` — Crear
-   `GET /api/alertas/{id}` — Ver detalle
-   `PUT/PATCH /api/alertas/{id}` — Actualizar
-   `DELETE /api/alertas/{id}` — Eliminar

#### Usuarios

-   `GET /api/usuarios` — Listar (paginado, filtro: role)
-   `POST /api/usuarios` — Crear
-   `GET /api/usuarios/{id}` — Ver detalle
-   `PUT/PATCH /api/usuarios/{id}` — Actualizar
-   `DELETE /api/usuarios/{id}` — Eliminar

### Ejemplo de request autenticado

```bash
curl -H "Authorization: Bearer {token}" https://localhost/api/normativas
```

### Respuesta de ejemplo (GET /api/normativas)

```json
{
	"current_page": 1,
	"data": [
		{
			"id": 1,
			"nombre": "Normativa X",
			"tipo": "Laboral",
			"area": "RRHH",
			"fecha_emision": "2024-01-01",
			"fecha_vencimiento": "2025-01-01",
			"estado": "Vigente",
			"entidad_emisora": "Ministerio de Trabajo",
			"responsable_id": 2,
			"notas": null,
			...
		}
	],
	"first_page_url": "http://localhost/api/normativas?page=1",
	"from": 1,
	"last_page": 1,
	"last_page_url": "http://localhost/api/normativas?page=1",
	"next_page_url": null,
	"path": "http://localhost/api/normativas",
	"per_page": 15,
	"prev_page_url": null,
	"to": 1,
	"total": 1
}
```

---

_Actualizar este archivo conforme se avance en cada integración._

---

_Actualizar este archivo conforme se avance en cada integración._
