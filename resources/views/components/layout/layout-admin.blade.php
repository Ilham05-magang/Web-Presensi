<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css','resources/js/app.js'])
    <title>{{ $title }}</title>
    <link rel="shortcut icon" href="/assets/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <x-admin.navbar-admin>
        <Main class="font-inter ">
            <div class="bg-[#242947] h-80 rounded-b-[60px]"></div>
            <div class="px-4 py-8">
                <div class="w-full h-full -mt-32 bg-white md:-mt-60 border-[1px] border-[#242947]/60 shadow-lg shadow-[#242947]/60 rounded-[30px] " >
                    {{ $slot }}
                </div>
            </div>
        </Main>
    </x-admin.navbar-admin>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
</body>
</html>
