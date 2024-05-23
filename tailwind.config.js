import defaultTheme from "tailwindcss/defaultTheme";


/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
    ],
    theme: {
        extend: {
            fontFamily: {
                PlusJakartaSans: ["PlusJakartaSans", ...defaultTheme.fontFamily.sans],
                PlusJakartaSansItalic: ["PlusJakartaSans-italic", ...defaultTheme.fontFamily.sans],
            },
            boxShadow: {
                baseShadow: '0px 677px 189px 0px rgba(77, 77, 77, 0.00), 0px 27px 60px 0px rgba(77, 77, 77, 0.10)'
            },
            colors: {
                base: {
                    50: '#b2c4b4',
                    100: '#b2c4b4',
                    200: '#8ca78f',
                    300: '#668a6a',
                    400: '#3f6c44',
                    500: '#194f1f',
                    600: '#15421a',
                    700: '#113515',
                    800: '#0d2810',
                    900: '#081a0a',
                    950: '#051006',
                },
                neutral: {
                    50: '#FFFFFF',
                    100: '#d1d1d1',
                    200: '#b3b3b3',
                    300: '#676767',
                    400: '#414141',
                    500: '#1b1b1b',
                    600: '#171717',
                    700: '#121212',
                    800: '#0e0e0e',
                    900: '#090909',
                    950: '#050505',
                }
            }
        },
    },
    plugins: [],
};
