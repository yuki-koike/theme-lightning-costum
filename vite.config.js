import { defineConfig } from 'vite';
import path from 'path';

export default defineConfig({
    build: {
        outDir: 'wp-content/themes/my-custom-theme/assets/js',
        emptyOutDir: false,
        rollupOptions: {
            input: path.resolve(__dirname, 'wp-content/themes/my-custom-theme/src/js/init.js'),
            output: {
            entryFileNames: 'script.js',
            },
        },
    },
});