import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['jersey', 'sans-serif'],
            },
            colors: {
                primary: '#44A678',
                secondary: '#012611',
                option1: '#518C6B',
                light: '#F2F2F2',
                dark: '#0D0D0D',
              },
        },
    },

    plugins: [forms],
};
