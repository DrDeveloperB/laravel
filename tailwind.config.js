const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    mode: 'jit',
    purge: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        // './resources/views/livewire/wire-start.blade.php',
        './public/**/*.html',
        './src/**/*.{js,jsx,ts,tsx,vue}',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
        './resources/views/*.blade.php',
    ],

    // darkMode: 'media', // false or 'media' or 'class'

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    variants: {
        extend: {},
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};
