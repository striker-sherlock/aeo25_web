import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
const path = require('path');

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/js/app.js',
                'resources/sass/app.scss'
            ],
            refresh: true,
        }),
    ],

    resolve: {
        alias: {
            "~fa": path.resolve(__dirname, "node_modules/@fortawesome/fontawesome-free/scss"),
            "~bootstrap": path.resolve(__dirname, "node_modules/bootstrap"),
            "~dataTables.net-dt": path.resolve(__dirname, "node_modules/dataTables.net-dt"
            ),
        },
    },

    server: {
        https: false,
        host: 'uat.aeo.mybnec.org.loc',
    },

    
});
