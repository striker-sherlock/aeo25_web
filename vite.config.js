import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from "path";

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/js/app.js'],
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
});
