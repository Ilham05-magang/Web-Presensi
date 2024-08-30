<x-layout.layoutauth>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="grid grid-cols-1 md:grid-cols-2">
        <div class="md:block hidden w-full bg-login h-screen rounded-br-[100px] items-center md:flex justify-center">
            <img src="{{ asset('assets/logo.png') }}" alt="Logo">
        </div>
        <div class="w-full bg-login md:h-screen">
            <div class="bg-white md:h-screen w-full rounded-tl-[100px] flex justify-center">
                <div class="flex flex-col items-center justify-center w-full gap-6 md:py-0 py-14">
                    <div class="flex flex-col items-center">
                        <i class="hidden text-2xl ri-account-circle-line md:block"></i>
                        <img src="{{ asset('assets/logo.png') }}" class="block w-12 p-2 rounded-full md:hidden bg-login" alt="Logo">
                        <h1 class="text-3xl font-bold">Sign Up</h1>
                    </div>
                    <form action="{{ route('register.create.karyawan') }}" method="POST" class="flex flex-col w-full max-w-lg gap-6 px-8 md:px-0">
                        @csrf
                        <div class="flex flex-col gap-4 text-sm md:grid md:grid-cols-2">
                            <div class="flex flex-col gap-5">
                                <div class="flex flex-col gap-1">
                                    <label for="nama" class="font-semibold">Nama Lengkap*</label>
                                    <input type="text" id="nama" name="nama" class="text-sm rounded-lg" placeholder="Masukkan nama lengkap" value="{{ old('nama') }}" required>
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label for="email" class="font-semibold">Email*</label>
                                    <input type="email" id="email" name="email" class="text-sm rounded-lg" placeholder="Masukkan email" value="{{ old('email') }}" required>
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label for="username" class="font-semibold">Username*</label>
                                    <input type="text" id="username" name="username" class="text-sm rounded-lg" placeholder="Masukkan username" value="{{ old('username') }}" required>
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label for="telepon" class="font-semibold">No Telp*</label>
                                    <div class="flex">
                                        <span class="inline-flex items-center px-3 rounded-l-lg bg-gray-200 text-gray-900 border-[1px] border-[#6B7280] border-r-0">+62</span>
                                        <input type="tel" id="telepon" name="telepon" class="w-full text-sm rounded-r-lg" placeholder="Cth: 8123457890" value="{{ old('telepon') }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="flex flex-col gap-5">
                                <div class="grid grid-cols-2 gap-1">
                                    <label for="tempat_lahir" class="col-span-2 font-semibold">Tempat, Tanggal Lahir*</label>
                                    <div class="col-span-1">
                                        <input type="text" name="tempat_lahir" id="tempat_lahir" class="w-full text-sm rounded-lg " placeholder="Tempat" value="{{ old('tempat_lahir') }}" required>
                                    </div>
                                    <div class="col-span-1">
                                        <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="w-full text-sm rounded-lg " value="{{ old('tanggal_lahir') }}" required>
                                    </div>
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label for="nip" class="font-semibold">NIP*</label>
                                    <input type="text" id="nip" name="nip" class="text-sm rounded-lg" placeholder="Cth:850723123456" value="{{ old('nip') }}" required>
                                </div>
                                <div class="relative flex flex-col gap-1">
                                    <label for="password" class="font-semibold">Password*</label>
                                    <input type="password" id="password" name="password" class="text-sm rounded-lg" placeholder="Masukkan password" required>
                                    <button type="button" id="togglePassword" class="absolute inset-y-0 flex items-center top-6 right-3">
                                        <i id="eyeIcon" class="ri-eye-off-fill"></i>
                                    </button>
                                </div>
                                <div class="relative flex flex-col gap-1">
                                    <label for="password_confirmation" class="font-semibold">Konfirmasi Password*</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation" class="text-sm rounded-lg" placeholder="Konfirmasi password" required>
                                    <button type="button" id="toggleKonfirmasiPassword" class="absolute inset-y-0 flex items-center top-6 right-3">
                                        <i id="eyeIconKonfirmasi" class="ri-eye-off-fill"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-center">
                                <button type="submit"
                                    class="bg-login px-3 py-2 text-white w-36 shadow-lg shadow-black/30 rounded-lg font-semibold hover:bg-[#6C767E] hover:border-button hover:border-[1px] border-[1px] border-button">
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
</x-layout.layoutauth>
