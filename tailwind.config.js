module.exports = {
  content: [
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    './storage/framework/views/*.php',
    './resources/views/**/*.blade.php',
    './resources/js/**/*.vue',
  ],

  theme: {
    fontFamily: {
      display: 'Roboto system-ui sans-serif',
      body: 'Roboto system-ui sans-serif',
    },
    extend: {},
  },

  plugins: [require('@tailwindcss/forms')],
};