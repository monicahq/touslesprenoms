import basicSsl from '@vitejs/plugin-basic-ssl';
import laravel from 'laravel-vite-plugin';
import { defineConfig, loadEnv } from 'vite';

export default defineConfig(({ mode }) => {
  // Load env file based on `mode` in the current working directory.
  // Set the third parameter to '' to load all env regardless of the `VITE_` prefix.
  const env = loadEnv(mode, process.cwd(), '');
  const host = env.APP_HOST ? env.APP_HOST : env.APP_URL ? env.APP_URL.replace('https://', '').replace('http://', '') : 'localhost';
  return {
    plugins: [
      laravel({
        input: ['resources/css/app.css', 'resources/js/app.js'],
        refresh: true,
      }),
      basicSsl(),
    ],
    server: {
      host: host,
    },
  };
});
