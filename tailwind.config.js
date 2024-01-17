import colors from "tailwindcss/colors";

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', 'sans-serif']
            },

            colors: {
                primary: colors.emerald
            }
        },
    },
    plugins: [],
}
