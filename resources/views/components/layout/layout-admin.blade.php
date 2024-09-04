<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css','resources/js/app.js'])
    <title>{{ $title }}</title>
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="shortcut icon" href="/assets/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/cleave.js@1.6.0/dist/addons/cleave-phone.id.css">
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


    @if (session('success'))
        @if (session('success') == 'Inputan password lama salah')
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: '{{ session('success') }}',
                });
            </script>
        @else
            <script>
                Swal.fire({
                    position: "center",
                    icon: 'success',
                    text: '{{ session('success') }}',
                    showConfirmButton: false,
                    timer: 2000
                });
            </script>
        @endif
    @endif
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: '{{ $error }}',
                });
            </script>
        @endforeach
    @endif
</body>
</html>
