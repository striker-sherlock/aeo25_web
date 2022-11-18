import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
const path = require('path');

export default defineConfig({
    plugins: [
        laravel([
            'resources/sass/app.scss',
            'resources/js/app.js',
    ]),
    ],
    resolve: {
        alias: {
            "~bootstrap": path.resolve(__dirname, "node_modules/bootstrap"),
            "~dataTables.net-dt": path.resolve(
                __dirname,
                "node_modules/dataTables.net-dt"
            ),
        },
    },
});
