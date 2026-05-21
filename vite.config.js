import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
  base: '/build/',
  plugins: [
    laravel({
      input: [
        'resources/css/app.css',
        'resources/sass/app.scss',
        'resources/js/app.js',
      ],
      refresh: true,
    }),
  ],
  server: {
    host: '127.0.0.1',
    hmr: {
      host: '127.0.0.1',
    },
    watch: {
      ignored: ['**/storage/framework/views/**'],
    },
  },
});
