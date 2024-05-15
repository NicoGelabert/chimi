import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
        "./node_modules/flowbite/**/*.js"
    ],

    theme: {
        extend: {
            fontFamily: {
                
            },
            colors: {
                white: '#FBFCFF',
                black: '#0A0A0A',
                primary: '#E74694',
                primary_darker:'#BF125D',
            }
        },
    },
    plugins: [
        forms,
        require('flowbite/plugin')
    ],
};
