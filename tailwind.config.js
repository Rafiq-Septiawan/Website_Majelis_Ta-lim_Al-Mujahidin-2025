export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        primary: '#0d9488',
      },
      backgroundImage: {
        'primary-gradient': 'linear-gradient(to bottom right, #0f766e, #0d9488)',
      },
      fontFamily: {
        jakarta: ['"Plus Jakarta Sans"', 'sans-serif', 'semibold', 'bold', 'extrabold'],
        nunito: ['"Nunito Sans"', 'sans-serif'],
      },
    },
  },
  plugins: [],
}