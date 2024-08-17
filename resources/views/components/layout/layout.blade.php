<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css','resources/js/app.js'])
    <title>{{ $title }}</title>
    <link rel="shortcut icon" href="assets/logo.png" type="image/x-icon">
</head>
<body>
    <x-navbar/>
    <Main class="max-w-screen-xl w-full mx-auto p-4">
        {{ $slot }}
    </Main>
    <x-footer/>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
