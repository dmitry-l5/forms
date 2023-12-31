import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({

    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/forms_builder.js',
                'resources/css/pdf/test.css',
            ],
            refresh: true,
           
        }),

    ],
    build: {
        minify: false,
      },
});
