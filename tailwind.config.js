module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./node_modules/flowbite/**/*.js"
    ],
    theme: {
        colors: {
            'login':'#212529',
            'button':'#6C757D',
            'red-button': '#A4161A'
        },
        extend: {
            backgroundImage: {
                'user-background': "url('../assets/user-dashboard.svg')"
            },
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
