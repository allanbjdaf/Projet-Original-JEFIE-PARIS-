// tailwind.config.js — REMPLACER votre fichier existant
// Ce fichier limite Tailwind à NE PAS toucher vos composants existants

/** @type {import('tailwindcss').Config} */
export default {
    // ✅ Tailwind scanne UNIQUEMENT ces fichiers — pas vos vues blade
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/auth/*.blade.php',      // ✅ Seulement les vues Breeze
        './resources/views/profile/*.blade.php',   // ✅ Seulement le profil Breeze
        './resources/views/components/*.blade.php', // ✅ Composants Breeze
        './resources/js/**/*.js',
    ],

    theme: {
        extend: {
            // ✅ Vos couleurs personnalisées
            colors: {
                'jefie-blue': '#0d1b3e',
                'jefie-navy': '#162552',
                'jefie-gold': '#f5a623',
                'jefie-green': '#2e7d32',
            },
        },
    },

    plugins: [
        // ✅ NE PAS inclure @tailwindcss/forms car il casse vos inputs
        // require('@tailwindcss/forms'),
    ],
};