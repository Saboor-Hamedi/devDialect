import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            fontSize: {
                '2xs': ['10px', '12px'],
                'xs': ['11px', '13px'],
                'sm': ['12px', '16px'],
                'base': ['12px', '16px'],
                'md': ['13px', '18px'],
                'lg': ['14px', '20px'],
                'xl': ['16px', '24px'],
                '2xl': ['18px', '26px'],
                '3xl': ['20px', '28px'],
                '4xl': ['24px', '32px'],
            },
        },
    },
    important: false,
    plugins: [forms],
};
