/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js'
  ],
  theme: {
    extend: {
      colors: {
        sidebar: '#1f2937',      // slate-800
        sidebarHover: '#374151', // slate-700
        primary: '#2563eb',      // blue-600
        success: '#16a34a',
        danger: '#dc2626',
      },
    },
  },
  plugins: [],
}