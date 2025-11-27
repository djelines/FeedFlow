import { createRequire } from 'module';
const require = createRequire(import.meta.url);
/** @type {import('tailwindcss').Config} */
module.exports = {
    darkMode: 'class',
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./node_modules/flowbite/**/*.js"
    ],
    theme: {
        extend: {
            colors: {
                // Layout backgrounds
                background: '#F3F4F6',        // light page background
                'background-dark': '#020617', // dark page background

                //card header
                surface: '#FFFFFF',
                'surface-dark': '#111827',
                'surface-soft-dark': '#14162e',

                // dark sidebar
                sidebar: '#E8E8ED',
                'sidebar-dark': '#020014',

                // Texts
                'text-primary': '#0F172A',
                'text-secondary': '#6B7280',
                'text-primary-dark': '#E5E7EB',
                'text-secondary-dark': '#9CA3AF',

                // Borders
                bordercolor: '#D7D9DE',
                'bordercolor-dark': '#1F2937',

                // Main
                primary: '#6366F1',
                'primary-hover': '#4F46E5',
                'primary-dark': '#8B5CF6',
                'primary-hover-dark': '#6366F1',

                // Soft hover background
                'primary-soft': '#d8e0ff',
                'primary-soft-dark': '#1E1B4B',

                // Accent
                accent: '#A855F7',
                'accent-dark': '#A855F7',
            },

            // Gradient hover style
            backgroundImage: {
                'primary-noise':
                    'linear-gradient(130deg, #4F46E5, #8B5CF6, #6366F1, #22C5D8, #7C3AED, #4F46E5)',
                'primary-noise-dark':
                    'linear-gradient(130deg, #4338CA, #7C3AED, #4F46E5, #0891B2, #6D28D9, #4338CA)',
            },

            // Gradient hover animation (C'est un enfer help me)
            keyframes: {
                'gradient-noise': {
                    '0%':   { backgroundPosition: '0% 50%' },
                    '20%':  { backgroundPosition: '80% 20%' },
                    '40%':  { backgroundPosition: '20% 80%' },
                    '60%':  { backgroundPosition: '100% 50%' },
                    '80%':  { backgroundPosition: '40% 0%' },
                    '100%': { backgroundPosition: '0% 50%' },
                },
            },
            animation: {
                'gradient-noise': 'gradient-noise 5s ease-in-out infinite',
            },
        },
    },
    plugins: [
        require('flowbite/plugin')
    ],
};
