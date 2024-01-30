import basicSsl from '@vitejs/plugin-basic-ssl';
import laravel from 'laravel-vite-plugin';
import { defineConfig } from 'vite';

export default defineConfig({
  plugins: [
    laravel({
      input: ['resources/css/app.css', 'resources/js/app.js'],
      refresh: true,
    }),
    basicSsl(),
  ],
  server: {
    host: 'localhost',
  },
});
