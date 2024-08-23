<x-layout.layout-reset-password>
    <x-slot:title>Lupa Sandi</x-slot:title>
    <div class="flex gap-3 mb-4 items-center p-4">
        <i class="ri-arrow-left-s-line"></i>
        <a href="{{route('login')}}" class="font-semibold ">Kembali ke halaman utama</a>
    </div>
    @if (session('status'))
        <div class="bg-gray-100 p-5 text-center text-green-400 rounded-md">{{ session('status') }}</div>
    @endif
    @if (session('error'))
        <div class="bg-gray-100 p-5 text-center text-red-600 rounded-md">{{ session('error') }}</div>
    @endif
    <form class="flex items-center h-5/6 justify-center p-4" method="POST" action="{{ route('password.email') }}">
        @csrf
        @method('POST')
        <div class="flex flex-col gap-6 justify-center items-center">
            <div class="text-center font-bold text-[#A4161A] text-2xl">Reset password</div>
            <div class="text-center font-normal max-w-sm w-f">Masukkan email yang ditautkan ke akun Anda.
                Kami akan mengirimkan email konfirmasi
                untuk mengubah kata sandi Anda.</div>
            <input placeholder="example@gmail.com" class="w-full max-w-96 px-4 rounded-3xl" id="email" type="email"
                name="email" value="{{ old('email') }}" required class="border w-full rounded-md shadow-sm">
            <button type="submit" class="max-w-56 w-full rounded-3xl px-4 py-3 bg-[#A4161A] text-white">Continue</button>

        </div>
    </form>
</x-layout.layout-reset-password>
