/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      // Menambahkan Font Poppins
      fontFamily: {
        poppins: ['Poppins', 'sans-serif'],
      },
      // Menambahkan Warna Custom untuk Admin & Frontend
      colors: {
        // Warna Admin Panel
        sidebar: '#1e293b',       // Biru Gelap Slate
        sidebarHover: '#334155',  // Slate lebih terang
        
        // Warna Utama (Bisa dipakai di Admin & Frontend)
        primary: '#1d4ed8',       // Blue-700
        secondary: '#fbbf24',     // Amber-400 (untuk aksen kuning)
        success: '#16a34a',       // Green-600
        danger: '#dc2626',        // Red-600
        light: '#f3f4f6',         // Gray-100
      }
    },
  },
  plugins: [],
}