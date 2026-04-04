import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
            devServer: {
                url: 'http://192.168.15.15:5173'
            }
        }),
        tailwindcss(),
        vue(),
    ],
    server: {
        host: '192.168.15.15:5173',
        port: 5173,
        origin: 'http://192.168.15.15:5173',
        cors: {
            origin: 'http://192.168.15.15:3490'
        },
        hmr: {
            host: '192.168.15.15',
            protocol: 'ws',
            port: 5173
        }
    }
});
