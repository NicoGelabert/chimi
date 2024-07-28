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
                white           : '#FBFCFF',
                black           : '#0A0A0A',
                ligth_gray      : '#D9D9D9',
                dark_gray       : '#222222',
                primary         : '#E74694',
                secondary       : '#4B30CA',
                primary_darker  : '#BF125D',
            },
            fontSize: {
                xxs: '0.6rem',
            }
        },
    },
    plugins: [
        forms,
        require('flowbite/plugin')
    ],
};
