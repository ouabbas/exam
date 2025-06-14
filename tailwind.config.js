/** @type {import('tailwindcss').Config} */
const plugin = require("tailwindcss/plugin");

module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        fontFamily: {
            sans: ["Averta", "sans-serif"],
        },
        extend: {
            spacing: {
                "safe-top": "env(safe-area-inset-top)",
                "safe-right": "env(safe-area-inset-right)",
                "safe-bottom": "env(safe-area-inset-bottom)",
                "safe-left": "env(safe-area-inset-left)",
            },
            height: {
                "screen-safe":
                    "calc(100vh - env(safe-area-inset-top) - env(safe-area-inset-bottom))",
            },
            padding: {
                "safe-x":
                    "env(safe-area-inset-left) env(safe-area-inset-right)",
                "safe-y":
                    "env(safe-area-inset-top) env(safe-area-inset-bottom)",
            },
            margin: {
                "safe-y":
                    "env(safe-area-inset-top) env(safe-area-inset-bottom)",
            },
            animation: {
                fadeIn: "fadeIn 0.5s ease-in-out forwards",
            },
            keyframes: {
                fadeIn: {
                    "0%": { opacity: "0" },
                    "100%": { opacity: "1" },
                },
            },
        },
    },
    plugins: [
        require("daisyui"),
        plugin(({ addUtilities }) => {
            addUtilities({
                ".safe-area-screen": {
                    height: "calc(100vh - env(safe-area-inset-top) - env(safe-area-inset-bottom))",
                    width: "calc(100vw - env(safe-area-inset-left) - env(safe-area-inset-right))",
                },
            });
        }),
    ],
    daisyui: {
        themes: ["emerald"],
    },
};
