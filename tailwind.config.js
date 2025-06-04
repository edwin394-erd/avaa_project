/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    './node_modules/flowbite/**/*.js'
  ],
  darkMode: 'class', // o 'media'
  theme: {
    extend: {},
  },
  plugins: [
    require('flowbite/plugin'),
  ],
  safelist: [
    'progress-circle',
    'progressAnimation'
  ],
}
