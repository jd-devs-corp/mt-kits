/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {},
    },
    variants: {
        extend: {
            display: ['dark'],
            textColor: ['dark'],
        },
    },
    plugins: [],
    darkMode: ['selector', '[data-mode="dark"]'],
}
