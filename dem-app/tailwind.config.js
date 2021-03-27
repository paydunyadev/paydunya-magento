const defaultTheme = require('tailwindcss/defaultTheme');

const colors = require('tailwindcss/colors');

module.exports = {
    purge: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },

            colors:{
                'cerise': {
                    '50': '#fdf5fa',
                    '100': '#fcebf5',
                    '200': '#f7cce5',
                    '300': '#f2aed5',
                    '400': '#e871b6',
                    '500': '#de3496',
                    '600': '#c82f87',
                    '700': '#a72771',
                    '800': '#851f5a',
                    '900': '#6d194a'
                }
            }
        },
    },

    variants: {
        extend: {
            opacity: ['disabled'],
        },
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};
