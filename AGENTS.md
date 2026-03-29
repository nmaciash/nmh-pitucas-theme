# 🧠 AGENTS.md - NMH Pitucas Theme

Actúa como un Desarrollador Senior de WordPress. Este documento establece las reglas y estándares para trabajar en el proyecto **NMH Pitucas Theme** (Ecommerce de moda femenina).

---

## 📋 Reglas Generales

| Regla | Descripción |
|-------|-------------|
| **CSS Inline** | PROHIBIDO. Todo CSS en archivos `.css` dedicados |
| **JS Inline** | PROHIBIDO. Todo JS en archivos `.js` dedicados |
| **Prefijo Funciones** | Usar siempre `nmh_` |
| **Debug** | NO usar `console.log()`, `var_dump()` en producción |
| **Rutas** | Usar siempre `get_template_directory_uri()` |
| **Seguridad** | Sanitizar: `esc_html()`, `esc_attr()`, `esc_url()` |

---

## 📁 Estructura del Proyecto

```
nmh-pitucas-theme/
├── assets/
│   ├── css/main.css           # Estilos principales
│   ├── js/
│   │   ├── main.js           # JS principal (logo dinámico, sticky header)
│   │   └── pitucas-animations.js  # Animaciones GSAP
│   └── images/
│       ├── logo-black.png    # Logo para fondos claros
│       └── logo-white.png    # Logo para fondos oscuros
├── inc/
│   ├── acf-loader.php       # Configuración ACF
│   ├── elementor-cleaner.php # Silenciamiento Elementor
│   └── env-loader.php        # Carga de variables .env
├── front-page.php
├── header.php
├── footer.php
├── index.php
├── functions.php
├── style.css
├── README.md
└── AGENTS.md
```

---

## 🎨 CSS (assets/css/main.css)

- **PROHIBIDO** usar etiquetas `<style>` en archivos PHP/HTML
- **PROHIBIDO** atributos `style=""` inline
- Usar variables CSS para colores, fuentes, spacing
- Antes de añadir estilos nuevos, buscar en el archivo con `grep`

---

## 🔧 JavaScript

### jQuery
```javascript
jQuery(document).ready(function($) {
    // Tu código aquí
});
```

### GSAP
- Usar `transform` en lugar de propiedades de posición
- Animaciones scroll-trigger:
```javascript
toggleActions: 'play none none reverse'
```
- Cargar solo en front-page

### Variables JS
- Usar `wp_localize_script()` en `functions.php`
- NO hardcodear variables en JS

---

## ⚙️ WordPress

### functions.php
```php
// Carga assets
wp_enqueue_style('nmh-main-style', ...);
wp_enqueue_script('nmh-main-script', ...);

// Solo front-page
if (is_front_page()) {
    wp_enqueue_script('gsap', ...);
    wp_enqueue_script('pitucas-animations', ...);
}
```

### ACF - Contenido Dinámico
**IMPORTANTE:** Todo el contenido de las páginas debe ser editable mediante ACF Free.

#### Estructura de Campos ACF
Cada página (especialmente front-page.php) debe organizar sus campos en **pestañas horizontales (tabs)**, una por cada sección de la página. Esta organización permite al cliente editar todo el contenido de forma intuitiva.

#### Cómo crear campos ACF
1. **Archivo de definición:** Crear `inc/acf-fields.php` con la función `acf_add_local_field_group()`
2. **Usar tabs para organizar:** Cada pestaña representa una sección de la página
3. **Valores por defecto:** Siempre incluir valores por defecto para que el diseño no se rompa si no hay contenido

#### Ejemplo de estructura con pestañas
```php
acf_add_local_field_group(array(
    'key' => 'group_front_page',
    'title' => 'Contenido de Página de Inicio',
    'fields' => array(
        // Pestaña 1: Hero Section
        array(
            'key' => 'field_hero_tab',
            'label' => 'Hero Section',
            'name' => 'hero_tab',
            'type' => 'tab',
            'placement' => 'top',
        ),
        array(
            'key' => 'field_hero_image',
            'label' => 'Imagen Principal',
            'name' => 'hero_image',
            'type' => 'image',
            'return_format' => 'url',
        ),
        // ... más campos del hero
        
        // Pestaña 2: New In Section
        array(
            'key' => 'field_newin_tab',
            'label' => 'New In Section',
            'name' => 'newin_tab',
            'type' => 'tab',
            'placement' => 'top',
        ),
        // ... campos de New In
    ),
    'location' => array(
        array(
            array(
                'param' => 'page_type',
                'operator' => '==',
                'value' => 'front_page',
            ),
        ),
    ),
));
```

#### Obtener valores en el template
```php
// Usar la función helper del tema
$hero_image = nmh_get_acf_field('hero_image', get_template_directory_uri() . '/assets/images/default.jpg');
$hero_title = nmh_get_acf_field('hero_title', 'Título por defecto');
```

#### Reglas ACF
- **SIEMPRE** usar `placement => 'top'` en los tabs (pestañas horizontales)
- **NUNCA** usar vertical tabs (`placement => 'left'`)
- Incluir `return_format => 'url'` en campos de imagen
- Usar `default_value` en todos los campos de texto
- Verificar que ACF existe: `if (function_exists('acf'))`
- NO usar acf_add_local_field_group fuera de inc/acf-fields.php

#### Funciones helper disponibles
```php
// Obtener campo de la página actual o front page
nmh_get_acf_field('nombre_campo', 'valor_por_defecto');

// Ejemplo de uso en front-page.php
$hero_title = nmh_get_acf_field('hero_title', 'Título por defecto');
```

#### ACF Free vs Pro
- **Usar solo ACF Free:** No usar características de ACF Pro (repeater, flexible content, gallery)
- Si se necesita repetir contenido, crear campos individuales (ej: product_1, product_2)

### Elementor
- El archivo `inc/elementor-cleaner.php` silenciamos estilos cuando NO está en modo edición
- NO eliminar, mantener para rendimiento

---

## 🔍 Chequeo Pre-Deploy

Antes de subir al servidor, verificar:

```bash
# Buscar CSS inline
grep -r "style=" --include="*.php" --include="*.html"

# Buscar console.log
grep -r "console.log" --include="*.js"
```

- [ ] No hay CSS/JS inline
- [ ] No hay console.log() o var_dump()
- [ ] Logo images existen en assets/images/
- [ ] _stubs no está en el servidor
- [ ] Assets cargan correctamente

---

## 📝 Notas Importantes

- **Fuentes:** Inter (principal/sans) + Cormorant Garamond (secundaria/serif)
- **GSAP:** 3.12.5 via CDN
- **jQuery:** Version de WordPress
- **Colores del tema:**
  - Background: #FAF8F5
  - Primary: #2C2825
  - Secondary: #F0EBE3
  - Border: #E5DDD3

---

## 🚀 Workflow

1. **Analizar** estructura con `ls` y `grep`
2. **Planificar** cambios necesarios
3. **Ejecutar** modificaciones en archivos correspondientes
4. **Limpiar** código de prueba/comentado
5. **Verificar** con grep antes de finalizar

---

*Última actualización: Marzo 2026*
