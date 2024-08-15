<x-layout.layoutlogin>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="grid md:grid-cols-2 grid-cols-1 ">
        <div class="md:block hidden w-full bg-login h-screen rounded-br-[100px] items-center md:flex justify-center">
            <img src="assets/logo.png" class="" alt="">
        </div>
        <div class="w-full bg-login h-screen">
            <div class="bg-white h-screen w-full rounded-tl-[100px] flex justify-center">
                <div class=" flex flex-col gap-6 items-center justify-center w-full">
                    <div class="flex flex-col items-center">
                        <i class="ri-account-circle-line text-2xl"></i>
                        <h1 class="font-bold text-3xl">Sign Up</h1>
                    </div>
                    <form action="" class="flex flex-col gap-6 w-full px-5 md:px-0 max-w-lg">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                            <div class="flex flex-col gap-5">
                                <div class="flex flex-col gap-1">
                                    <label for="" class="font-semibold" >Nama Lengkap*</label>
                                    <input type="text" class="rounded-lg" placeholder="Masukkan username / email">
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label for="" class="font-semibold" >Email*</label>
                                    <input type="text" class="rounded-lg" placeholder="Masukkan username / email">
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label for="" class="font-semibold" >Username*</label>
                                    <input type="text" class="rounded-lg" placeholder="Masukkan username / email">
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label for="" class="font-semibold" >No Telp*</label>
                                    <input type="text" class="rounded-lg" placeholder="Masukkan username / email">
                                </div>
                            </div>
                            <div class="flex flex-col gap-5">
                                <div class="flex flex-col gap-1">
                                    <label for="" class="font-semibold" >Tempat, Tanggal Lahir*</label>
                                    <input type="text" class="rounded-lg" placeholder="Masukkan username / email">
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label for="" class="font-semibold" >Asal Sekolah/Kampus*</label>
                                    <input type="text" class="rounded-lg" placeholder="Masukkan username / email">
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label for="" class="font-semibold">Password*</label>
                                    <input type="password" class="rounded-lg" placeholder="Masukkan password" >
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label for="" class="font-semibold">Konfirmasi Password*</label>
                                    <input type="password" class="rounded-lg" placeholder="Masukkan password" >
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-center">
                            <button class="bg-button px-3 py-2 text-white w-36 shadow-lg shadow-black/30 rounded-lg font-semibold hover:bg-[#ADB5BD] hover:border-button hover:border-[1px] border-[1px] border-button">Login</button>
                        </div>
                    </form>
                    <div class="flex gap-2">
                        <p>Sudah punya akun?</p>
                        <a href="/login" class="text-blue-700 hover:underline">Daftar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout.layoutlogin>
