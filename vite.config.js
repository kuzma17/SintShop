import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import i18n from 'laravel-vue-i18n/vite';

export default defineConfig({
    plugins: [
        vue(),
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',

                // 'resources/sass/admin.scss', //admin
                // 'resources/js/app_admin.js',
            ],

            refresh: true,
        }),
        i18n(),
    ],
});
