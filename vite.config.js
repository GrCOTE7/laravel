import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: [
                "public/assets/**",
                "resources/js/**",
                "resources/routes/**",
                "resources/views/**",
                "routes/**",
                "app/**",
                "lang/**",
                "config/**",
            ],
        }),
    ],
});
//# sourceMappingURL=vite.config.js.map
