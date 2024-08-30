<x-layout.layoutauth>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="grid grid-cols-1 md:grid-cols-2 ">
        <div class="hidden w-full bg-login h-screen rounded-br-[100px] items-center md:flex justify-center">
            <img src="assets/logo.png" class="" alt="">
        </div>
        <div class="w-full h-screen bg-login">
            <div class="bg-white h-screen w-full rounded-tl-[100px] flex justify-center">
                <div class="flex flex-col items-center justify-center w-full gap-6 ">
                    <div class="flex flex-col items-center">
                        <i class="hidden text-2xl ri-lock-2-fill md:block"></i>
                        <img src="assets/logo.png" class="block w-12 p-2 rounded-full bg-login md:hidden"
                            alt="">
                        <h1 class="text-4xl font-bold">Log In</h1>
                    </div>
                    <form action="/login" method="POST" class="flex flex-col w-full max-w-xs gap-6 px-5 md:px-0">
                        @method('POST')
                        @csrf
                        <div class="flex flex-col gap-4 text-base">
                            <div class="flex flex-col gap-1">
                                <label for="" class="font-semibold">Username/Email</label>
                                <input type="text" required name="email" value="{{ old('email') }}"
                                    class="rounded-lg" placeholder="Masukkan username / email">
                            </div>
                            <div class="flex flex-col gap-1">
                                <label for="" class="font-semibold">Password</label>
                                <div class="relative w-full">
                                    <input required type="password" id="password" name="password"
                                        class="w-full pr-8 rounded-lg" placeholder="Masukkan password">
                                    <button type="button" id="togglePassword"
                                        class="absolute inset-y-0 flex items-center top-[2px] right-4">
                                        <i id="eyeIcon" class="ri-eye-off-fill"></i>
                                    </button>
                                </div>

                            </div>
                        </div>
                        <div class="flex justify-between text-sm">
                            <div class="flex items-center gap-2">
                                <input type="checkbox" name="remember_me" class="rounded-sm" id="checkbox">
                                <label for="remember">Ingat Saya</label>
                            </div>
                            <div class="flex gap-1">
                                <p>Lupa Kata Sandi?</p>
                                <a href="{{ route('password.request') }}" class="text-red-700 hover:underline">Reset</a>
                            </div>
                        </div>
                        <div class="flex justify-center">
                            <button type="submit"
                                class="bg-login px-3 py-2 text-white w-36 shadow-lg shadow-black/30 rounded-lg font-semibold hover:bg-[#6C767E] hover:border-button hover:border-[1px] border-[1px] border-button">Login</button>
                        </div>
                    </form>
                    <div class="flex gap-2">
                        <p>Belum punya akun?</p>
                        <a href="{{ route('register') }}" class="text-blue-700 hover:underline">Sign Up</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout.layoutauth>
