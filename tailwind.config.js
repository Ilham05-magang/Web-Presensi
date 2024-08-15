module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./node_modules/flowbite/**/*.js"
    ],
    theme: {
        extend: {},
        colors: {
            'login':'#212529',
            'button':'#6C757D'
        }
    },
    plugins: [
        require('flowbite/plugin')
    ],
}
