import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
     safelist: [
        'h-4',
        'w-4',
        'inline-block',
        'lg:w-8',
        'lg:h-8',
        'bottom-4',
        '-bottom-14',
        'pl-10',
        'lg:pl-20',
        'text-[8px]',
        'md:text-xs',
        'lg:text-sm',
        '#ffffcc',
        'mr-2'
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },
    plugins: [],
};
