# TECNICO.md — Especificación Técnica: CIFO Violeta Showcase

## 1. Arquitectura del Sistema

```
┌─────────────────────────────────────────────────┐
│                   CLIENTE                        │
│  HTML5 + CSS Custom + JS Vanilla (ES6+)         │
│  Blade Templates (SSR)                           │
└──────────────────┬──────────────────────────────┘
                   │ HTTP / HTTPS
┌──────────────────▼──────────────────────────────┐
│               SERVIDOR WEB                       │
│  Nginx / Apache + PHP-FPM                        │
├──────────────────┬──────────────────────────────┤
│           LARAVEL 13                             │
│  ┌────────────┐ ┌──────────┐ ┌───────────────┐  │
│  │ Routes     │ │ Middleware│ │ Controllers   │  │
│  └────────────┘ └──────────┘ └───────┬───────┘  │
│  ┌────────────┐ ┌──────────┐ ┌──────▼────────┐  │
│  │ Policies   │ │ Services │ │ Models (ORM)  │  │
│  └────────────┘ └──────────┘ └───────┬───────┘  │
└──────────────────────────────────────┤──────────┘
                                       │
┌──────────────────────────────────────▼──────────┐
│            BASE DE DATOS                         │
│  MySQL 8.x / MariaDB 10.6+                      │
└──────────────────────────────────────────────────┘
```

**Patrón:** MVC clásico de Laravel con capa de Services para lógica compleja.

---

## 2. Modelo de Datos (Entidades Principales)

### 2.1 Tabla `users`

### 2.2 Tabla `cycles` (Ciclos Formativos)

| Campo           | Tipo         | Notas                                |
|-----------------|--------------|--------------------------------------|
| id              | BIGINT PK    |                                      |
| name_ca         | VARCHAR(255) | Nombre en Catalán                    |
| name_es         | VARCHAR(255) | Nombre en Castellano                 |
| slug            | VARCHAR(255) | Unique, para URLs amigables          |
| description_ca  | TEXT         | Nullable                             |
| description_es  | TEXT         | Nullable                             |
| icon            | VARCHAR(255) | Nullable, ruta de icono              |
| created_at      | TIMESTAMP    |                                      |
| updated_at      | TIMESTAMP    |                                      |

### 2.3 Tabla `courses`

| Campo           | Tipo         | Notas                                |
|-----------------|--------------|--------------------------------------|
| id              | BIGINT PK    |                                      |
| cycle_id        | BIGINT FK    | → cycles.id                          |
| user_id         | BIGINT FK    | → users.id (role=teacher)            |
| name            | VARCHAR(255) |                                      |
| academic_year   | VARCHAR(9)   | Ej: "2025-2026"                      |
| created_at      | TIMESTAMP    |                                      |
| updated_at      | TIMESTAMP    |                                      |

### 2.4 Tabla `projects`

| Campo           | Tipo         | Notas                                |
|-----------------|--------------|--------------------------------------|
| id              | BIGINT PK    |                                      |
| course_id       | BIGINT FK    | → courses.id                         |
| user_id         | BIGINT FK    | → users.id (alumno autor)            |
| title_ca        | VARCHAR(255) |                                      |
| title_es        | VARCHAR(255) |                                      |
| description_ca  | TEXT         |                                      |
| description_es  | TEXT         |                                      |
| thumbnail       | VARCHAR(255) | Imagen principal (ruta)              |
| repo_url        | VARCHAR(512) | Nullable, enlace a repositorio       |
| live_url        | VARCHAR(512) | Nullable, enlace a demo              |
| status          | ENUM         | 'draft', 'pending', 'published', 'rejected' |
| featured        | BOOLEAN      | Default false, para destacar en home |
| published_at    | TIMESTAMP    | Nullable                             |
| created_at      | TIMESTAMP    |                                      |
| updated_at      | TIMESTAMP    |                                      |

### 2.5 Tabla `project_media`  Model: ProjectMedia

| Campo           | Tipo         | Notas                                |
|-----------------|--------------|--------------------------------------|
| id              | BIGINT PK    |                                      |
| project_id      | BIGINT FK    | → projects.id                        |
| type            | ENUM         | 'image', 'video', 'document', 'pdf'  |
| path            | VARCHAR(512) |                                      |
| alt_text        | VARCHAR(255) | Nullable, accesibilidad              |
| sort_order      | INT          | Orden de visualización               |

### Validar documentacion

https://laravel.com/docs/13.x/migrations#foreign-key-constraints

https://laravel.com/docs/13.x/eloquent#soft-deleting

// Ejemplo crear modelo con (migraciones, controller, seeder, factory,)
php artisan make:model Cycle -a

### 2.6 Tabla `tags` Model: Tag

| Campo           | Tipo         | Notas                                |
|-----------------|--------------|--------------------------------------|
| id              | BIGINT PK    |                                      |
| name            | VARCHAR(100) | Unique (ej: "Laravel", "React")      |
| slug            | VARCHAR(100) | Unique                               |

### 2.7 Tabla `project_tag` (pivote)

| Campo           | Tipo         |
|-----------------|--------------|
| project_id      | BIGINT FK    |
| tag_id          | BIGINT FK    |

**Índices compuestos:** `(project_id, tag_id)` UNIQUE.

---

## 3. Rutas (Estructura de URLs)

### 3.1 Rutas Públicas (`routes/web.php`)

```
GET  /                          → HomeController@index         (Galería principal)
GET  /projects/{slug}           → ProjectController@show       (Detalle de proyecto)
GET  /cycles                    → CycleController@index        (Listado de ciclos)
GET  /cycles/{slug}             → CycleController@show         (Proyectos de un ciclo)
GET  /about                     → PageController@about         (Acerca de)
GET  /login                     → Auth\LoginController@show
POST /login                     → Auth\LoginController@login
POST /logout                    → Auth\LoginController@logout
GET  /lang/{locale}             → LocaleController@switch      (Cambio de idioma)
```

### 3.2 Rutas API internas (filtrado AJAX)

```
GET  /api/projects              → Api\ProjectController@index  (JSON con filtros)
     ?cycle=&year=&teacher=&q=
```

### 3.3 Rutas Admin (`routes/admin.php`, prefijo `/admin`)

```
GET    /admin/dashboard                  → DashboardController@index
GET    /admin/projects                   → ProjectController@index
GET    /admin/projects/create            → ProjectController@create
POST   /admin/projects                   → ProjectController@store
GET    /admin/projects/{id}/edit         → ProjectController@edit
PUT    /admin/projects/{id}              → ProjectController@update
DELETE /admin/projects/{id}              → ProjectController@destroy
PATCH  /admin/projects/{id}/status       → ProjectController@updateStatus

GET    /admin/users                      → UserController@index
POST   /admin/users                      → UserController@store
PUT    /admin/users/{id}                 → UserController@update
DELETE /admin/users/{id}                 → UserController@destroy

GET    /admin/cycles                     → CycleController@index
POST   /admin/cycles                     → CycleController@store
PUT    /admin/cycles/{id}                → CycleController@update
DELETE /admin/cycles/{id}                → CycleController@destroy
```

---

## 4. Sistema de Diseño CSS

### 4.1 Variables CSS (tokens de diseño)

```css
:root {
  /* Paleta — Identidad CIFO La Violeta */
  --color-primary:       #6B3FA0;    /* Violeta principal */
  --color-primary-dark:  #4A2C6E;
  --color-primary-light: #9B7FCF;
  --color-accent:        #E8B84B;    /* Dorado accent */
  --color-bg:            #FAFAFA;
  --color-bg-card:       #FFFFFF;
  --color-text:          #1A1A2E;
  --color-text-muted:    #6C6C80;
  --color-border:        #E2E2E8;
  --color-success:       #2ECC71;
  --color-error:         #E74C3C;
  --color-warning:       #F39C12;

  /* Tipografía */
  --font-body:           'Inter', system-ui, sans-serif;
  --font-heading:        'Plus Jakarta Sans', var(--font-body);
  --font-mono:           'JetBrains Mono', monospace;

  /* Escala tipográfica (modular, ratio 1.25) */
  --text-xs:    0.75rem;
  --text-sm:    0.875rem;
  --text-base:  1rem;
  --text-lg:    1.25rem;
  --text-xl:    1.563rem;
  --text-2xl:   1.953rem;
  --text-3xl:   2.441rem;

  /* Espaciado (base 4px) */
  --space-1:  0.25rem;
  --space-2:  0.5rem;
  --space-3:  0.75rem;
  --space-4:  1rem;
  --space-6:  1.5rem;
  --space-8:  2rem;
  --space-12: 3rem;
  --space-16: 4rem;

  /* Layout */
  --max-width:     1280px;
  --border-radius: 8px;
  --shadow-sm:     0 1px 3px rgba(0,0,0,0.08);
  --shadow-md:     0 4px 12px rgba(0,0,0,0.1);
  --shadow-lg:     0 8px 24px rgba(0,0,0,0.12);

  /* Transiciones */
  --transition-fast:  150ms ease;
  --transition-base:  250ms ease;
}
```

### 4.2 Grid de galería (responsive, sin media queries donde sea posible)

```css
.gallery-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
  gap: var(--space-6);
  padding: var(--space-8) 0;
}
```

### 4.3 Componente tarjeta de proyecto

```css
.project-card {
  background: var(--color-bg-card);
  border-radius: var(--border-radius);
  box-shadow: var(--shadow-sm);
  overflow: hidden;
  transition: transform var(--transition-base), box-shadow var(--transition-base);
}
.project-card:hover {
  transform: translateY(-4px);
  box-shadow: var(--shadow-md);
}
```

---

## 5. Multilingüismo

### Estrategia Dual

1. **Interfaz estática:** Ficheros `lang/ca/*.php` y `lang/es/*.php` de Laravel. Se usa `__('key')` en Blade.
2. **Contenido dinámico:** Campos duplicados en BD (`title_ca`, `title_es`, `description_ca`, `description_es`). Un helper o accessor en el modelo selecciona el campo según `app()->getLocale()`.

### Helper sugerido

```php
// app/Helpers/locale.php
function localized(Model $model, string $field): string {
    $locale = app()->getLocale(); // 'ca' o 'es'
    $key = "{$field}_{$locale}";
    return $model->$key ?? $model->{"{$field}_es"} ?? '';
}
```

---

## 6. Autenticación y Autorización

- **Autenticación:** Laravel Breeze (login simple con sesión).
- **Autorización:** Policies de Laravel por modelo. Middleware `role:admin,teacher` en rutas admin.
- **Flujo de publicación:**
  1. Alumno crea proyecto → estado `draft`.
  2. Alumno envía a revisión → estado `pending`.
  3. Docente aprueba → `published` (se registra `published_at`).
  4. Docente rechaza → `rejected` (con feedback opcional).

---

## 7. Gestión de Archivos Multimedia

- **Disco:** `storage/app/public/projects/{project_id}/`
- **Tipos permitidos:** JPEG, PNG, WebP, PDF, MP4.
- **Límites:** 10 MB por imagen, 50 MB por vídeo, 20 MB por PDF.
- **Thumbnails:** Generados automáticamente con Intervention Image (400×300px, WebP).
- **Symlink:** `php artisan storage:link` para servir desde `/storage`.

---

## 8. Accesibilidad (WCAG 2.1 AA)

- HTML semántico: `<header>`, `<main>`, `<nav>`, `<article>`, `<footer>`.
- Alt text obligatorio en imágenes de proyecto.
- Contraste mínimo 4.5:1 en texto, 3:1 en elementos UI grandes.
- Navegación completa por teclado (focus visible, skip-to-content).
- Atributos ARIA donde sea necesario (menús, modales, alertas).
- Etiquetas `lang="ca"` / `lang="es"` en `<html>` según idioma activo.

---

## 9. Rendimiento

- **CSS:** Un solo archivo compilado, minificado. Sin frameworks = peso mínimo (~15-25 KB).
- **JS:** Módulos ES6 con carga diferida (`defer`). Sin bundler si es viable; Vite si crece.
- **Imágenes:** `loading="lazy"`, formato WebP preferente, `srcset` para responsive.
- **Caché:** HTTP cache headers + Laravel cache para queries frecuentes (proyectos destacados).
- **Objetivo:** Lighthouse ≥ 90 en Performance, Accessibility, SEO.

---

## 10. Testing

| Nivel        | Herramienta          | Cobertura objetivo                      |
|--------------|----------------------|-----------------------------------------|
| Unitario     | PHPUnit              | Models, Services, Helpers               |
| Feature      | PHPUnit + Laravel    | Controllers, Policies, flujo de estados |
| E2E (futuro) | Playwright / Cypress | Flujo completo de publicación           |

---

## 11. Despliegue

**Entorno recomendado:**
- VPS con Ubuntu 22.04+, Nginx, PHP 8.3-FPM, MySQL 8.x.
- Opción PaaS: Laravel Forge o Ploi para automatizar.
- CI/CD: GitHub Actions (lint + test + deploy).

**Variables de entorno críticas (.env):**
```
APP_NAME="CIFO Violeta Showcase"
APP_ENV=production
APP_LOCALE=ca
APP_FALLBACK_LOCALE=es
DB_CONNECTION=mysql
FILESYSTEM_DISK=public
```
