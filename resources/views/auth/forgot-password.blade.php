<x-layout.layout-reset-password>
    <x-slot:title>Lupa Sandi</x-slot:title>
    <div class="flex gap-3 mb-4 items-center p-4">
        <a href="{{ route('login') }}" class="font-semibold "> <i class="ri-arrow-left-s-line"></i>
            Kembali ke halaman login</a>
    </div>

    <form class="flex items-center h-5/6 justify-center p-4" method="POST" action="{{ route('password.email') }}">
        @csrf
        @method('POST')
        <div class="flex flex-col gap-6 justify-center items-center">
            <div class="text-center font-bold text-[#A4161A] text-2xl">Reset password</div>
            <div class="text-center font-normal max-w-sm w-f">Masukkan email yang ditautkan ke akun Anda.
                Kami akan mengirimkan email konfirmasi
                untuk mengubah kata sandi Anda.
            </div>
            <input placeholder="example@gmail.com" class="w-full max-w-96 px-4 rounded-3xl" id="email"
                type="email" name="email" value="{{ old('email') }}" required
                class="border w-full rounded-md shadow-sm">
            <button id="submit-button" type="submit"
                class="max-w-56 w-full rounded-3xl px-4 py-3 bg-[#A4161A] text-white">Continue</button>
        </div>
    </form>

    @if (session('status'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Sukses',
                text: '{{ session('status') }}',
            });

            const button = document.getElementById('submit-button');
            button.disabled = true;
            button.style.opacity = '0.2'; 
            let cooldown = 60;
            button.textContent = `${cooldown} detik`;

            const interval = setInterval(() => {
                cooldown--;
                button.textContent = `${cooldown} detik`;
                if (cooldown <= 0) {
                    clearInterval(interval);
                    button.disabled = false;
                    button.style.opacity = '1'; 
                    button.textContent = 'Continue';
                }
            }, 1000);
        </script>
    @endif

    @if (session('email'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '{{ session('email') }}',
            });
        </script>
    @endif

</x-layout.layout-reset-password>
