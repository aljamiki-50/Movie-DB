

import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import VitePurgeCSS from 'vite-plugin-purgecss';

export default defineConfig({
  plugins: [
    laravel({
      input: ['resources/css/app.css', 'resources/js/app.js'],
      refresh: true,
    }),
    VitePurgeCSS({
      content: ['index.html', 'src/**/*.vue'], // Adjust the paths as per your project structure
    }),
  ],
});



