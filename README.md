# Tarea 10 — API RESTful de Gestión de Menú (La Buena Mesa)

API RESTful desarrollada con **Laravel 12** y **Eloquent ORM** para centralizar la gestión del menú del restaurante "La Buena Mesa". Permite operaciones CRUD completas sobre los elementos del menú, además de filtrado por categoría.


## 🧱 Stack Técnico

- Laravel 12
- PHP 8.3 (PHP-FPM)
- MySQL 8.0
- Nginx
- Docker / Docker Compose
- phpMyAdmin (administración visual de la base de datos)

## 📁 Estructura del Proyecto

```
tarea10-restaurant-api/
├── docker-compose.yml          # Orquestación de los 4 contenedores
├── docker/
│   ├── php/
│   │   └── Dockerfile          # Imagen personalizada PHP-FPM 8.3
│   └── nginx/
│       └── default.conf        # Configuración del servidor web
└── src/                        # Proyecto Laravel
    ├── app/
    │   ├── Http/
    │   │   ├── Controllers/Api/MenuItemController.php
    │   │   └── Requests/
    │   │       ├── StoreMenuItemRequest.php
    │   │       └── UpdateMenuItemRequest.php
    │   └── Models/MenuItem.php
    ├── database/
    │   ├── migrations/...create_menu_items_table.php
    │   └── seeders/MenuItemSeeder.php
    └── routes/api.php
```

## 🚀 Instalación

### Requisitos previos
- Docker y Docker Compose instalados

### Pasos

1. Clonar el repositorio:
   ```bash
   git clone <url-del-repositorio>
   cd tarea10-restaurant-api
   ```

2. Levantar los contenedores:
   ```bash
   docker compose up -d --build
   ```

3. Instalar dependencias de Composer (si `vendor/` no viene incluido):
   ```bash
   docker compose exec app composer install
   ```

4. Copiar el archivo de entorno y generar la clave de aplicación:
   ```bash
   cp src/.env.example src/.env
   docker compose exec app php artisan key:generate
   ```

5. Ejecutar migraciones y poblar la base de datos:
   ```bash
   docker compose exec app php artisan migrate --seed
   ```

6. Verificar que la API responde:
   ```bash
   curl http://localhost:8010/api/menu-items
   ```

### Servicios expuestos

| Servicio    | URL                          |
|-------------|-------------------------------|
| API         | http://localhost:8010/api     |
| phpMyAdmin  | http://localhost:8081         |

## 📖 Documentación de Endpoints

Todas las peticiones que envían datos (`POST`, `PUT`, `PATCH`) deben incluir el header `Accept: application/json` para recibir respuestas JSON en vez de redirecciones.

| Método | Endpoint                              | Descripción                          |
|--------|----------------------------------------|---------------------------------------|
| GET    | `/api/menu-items`                     | Listar todos los elementos del menú   |
| GET    | `/api/menu-items/{id}`                | Obtener un elemento específico        |
| POST   | `/api/menu-items`                     | Crear un nuevo elemento               |
| PUT/PATCH | `/api/menu-items/{id}`             | Actualizar un elemento existente      |
| DELETE | `/api/menu-items/{id}`                | Eliminar un elemento                  |
| GET    | `/api/menu-items/category/{category}` | Filtrar elementos por categoría       |

### Esquema del recurso `menu_items`

| Campo         | Tipo             | Reglas                          |
|---------------|------------------|----------------------------------|
| `id`          | integer          | autogenerado                     |
| `name`        | string           | requerido, máx. 150 caracteres   |
| `description` | text             | opcional                         |
| `price`       | decimal(8,2)     | requerido, numérico, mínimo 0    |
| `category`    | string           | requerido, máx. 50 caracteres    |
| `available`   | boolean          | opcional, por defecto `true`     |
| `created_at`  | timestamp        | autogenerado                     |
| `updated_at`  | timestamp        | autogenerado                     |

## 🧪 Ejemplos de Uso

### Listar todos los elementos
```bash
curl -s http://localhost:8010/api/menu-items
```

### Obtener un elemento específico
```bash
curl -s http://localhost:8010/api/menu-items/1
```

### Crear un nuevo elemento
```bash
curl -s -X POST http://localhost:8010/api/menu-items \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -d '{
        "name": "Tiradito de Pulpo",
        "description": "Finas láminas de pulpo en salsa de ají amarillo",
        "price": 12.50,
        "category": "entradas",
        "available": true
      }'
```

**Respuesta (201 Created):**
```json
{
  "id": 10,
  "name": "Tiradito de Pulpo",
  "description": "Finas láminas de pulpo en salsa de ají amarillo",
  "price": "12.50",
  "category": "entradas",
  "available": true,
  "created_at": "2026-08-18T12:00:00.000000Z",
  "updated_at": "2026-08-18T12:00:00.000000Z"
}
```

### Actualizar parcialmente (disponibilidad)
```bash
curl -s -X PATCH http://localhost:8010/api/menu-items/10 \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -d '{"available": false}'
```

### Filtrar por categoría
```bash
curl -s http://localhost:8010/api/menu-items/category/postres
```

### Eliminar un elemento
```bash
curl -s -X DELETE http://localhost:8010/api/menu-items/10
```
**Respuesta:** `204 No Content`

### Códigos de estado utilizados

| Código | Significado                                  |
|--------|------------------------------------------------|
| 200    | Operación exitosa (GET, PUT/PATCH)             |
| 201    | Elemento creado exitosamente (POST)            |
| 204    | Elemento eliminado exitosamente (DELETE)       |
| 404    | Elemento no encontrado                          |
| 422    | Error de validación                             |
