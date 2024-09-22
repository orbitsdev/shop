import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';
import preset from './vendor/filament/support/tailwind.config.preset'
const colors = require('tailwindcss/colors')
/** @type {import('tailwindcss').Config} */
export default {
    presets: [preset],
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            
            colors: {
                green: colors.green,
                gray: colors.neutral,
            'cerise-red': {
            '50': '#fef2f3',
            '100': '#fde6e8',
            '200': '#fbd0d6',
            '300': '#f8a9b5',
            '400': '#f3798f',
            '500': '#e94a6a',
            '600': '#d72f59',
            '700': '#b31d46',
            '800': '#961b41',
            '900': '#811a3d',
            '950': '#48091d',
    },
    
            },
        },
    },

    plugins: [forms, typography],
};
