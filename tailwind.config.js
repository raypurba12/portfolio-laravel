import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    darkMode: 'class',

    theme: {
        extend: {
            fontFamily: {
                sans: ['Space Grotesk', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                // ── Off-white text ──
                white: '#edf1f8',
                // ── Neutral navy (70% dark) ──
                gray: {
                    50: '#f2f4f8',
                    100: '#e4e8ef',
                    200: '#c7cfdc',
                    300: '#a6b0c1',
                    400: '#828da2',
                    500: '#5f6a7d',
                    600: '#3f4a5e',
                    700: '#2b3547',
                    800: '#1b2332',
                    900: '#111826',
                    950: '#070b13',
                },
                // ── Primary: deep violet / indigo (20%) ──
                purple: {
                    50: '#f1f1fc',
                    100: '#e2e3f8',
                    200: '#c8caf2',
                    300: '#a5a8e8',
                    400: '#8589d9',
                    500: '#676bc6',
                    600: '#5052ad',
                    700: '#42458f',
                    800: '#363a73',
                    900: '#292b55',
                    950: '#1b1c3a',
                },
                // Alias so any indigo-* utilities share the same violet system
                indigo: {
                    50: '#f1f1fc',
                    100: '#e2e3f8',
                    200: '#c8caf2',
                    300: '#a5a8e8',
                    400: '#8589d9',
                    500: '#676bc6',
                    600: '#5052ad',
                    700: '#42458f',
                    800: '#363a73',
                    900: '#292b55',
                    950: '#1b1c3a',
                },
                // ── Secondary: soft electric blue / cyan accent (10%) ──
                cyan: {
                    50: '#eef6fa',
                    100: '#d9edf5',
                    200: '#b2dced',
                    300: '#82c4dd',
                    400: '#54a9c9',
                    500: '#3d8fb0',
                    600: '#317491',
                    700: '#2b5f77',
                    800: '#244b5d',
                    900: '#1d3b49',
                    950: '#10242f',
                },
            },
        },
    },

    plugins: [forms],
};
