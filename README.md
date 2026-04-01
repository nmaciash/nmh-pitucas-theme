# NMH Pitucas Theme

Tema WordPress personalizado para **Pitucas Moda** - Ecommerce de moda femenina.

## 📁 Estructura del Proyecto

```
nmh-pitucas-theme/
├── assets/
│   ├── css/
│   │   └── main.css          # Estilos principales
│   ├── js/
│   │   ├── main.js           # JavaScript principal (logo dinámico, sticky header)
│   │   └── pitucas-animations.js  # Animaciones GSAP
│   └── images/
│       ├── logo-black.png    # Logo para fondos claros
│       └── logo-white.png    # Logo para fondos oscuros
├── inc/
│   ├── acf-loader.php       # Configuración ACF
│   ├── acf-fields.php       # Definición de campos ACF (pestañas por secciones)
│   ├── elementor-cleaner.php # Silenciamiento de Elementor
│   └── env-loader.php        # Carga de variables de entorno
├── front-page.php            # Template de página de inicio
├── header.php                # Cabecera
├── footer.php                # Pie de página
├── index.php                 # Archivo base
├── functions.php            # Funciones del tema
├── style.css                # Cabecera WordPress
├── requirements.txt          # Dependencias Python
├── AGENTS.md               # Instrucciones para desarrollo
└── README.md               # Este archivo
```

## 🎨 Estándares de Código

| Regla | Descripción |
|-------|-------------|
| **CSS Inline** | PROHIBIDO. Todo CSS en archivos `.css` dedicados |
| **Rutas Absolutas** | Usar siempre `get_template_directory_uri()` |
| **Seguridad** | Sanitizar con `esc_html()`, `esc_attr()`, `esc_url()` |
| **Debug** | NO usar `console.log()`, `var_dump()` en producción |
| **jQuery** | Usar modo no-conflict: `jQuery(document).ready(function($) {...})` |

### GSAP

- Usar `transform` en lugar de propiedades de posición
- Animaciones con `toggleActions: 'play none none reverse'`
- Cargar solo en front-page cuando sea necesario

### WordPress

- Prefijo de funciones: `nmh_`
- NO asumir ACF Pro disponible
- Usar `wp_localize_script()` para pasar variables JS
- **Todo el contenido de las páginas debe ser editable mediante ACF Free**
- Usar pestañas horizontales (`placement => 'top'`) para organizar campos ACF por secciones

## ⚙️ Funcionalidades Implementadas

### 1. Carga de Assets (functions.php)

```php
// CSS principal: siempre se carga
wp_enqueue_style('nmh-main-style', ...)

// JavaScript principal: siempre se carga  
wp_enqueue_script('nmh-main-script', ...)

// Solo en front-page:
- Google Fonts (Inter + Cormorant Garamond)
- GSAP + ScrollTrigger
- Animaciones Pitucas
```

### 2. Logo Dinámico

- **ubicación:** `header.php` + `main.js`
- **funcionamiento:** Cambia entre `logo-black.png` y `logo-white.png` según la sección visible
- **secciones con logo blanco:** Hero, Lifestyle, Urban Elegance, Newsletter

### 3. Silenciamiento de Elementor (inc/elementor-cleaner.php)

```php
// Elimina estilos y scripts de Elementor cuando NO está en modo edición
wp_dequeue_style('elementor-global');
wp_dequeue_style('elementor-frontend');
wp_dequeue_script('elementor-frontend');
```

### 4. ACF (inc/acf-loader.php)

- Detecta si ACF está activo antes de usar funciones
- Control de visibilidad del admin vía variable de entorno `ACF_SHOW_ADMIN`

### 5. Entorno (inc/env-loader.php)

```php
nmh_load_env(); // Carga variables de .env
getenv('VARIABLE_NAME'); // Acceso a variables
```

## 🛠 Desarrollo

### SFTP Config (.vscode/sftp.json)

Carpetas ignoradas:
- `.vscode`, `.git`, `.DS_Store`
- `node_modules`, `venv`
- `_stubs`

### Git

Carpeta `.git/` ya configurada. No tracked: `_stubs/`

## 📋 Chequeo Pre-Deploy

Antes de subir al servidor, verificar:

- [ ] No hay CSS inline en archivos PHP/HTML
- [ ] No hay `console.log()` o `var_dump()` 
- [ ] Las imágenes del logo existen en `assets/images/`
- [ ] La carpeta `_stubs` no está en el servidor
- [ ] Los assets se cargan correctamente (verificar Network tab)

## 🔧 Comandos Útiles

```bash
# Buscar CSS inline
grep -r "style=" --include="*.php" --include="*.html"

# Buscar console.log
grep -r "console.log" --include="*.js"

# Ver estructura
ls -laR
```

## 📝 Notas

- **Fuente principal:** Inter (Google Fonts)
- **Fuente secundaria:** Cormorant Garamond (Google Fonts)
- **GSAP versión:** 3.12.5
- **jQuery:** 3.7.1 (via WordPress)
- **Colores del tema:**
  - Background: #FAF8F5
  - Primary: #2C2825
  - Secondary: #F0EBE3
  - Border: #E5DDD3

Todo el contenido de las páginas debe incorporarse mediante ACF Free en formato de pestañas horizontales:

1.  Crear `inc/acf-fields.php` con `acf_add_local_field_group()`
2.  Usar **pestañas horizontales** (`placement => 'top'`) para cada sección
3.  Incluir valores por defecto en todos los campos
4.  Usar función helper `nmh_get_acf_field('campo', 'valor_por_defecto')`
5.  **Footer**: Se gestiona exclusivamente desde la página **Footer**, usando la función helper `nmh_get_footer_field('campo', 'valor_por_defecto')`.

---

*Documentación actualizada: Marzo 2026*
