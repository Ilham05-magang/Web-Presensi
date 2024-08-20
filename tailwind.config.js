module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./node_modules/flowbite/**/*.js"
    ],
    theme: {
        backgroundImage: {
            'user-background': "url('assets/user-dashboard.svg')"
        },
        colors: {
            'login':'#212529',
            'button':'#6C757D',
            'red-button': '#A4161A'
        },
        extend: {
            fontFamily: {
              inter: ['Inter', 'sans-serif'],
            },
        },
    },
    plugins: [
        require('flowbite/plugin'),
        require('@tailwindcss/typography')
    ],
}
