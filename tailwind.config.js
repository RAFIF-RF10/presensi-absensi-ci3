/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./application/views/**/*.php", // Untuk semua file di folder views
    "./assets/js/**/*.js",  
		'./application/views/**/*.php',  // Path ke file view di folder application/views
    './application/assets/css/**/*.css',  // Path ke file CSS di folder application/assets/css      // Kalau ada JS kustom
  ],
  theme: {
    extend: {},
  },
  plugins: [],
};

