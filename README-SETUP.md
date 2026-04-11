# Project Setup: Vite + Tailwind CSS 4 + JS + PHP en WordPress

Este documento explica la arquitectura del tema y cómo funcionan en conjunto **Vite**, **Tailwind CSS v4**, **SCSS**, **JavaScript** y **PHP**. Puede ser utilizado como guía para replicar el mismo entorno en futuros proyectos de WordPress.

## 1. Arquitectura General

El flujo de trabajo moderno se centra en Vite como herramienta de front-end, eliminando el agrupamiento (bundling) pesado durante el desarrollo y generando archivos estáticos livianos para la producción.

*   **Vite:** Herramienta de compilación dev-server y minificación.
*   **Tailwind 4:** Motor principal de CSS. En lugar de un gran archivo de configuración de JavaScript, Tailwind 4 permite configurarlo todo a través de directivas CSS (como `@theme` y `@source`). Se integra a través de un plugin oficial para Vite (`@tailwindcss/vite`).
*   **SCSS:** Se procesa a través de Vite usando `sass-embedded` y permite usar mixins o variables avanzadas cuando la utilidad de Tailwind no es suficiente (componentes muy específicos).
*   **JS:** Módulos en ES6 procesados por Vite.
*   **PHP:** WordPress carga dinámicamente los "entrypoints" dependiendo del entorno (Desarrollo vs Producción).

## 2. Archivos y Configuración Clave

### A. `package.json`
Define las herramientas. Observamos que `type: "module"` está activo, y los scripts fundamentales son:
- `npm run dev`: Inicia el servidor de desarrollo en la URL `localhost:5173`.
- `npm run build`: Compila los archivos (CSS, JS y otros assets) y los guarda en `assets/dist`.

### B. `vite.config.js`
Es el núcleo de la compilación frontend. Puntos fuertes:
- **Múltiples Inputs:** Tiene tres entradas declaradas en `build.rollupOptions.input`:
    - `main`: `assets/src/css/main.css` (Tailwind)
    - `custom`: `assets/src/scss/main.scss` (Estilos SCSS)
    - `script`: `assets/src/js/main.js` (JavaScript principal)
- **Manifest:** Tiene habilitado `build.manifest = true`. Esto genera `assets/dist/.vite/manifest.json`, que es vital para la fase de producción, ya que allí PHP mapea los archivos compilados que llevan hash (ej. `assets/dist/main-AB33D.js`).
- **PHP Watcher & HMR:** Contiene un plugin personalizado (`name: 'php-watch'`) que supervisa cambios en archivos `**/*.php`. Si un PHP muta:
    1. Fuerza un escaneo (invalidando el cache local de CSS) para que Tailwind 4 analice las nuevas clases del archivo modificado basándose en el `@source`.
    2. Dispara un `server.ws.send({ type: 'full-reload' })` para que refrescar el navegador del usuario en vivo sin necesidad de F5 manual.

### C. Configuración de Tailwind (`assets/src/css/main.css`)
Con Tailwind 4 se usa la **CSS-first API**:
- Se importa base: `@import "tailwindcss";`
- Se establecen las rutas de escaneo para purgar clases CSS y detectarlas con:
    ```css
    @source "../../../**/*.php";
    @source "../scss/**/*.scss";
    ```
- El objeto de tema (`colors`, `fonts`, `spacing`) se configura dentro del bloque `@theme { ... }`. 

### D. Encolado Dinámico con PHP (`inc/enqueue.php`)
Las lógicas del backend para cargar los archivos estáticos según el entorno:
- **Desarrollo (`if ($is_dev)` o `WP_DEBUG === true`)**:
  Carga los scripts forzando sus URLs absolutas hacia el dev server de Vite (ej. `http://localhost:5173/assets/src/js/main.js`). Esto permite el Hot Module Replacement (HMR).
- **Producción (`else`)**:
  Lee el archivo generado por la build de Vite (`.vite/manifest.json`). Resuelve el nombre hasheado de cada recurso y lo inyecta con `wp_enqueue_script` y `wp_enqueue_style`.
- Un filtro asegura inyectar `type="module" crossorigin` a los archivos procesados por Vite usando el hook `script_loader_tag` para permitir imports a nivel cliente y el HMR.

---

## 3. Guía paso a paso para Replicar el Setup en otro Proyecto

Si necesitas configurar otro tema con exactamente el mismo stack, sigue estos pasos:

### Paso 1: Inicializar el paquete y dependencias
En la carpeta raíz del nuevo tema:
```bash
npm init -y
npm install -D vite tailwindcss @tailwindcss/vite sass-embedded
```
(Puedes añadir utilidades u otros paquetes como `swiper`). Asegurate de agregar `"type": "module"` y los `scripts` en el `package.json`.

### Paso 2: Crear la estructura de carpetas
Asegúrate de replicar:
```text
/assets
  /dist/     # Generado por Vite durante el build
  /src
    /css
      main.css      # Aquí instalas "@import 'tailwindcss';" y las reglas del "@theme"
    /js
      main.js       # Input JS global
    /scss
      main.scss     # Estructura principal y partials de Sass. 
```

### Paso 3: Copiar `vite.config.js`
Copia el archivo `vite.config.js` literal de este proyecto al root del nuevo tema. Asegúrate de preservar el plugin personalizado de "HMR de PHP" que es lo que brinda una de las mejores experiencias al desarrollar temas para WP.

### Paso 4: Copiar y ajustar `inc/enqueue.php`
Copia la lógica de validación de encolado.
*   **Importante:** Modifica la constante a la ruta de tu tema (`AGC_THEME_DIR` -> `NUEVO_THEME_DIR`) y ajusta el prefijo de los handlers (`agc-vite-client` por tu propio prefijo).
*   Asegúrate de agregar un `require_once get_stylesheet_directory() . '/inc/enqueue.php';` en tu `functions.php`.

### Paso 5: Desarrollar
Activa el modo test prendiendo la constante de depuración en tu `wp-config.php`:
```php
define('WP_DEBUG', true);
```
Corre la terminal del proyecto y ejecuta:
```bash
npm run dev
```
Inmediatamente el tema cargará assets desde el servidor de desarrollo y actualizará estilos y la web cada vez que modifiques SCSS y PHP de forma sincrona.
