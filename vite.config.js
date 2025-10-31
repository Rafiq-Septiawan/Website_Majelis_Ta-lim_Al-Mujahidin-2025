import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import browsersync from 'browser-sync';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/css/pembayaranSPP.css',
                'resources/js/pembayaranSPP.js',
            ],
            refresh: true,
        }),
        {
            name: 'browser-sync',
            configureServer() {
                const bs = browsersync.create();
                bs.init({
                    proxy: 'http://127.0.0.1:8000',
                    files: [
                        'resources/views/**/*.blade.php',
                        'resources/css/**/*.css',
                        'resources/js/**/*.js',
                        'public/**/*.*',
                    ],
                    open: false,
                    host: '0.0.0.0',
                    port: 3000,
                    notify: false,
                });
            },
        },
    ],
    server: {
        host: '0.0.0.0', 
        port: 5173,
        hmr: {
            host: '127.0.0.1',
        },
    },
});
