import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import basicSsl from '@vitejs/plugin-basic-ssl';

export default defineConfig({
  plugins: [
    laravel({
      input: ['resources/css/app.css', 'resources/js/app.js'],
      refresh: true,
      valetTls: 'touslesprenoms.test',
    }),
    basicSsl(),
  ],
  server: {
    https: true,
    host: 'localhost',
  },
});
