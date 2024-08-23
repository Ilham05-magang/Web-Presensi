<x-layout.layoutauth>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="grid md:grid-cols-2 grid-cols-1 ">
        <div class="hidden w-full bg-login h-screen rounded-br-[100px] items-center md:flex justify-center">
            <img src="assets/logo.png" class="" alt="">
        </div>
        <div class="w-full bg-login h-screen">
            <div class="bg-white h-screen w-full rounded-tl-[100px] flex justify-center">
                <div class=" flex flex-col gap-6 items-center justify-center w-full">
                    <div class="flex flex-col items-center">
                        @if (session('error'))
                            <div class="bg-gray-100 p-5 text-red-600 rounded-md">
                                {{ session('error') }}
                            </div>
                        @endif
                        @if (session('success'))
                            <div class="bg-gray-100 p-5 text-green-400 rounded-md">
                                {{ session('success') }}
                            </div>
                        @endif
                        <i class="ri-lock-2-fill text-2xl md:block hidden"></i>
                        <img src="assets/logo.png" class="bg-login rounded-full p-2 md:hidden block w-12"
                            alt="">
                        <h1 class="font-bold text-4xl">Log In</h1>
                    </div>
                    <form action="/login" method="POST" class="flex flex-col gap-6 w-full px-5 md:px-0 max-w-xs">
                        @method('POST')
                        @csrf
                        <div class="flex flex-col gap-4 text-base">
                            <div class="flex flex-col gap-1">
                                <label for="" class="font-semibold">Username/Email</label>
                                <input type="text" name="email" class="rounded-lg"
                                    placeholder="Masukkan username / email">
                            </div>
                            <div class="flex flex-col gap-1">
                                <label for="" class="font-semibold">Password</label>
                                <input type="password" name="password" class="rounded-lg"
                                    placeholder="Masukkan password">
                            </div>
                        </div>
                        <div class="flex justify-between text-sm">
                            <div class="flex gap-2 items-center">
                                <input type="checkbox" name="remember_me" class="rounded-sm" id="checkbox">
                                <label for="remember">Ingat Saya</label>
                            </div>
                            <div class="flex gap-1">
                                <p>Lupa Kata Sandi?</p>
                                <a href="" class="text-red-700 hover:underline">Reset</a>
                            </div>
                        </div>
                        <div class="flex justify-center">
                            <button type="submit"
                                class="bg-button px-3 py-2 text-white w-36 shadow-lg shadow-black/30 rounded-lg font-semibold hover:bg-[#ADB5BD] hover:border-button hover:border-[1px] border-[1px] border-button">Login</button>
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
