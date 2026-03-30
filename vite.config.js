import { defineConfig } from 'vite';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
  plugins: [
    tailwindcss(),
    {
      name: 'php-watch',
      configureServer(server) {
        // Registrar los PHP en el watcher de Vite (no están en el grafo de módulos)
        server.watcher.add(['**/*.php']);
      },
      handleHotUpdate({ file, server }) {
        if (file.endsWith('.php')) {
          // Invalidar módulos CSS para que Tailwind re-escanee los @source
          for (const mods of server.moduleGraph.fileToModulesMap.values()) {
            for (const mod of mods) {
              if (mod.id?.endsWith('.css') || mod.id?.endsWith('.scss')) {
                server.moduleGraph.invalidateModule(mod);
              }
            }
          }
          server.ws.send({ type: 'full-reload' });
        }
      },
    },
  ],

  // ── Entradas ────────────────────────────────────────────────────────────────
  // Vite procesará estos dos archivos como puntos de entrada independientes.
  // El CSS lo inyecta Tailwind automáticamente a través del plugin.
  build: {
    outDir: 'assets/dist',
    emptyOutDir: true,
    manifest: true,         // Genera .vite/manifest.json para que PHP resuelva los hashes
    sourcemap: false,

    rollupOptions: {
      input: {
        main: 'assets/src/css/main.css',
        custom: 'assets/src/scss/main.scss',
        script: 'assets/src/js/main.js',
      },
    },
  },

  // ── SCSS ────────────────────────────────────────────────────────────────────
  css: {
    preprocessorOptions: {
      scss: {
        // Silencia warnings de deprecación de Sass al importar partials legacy.
        // Podés quitar esto si usás @use/@forward desde el inicio.
        silenceDeprecations: ['legacy-js-api'],
      },
    },
  },

  // ── Dev server ──────────────────────────────────────────────────────────────
  // El servidor de desarrollo corre en :5173.
  // WordPress carga los scripts desde esa URL cuando WP_DEBUG=true.
  server: {
    port: 5173,
    strictPort: true,
    origin: 'http://localhost:5173',
    cors: true,
  },
});
