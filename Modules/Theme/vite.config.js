import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'

export default defineConfig({
    plugins: [
        laravel({
            input: ['Resources/assets/backend/js/theme.js'],
            refresh: true
        })
    ]
})
