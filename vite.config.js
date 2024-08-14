import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'public/build/assets/app-81c1b68b.css',
                'public/build/assets/app-6e0eadfb.js',
            ],
            refresh: true,
        }),
    ],
});
