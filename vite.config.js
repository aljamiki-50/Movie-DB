// vite.config.js
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import postcss from 'rollup-plugin-postcss';
import autoprefixer from 'autoprefixer';
import cssnano from 'cssnano';
import purgecss from '@fullhuman/postcss-purgecss';

export default defineConfig({
  plugins: [
    laravel({
      input: ['resources/css/app.css', 'resources/js/app.js'],
      refresh: true,
    }),
    postcss({
      plugins: [
        autoprefixer(),
        cssnano(),
        purgecss({
          content: ['index.html', 'src/**/*.vue'],
          // Adjust other options as needed
        }),
      ],
    }),
  ],
});
