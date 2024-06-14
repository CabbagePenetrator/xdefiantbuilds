import defaultTheme from 'tailwindcss/defaultTheme'
import forms from '@tailwindcss/forms'

/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    './storage/framework/views/*.php',
    './resources/views/**/*.blade.php',
    './resources/js/**/*.vue',
  ],

  theme: {
    extend: {
      colors: {
        'light-blue': '#3C4F6D',
        blue: '#2A3B56',
        'dark-blue': '#1C233D',
        yellow: '#EDCE52',
      },
      fontFamily: {
        sans: ['Helvetica', ...defaultTheme.fontFamily.sans],
      },
      container: {
        center: true,
        padding: '1rem',
      },
    },
  },

  plugins: [forms],
}
