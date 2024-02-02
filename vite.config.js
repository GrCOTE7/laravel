import { defineConfig } from "vite"; import laravel from "laravel-vite-plugin"; export default defineConfig({ plugins: [laravel({ input: ["resources/css/app.css", "resources/js/app.js"], refresh: ["resources/js/**", "resources/routes/**", "routes/**", "resources/views/**", "app/**", "config/**"] })] });
//# sourceMappingURL=vite.config.js.map
