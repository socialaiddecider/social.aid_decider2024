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
                primary: {
                    100: '#D1DCD2',
                    200: '#B2C4B4',
                    300: '#8CA78F',
                    400: '#668A6A',
                    500: '#3F6C44',
                    base: '#194F1F',
                    600: '#15421A',
                    700: '#113515',
                    800: '#0D2810',
                    900: '#081A0A',
                    950: '#051006',
                },
                neutral: {
                    50: '#FFFFFF',
                    100: '#F0F0F0',
                    200: '#E8E8E8',
                    300: '#BBBBBB',
                    400: '#7F7F7F',
                    500: '#575757',
                    base: '#1B1B1B',
                    600: '#171717',
                    700: '#121212',
                    800: '#0E0E0E',
                    900: '#090909',
                    950: '#050505',
                },
                error: {
                    100: '#FDDBDB',
                    200: '#FBC3C3',
                    300: '#F9A4A4',
                    400: '#F88686',
                    500: '#F66868',
                    base: '#F44A4A',
                    600: '#CB3E3E',
                    700: '#A33131',
                    800: '#7A2525',
                    900: '#511919',
                    950: '#310F0F',
                }
            },
            animation: {
                shiftRight: 'rotateRight 1s ease-in-out',
                shiftLeft: 'rotateLeft 1.5s ease-in-out',
                fadeIn: 'fadeIn 500ms ease-in-out',
                fadeOut: 'fadeOut 500ms ease-in-out',
            },
        },
    },
    plugins: [],
};
