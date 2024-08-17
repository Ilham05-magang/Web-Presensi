<x-layout.layoutauth>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="grid md:grid-cols-2 grid-cols-1">
        <div class="md:block hidden w-full bg-login h-screen rounded-br-[100px] items-center md:flex justify-center">
            <img src="{{ asset('assets/logo.png') }}" alt="Logo">
        </div>
        <div class="w-full bg-login md:h-screen">
            <div class="bg-white md:h-screen w-full rounded-tl-[100px] flex justify-center">
                <div class="flex flex-col gap-6 items-center justify-center w-full md:py-0 py-14">
                    <div class="flex flex-col items-center">
                        <i class="ri-account-circle-line text-2xl md:block hidden"></i>
                        <img src="{{ asset('assets/logo.png') }}" class="md:hidden block w-12 bg-login rounded-full p-2" alt="Logo">
                        <h1 class="font-bold text-3xl">Sign Up</h1>
                    </div>
                    <form action="{{ route('register.create.intern') }}" method="POST" class="flex flex-col gap-6 w-full md:px-0 px-8 md:px-0 max-w-lg">
                        @csrf
                        <div class="md:grid flex flex-col md:grid-cols-2 gap-4 text-sm">
                            <div class="flex flex-col gap-5">
                                <div class="flex flex-col gap-1">
                                    <label for="nama" class="font-semibold">Nama Lengkap*</label>
                                    <input type="text" id="nama" name="nama" class="rounded-lg text-sm" placeholder="Masukkan nama lengkap" value="{{ old('nama') }}" required>
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label for="email" class="font-semibold">Email*</label>
                                    <input type="email" id="email" name="email" class="rounded-lg text-sm" placeholder="Masukkan email" value="{{ old('email') }}" required>
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label for="username" class="font-semibold">Username*</label>
                                    <input type="text" id="username" name="username" class="rounded-lg text-sm" placeholder="Masukkan username" value="{{ old('username') }}" required>
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label for="telepon" class="font-semibold">No Telp*</label>
                                    <div class="flex">
                                        <span class="inline-flex items-center px-3 rounded-l-lg bg-gray-200 text-gray-900 border-[1px] border-[#6B7280] border-r-0">+62</span>
                                        <input type="tel" id="telepon" name="telepon" class="rounded-r-lg text-sm w-full" placeholder="Cth: 8123-456-7890" value="{{ old('telepon') }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="flex flex-col gap-5">
                                <div class="flex flex-col gap-1">
                                    <label for="ttl" class="font-semibold">Tempat, Tanggal Lahir*</label>
                                    <input type="text" name="ttl" id="ttl" class="rounded-lg text-sm" placeholder="Cth: Semarang, 10 September 2021" value="{{ old('ttl') }}" required>
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label for="instansi" class="font-semibold">Asal Sekolah/Kampus*</label>
                                    <input type="text" id="instansi" name="instansi" class="rounded-lg text-sm" placeholder="Masukkan asal sekolah/kampus" value="{{ old('instansi') }}" required>
                                </div>
                                <div class="flex flex-col gap-1 relative">
                                    <label for="password" class="font-semibold">Password*</label>
                                    <input type="password" id="password" name="password" class="rounded-lg text-sm" placeholder="Masukkan password" required>
                                    <button type="button" id="togglePassword" class="absolute top-6 inset-y-0 right-3 flex items-center">
                                        <i id="eyeIcon" class="ri-eye-off-fill"></i>
                                    </button>
                                </div>
                                <div class="flex flex-col gap-1 relative">
                                    <label for="password_confirmation" class="font-semibold">Konfirmasi Password*</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation" class="rounded-lg text-sm" placeholder="Konfirmasi password" required>
                                    <button type="button" id="toggleKonfirmasiPassword" class="absolute top-6 inset-y-0 right-3 flex items-center">
                                        <i id="eyeIconKonfirmasi" class="ri-eye-off-fill"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div>
                            @if ($errors->has('password'))
                                <div class="text-red-500 text-base mb-2 text-center w-full">
                                    Password tidak sama
                                </div>
                            @endif
                            <div class="flex justify-center">
                                <button type="submit"
                                    class="bg-button px-3 py-2 text-white w-36 shadow-lg shadow-black/30 rounded-lg font-semibold hover:bg-[#ADB5BD] hover:border-button hover:border-[1px] border-[1px] border-button">
                                    Sign Up
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="flex gap-2">
                        <p>Sudah punya akun?</p>
                        <a href="{{ route('login') }}" class="text-blue-700 hover:underline">Log in</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePasswordVisibility(id, iconId) {
            const passwordField = document.getElementById(id);
            const eyeIcon = document.getElementById(iconId);
            const isPassword = passwordField.type === 'password';
            passwordField.type = isPassword ? 'text' : 'password';
            eyeIcon.classList.toggle('ri-eye-fill', isPassword);
            eyeIcon.classList.toggle('ri-eye-off-fill', !isPassword);
        }

        document.getElementById('togglePassword').addEventListener('click', function () {
            togglePasswordVisibility('password', 'eyeIcon');
        });

        document.getElementById('toggleKonfirmasiPassword').addEventListener('click', function () {
            togglePasswordVisibility('password_confirmation', 'eyeIconKonfirmasi');
        });
    </script>
</x-layout.layoutauth>
