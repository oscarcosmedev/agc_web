# AGC Theme - WordPress Custom Template

Este es un tema de WordPress personalizado diseñado y desarrollado para **AGC**. Utiliza un stack moderno enfocado en el rendimiento, la mantenibilidad y una excelente experiencia de desarrollo.

## 🚀 Tecnologías Principales

*   **WordPress**: Base del CMS.
*   **Vite 6**: Bundler ultra rápido para el manejo de assets y HMR (Hot Module Replacement).
*   **Tailwind CSS 4.2**: Framework de utilidades CSS de última generación.
*   **SCSS**: Preprocesador CSS para una organización modular de los estilos.
*   **ACF (Advanced Custom Fields)**: Gestión de campos personalizados y sincronización vía JSON.
*   **WPML**: Soporte multi-idioma.

---

## 🛠️ Instalación y Configuración

Sigue estos pasos para comenzar a desarrollar en este tema:

1.  **Requisitos previos**: Asegúrate de tener instalados:
    *   Un entorno local de WordPress (LocalWP, Laragon, XAMPP, etc.).
    *   [Node.js](https://nodejs.org/) (versión 18 o superior recomendada).
    *   [Composer](https://getcomposer.org/) (si se añaden dependencias PHP en el futuro).

2.  **Instalar dependencias de Node**:
    Navega a la carpeta del theme y ejecuta:
    ```bash
    npm install
    ```

3.  **Configuración del Host Local**:
    Asegúrate de que la URL de tu sitio local coincida con la configurada en `vite.config.js` para que el proxy funcione correctamente.

---

## 💻 Comandos de Desarrollo

| Comando | Descripción |
| :--- | :--- |
| `npm run dev` | Inicia el servidor de desarrollo de Vite con recarga automática para PHP y SCSS. |
| `npm run build` | Genera los archivos optimizados (minificados y con hash) en `assets/dist/` para producción. |

---

## 📂 Estructura del Proyecto

*   `assets/src/`: Código fuente de estilos (SCSS) y scripts (JS).
*   `assets/dist/`: Archivos procesados por Vite (no editar manualmente, se generan al hacer build).
*   `inc/`: Lógica de PHP dividida modularmente (enqueues, helpers, setup, etc.).
*   `template-parts/`: Componentes reutilizables de la plantilla (header, footer, hero, etc.).
*   `acf-json/`: Archivos JSON para la sincronización automática de los campos de ACF.

---

## 📝 Notas de Desarrollo

### Sincronización de ACF
El tema está configurado para guardar automáticamente los grupos de campos en la carpeta `acf-json`. Asegúrate de dar permisos de escritura a esta carpeta para que los cambios se guarden correctamente al editar campos en el admin de WordPress.

### Vite & WordPress
El tema utiliza una función helper en PHP (`agc_vite_asset` o similar en `inc/enqueue.php`) para encolar los scripts y estilos dinámicamente desde el servidor de Vite en desarrollo o desde los archivos estáticos en producción.
