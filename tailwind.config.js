const defaultTheme = require("tailwindcss/defaultTheme");
const plugin = require("tailwindcss/plugin");

module.exports = {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        // add components vue files
        "./resources/js/components/**/*.vue",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Nunito", ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [
        require("@tailwindcss/forms"),
        // https://tailwindcss.com/docs/plugins#adding-components
        plugin(function ({ addComponents, theme }) {
            addComponents({
                // https://ed.team/blog/personaliza-el-scroll-de-tu-web-solo-con-css
                ".scroll-custom": {
                    /* width */
                    "&::-webkit-scrollbar": {
                        width: "4px",
                        height: "4px",
                    },
                    /* Track */
                    "&::-webkit-scrollbar-track": {
                        // bg-gray-700/30
                        backgroundColor: theme(
                            "colors.gray.700",
                            "rgba(0, 0, 0, 0.3)"
                        ),
                        borderRadius: ".25rem",
                    },
                    /* Handle */
                    "&::-webkit-scrollbar-thumb": {
                        // bg-gray-500
                        backgroundColor: theme("colors.gray.500"),
                        borderRadius: ".25rem",
                    },
                    /* Handle on hover */
                    "&::-webkit-scrollbar-thumb:hover": {
                        // bg-gray-700/80
                        backgroundColor: theme(
                            "colors.teal.700",
                            "rgba(0, 0, 0, 0.8)"
                        ),
                    },
                },
            });
        }),
    ],
};
