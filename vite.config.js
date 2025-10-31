import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/welcome.css',
                'resources/css/dashboard.css', 
                'resources/js/welcome.js',
                'resources/js/dashboard.js'
            ],
            refresh: true,
        }),
    ],
});