/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./**/*.{html,js,css,php}"],
  theme: {
    extend: {
      fontFamily: {
        inter: ["'Inter'", "sans-serif"],
      },
      width: {
        "30p": "30%",
      },
      screens: {
        sm: "576px",
      },
    },
  },
  plugins: [],
};
