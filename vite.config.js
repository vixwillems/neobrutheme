import { defineConfig } from 'vite'
import tailwindcss from '@tailwindcss/vite'

export default defineConfig({
  plugins: [
    tailwindcss(),
  ],
  build: {
    rollupOptions: {
      input: 'assets/js/app.js',
      output: {
        entryFileNames: 'app.js',
        assetFileNames: (assetInfo) => {
          if (assetInfo.name && assetInfo.name.endsWith('.css')) {
            return 'tailwind.[ext]'
          }
          return '[name].[ext]'
        },
      },
    },
    outDir: 'assets/css',
    emptyOutDir: false,
    cssMinify: true,
  },
})
