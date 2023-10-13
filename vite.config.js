import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/css/styles.css",
                "resources/css/bootstrap.min",
                "resources/sass/app.scss",
                "resources/js/app.js",
            ],
            refresh: true,
        }),
    ],
    server: {
        https: false,
        host: "shop_laravel.test",
    },
});
