<x-layout.layout-reset-password>
    <x-slot:title>Reset Password</x-slot:title>
    <form class="flex flex-col items-center justify-center p-4" method="POST" action="{{ route('password.update') }}">
        @csrf
        @method('POST')
        <div class="flex h-screen flex-col gap-6 justify-center items-center">
            @if ($errors->any())
                <div class="bg-gray-100 p-5 text-center text-red-600 rounded-md">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <script>
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: '{{ $error }}',
                                });
                            </script>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (session('success'))
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Sukses',
                        text: '{{ session('success') }}',
                    });
                </script>
            @endif
            <div class="text-center font-bold text-[#A4161A] text-3xl">Buat Password baru</div>
            <div class="text-center font-normal">Password baru harus berbeda dari password sebelumnya</div>
            <input type="hidden" name="token" value="{{ $token }}">
            <input id="email" type="email" value="{{ $email }}" name="email" hidden>
            <div class="relative w-full">
                <input type="password" id="password" name="password" class="w-full pl-4 pr-11 rounded-3xl text-sm"
                    placeholder="Masukkan password" required>
                <button type="button" id="togglePassword" class="absolute inset-y-0 flex items-center top-0 right-6">
                    <i id="eyeIcon" class="ri-eye-off-fill"></i>
                </button>
            </div>
            <div class="relative w-full">
                <input type="password" name="password_confirmation" id="password_confirmation"
                    class="w-full  pl-4 pr-11 rounded-3xl text-sm" placeholder="Konfirmasi password" required>
                <button type="button" id="toggleKonfirmasiPassword"
                    class="absolute inset-y-0 flex items-center top-0 right-6">
                    <i id="eyeIconKonfirmasi" class="ri-eye-off-fill"></i>
                </button>
            </div>
            <button class="max-w-56 w-full rounded-3xl px-4 py-3 bg-[#A4161A] text-white" type="submit">Reset
                Password</button>
        </div>
    </form>
</x-layout.layout-reset-password>
