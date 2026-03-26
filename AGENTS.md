# 🧠 TASK: WordPress Theme Scaffolding – CustomBuilder Core Standard

Actúa como un Desarrollador Senior de WordPress y Arquitecto de Sistemas. Tu objetivo es generar la estructura base de un tema WordPress profesional llamado "NMH Pitucas Theme", siguiendo estándares modernos, optimizado para ACF, preparado para automatización con Python, y alineado con un sistema escalable tipo "Core Standard".

## 1. ESPECIFICACIONES GENERALES

- **Nombre del tema:** NMH Pitucas Theme
- **Prefijo obligatorio de funciones:** `nmh_`
- **Arquitectura:** Modular, escalable y desacoplada
- **Seguridad (obligatoria en outputs):**
  - `esc_html()`
  - `esc_attr()`
  - `esc_url()`
  - `absint()`
- **Compatibilidad:**
  - ACF (Advanced Custom Fields)
  - Elementor (modo optimizado / silenciado)
  - Automatización externa con Python
- **Restricciones:**
  - NO modificar `.gitignore` ni `sftp.json`
  - Código limpio, comentado y profesional

## 2. ESTRUCTURA DE DIRECTORIOS

Crea (o simula) la siguiente estructura:

```
/assets/
    /css/
    /js/
    /img/
/inc/
```

## 3. ARCHIVOS BASE (GENERAR CONTENIDO COMPLETO)

### style.css
- Cabecera WordPress:
  - Theme Name: NMH Pitucas Theme
  - Description: Custom theme profesional optimizado para ACF y automatización
  - Author: (placeholder)
  - Version: 1.0.0

### index.php
- Archivo silencioso por seguridad (mínimo código)

### header.php
- HTML5 completo
- `wp_head()`
- Apertura de `<body>` con `body_class()`

### footer.php
- Cierre de estructura
- `wp_footer()`
- Área de créditos

### front-page.php
- Loop básico
- `get_header()` y `get_footer()`

## 4. FUNCTIONS.PHP (CORE DEL SISTEMA)

### Reglas obligatorias:

1. **Carga temprana de entorno:**
```php
require_once get_template_directory() . '/inc/env-loader.php';
nmh_load_env();
```

2. **Theme Support:**
   - `title-tag`
   - `post-thumbnails`
   - `html5`
   - `customize-selective-refresh-widgets`

3. **Registro de menús:**
   - Header
   - Footer

4. **Sistema automático de includes:**
   - Cargar todos los archivos dentro de `/inc/`

5. **Assets:**
   - Encolar `assets/css/main.css`
   - Encolar `assets/js/main.js`

## 5. SISTEMA DE ENTORNO (inc/env-loader.php)

- **Función:** `nmh_load_env()`
- Busca `.env` en la raíz del tema
- Parsea ignorando comentarios `#`
- Carga variables con:
  - `putenv()`
  - `$_ENV`
- Si no existe → fallo silencioso

## 6. PIPELINE DE ASSETS (inc/enqueue.php)

### Crear archivos físicos:
- `/assets/css/main.css`
- `/assets/js/main.js`
- `/assets/js/animations.js`

### Requisitos:
- Encolar `style.css`
- Encolar GSAP + ScrollTrigger (CDN Cloudflare)
- **Dependencias:**
  - `animations.js` → `gsap`
  - `main.js` → `jquery`, `gsap`
- Versionado con `filemtime`
- Usar `get_template_directory_uri()`

## 7. SISTEMA ACF AVANZADO (inc/acf-loader.php)

- Detectar si ACF está activo
- Preparar estructura para:
  - Registro de Field Groups vía PHP
  - Carga de JSON local (opcional)

### Control de visibilidad del admin:

```php
getenv('ACF_SHOW_ADMIN')
```

- `'true'` → mostrar UI
- `'false'` o no definido → ocultar UI

### Extra:
- Preparar función para registrar "Slots" dinámicos de contenido

## 8. OPTIMIZACIÓN ELEMENTOR (inc/elementor-cleaner.php)

- Detectar si la página NO está editada con Elementor
- Si no lo está:
  - `wp_dequeue_style`
  - `wp_dequeue_script`
- **Eliminar:**
  - Estilos globales
  - Google Fonts por defecto

## 9. ENTORNO PYTHON

### requirements.txt

Incluir:

```txt
requests
python-dotenv
pandas
```

## 10. REGLAS DE EJECUCIÓN

1. Generar primero el árbol de directorios visual
2. Crear los archivos en orden de dependencias
3. Mostrar cada archivo en bloques de código con su ruta
4. No omitir ningún archivo
5. No añadir tareas extra

## 11. FINALIZACIÓN

Al terminar, detener ejecución y mostrar exactamente:

```
Estructura CORE completada con Gestión de Secretos. Listo para el primer commit
```