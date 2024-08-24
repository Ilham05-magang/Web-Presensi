<x-layout.layout-admin>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="flex items-center justify-between w-full px-10 py-8 text-2xl">
        <h1>{{ $title }}</h1>
    </div>

    <hr class="border-t-2 border-gray-200">
    <div class="p-8 text-left">
        <form action="{{ route('dashboard.pengaturan.editprofile', $data->admin->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-2 gap-5 text-xl font-semibold">
                <div class="flex flex-col gap-6">
                    <div class="flex flex-col gap-1">
                        <label for="name">Nama</label>
                        <input type="text" name="nama" class="rounded-lg" placeholder="{{ $data->admin->nama }}">
                    </div>

                    <div class="flex flex-col gap-1">
                        <label for="telepon">No Telepon</label>
                        <input type="text" name="telepon" class="rounded-lg" placeholder="{{ $data->admin->telepon }}">
                    </div>

                    <div class="flex flex-col gap-1">
                        <label for="username">Username</label>
                        <input type="text" name="username" class="rounded-lg" placeholder="{{ $data->username }}">
                    </div>

                    <div class="flex flex-col gap-1">
                        <label for="email">Email</label>
                        <input type="text" name="email" class="rounded-lg" placeholder="{{ $data->email }}">
                    </div>
                </div>

                <div class="flex flex-col items-end gap-6">
                    <div class="flex flex-col w-full gap-1">
                        <label for="passwordLama">Password Lama</label>
                        <input type="password" name="passwordLama" class="rounded-lg" placeholder="**********">
                    </div>

                    <div class="flex flex-col w-full gap-1">
                        <label for="password">Password Baru</label>
                        <input type="password" name="password" class="rounded-lg" placeholder="**********">
                    </div>

                    <div class="flex flex-col w-full gap-1">
                        <label for="password_confirmation">Konfirmasi Password Baru</label>
                        <input type="password" name="password_confirmation" class="rounded-lg" placeholder="**********">
                    </div>

                    @if (session('success'))
                        @if (session('success') == 'Inputan password lama salah')
                            <div class="w-full mb-1 text-lg text-center text-red-600">
                                {{ session('success') }}
                            </div>
                        @else
                            <div class="w-full mb-1 text-lg text-center text-green-500">
                                {{ session('success') }}
                            </div>
                        @endif
                    @endif


                    @if ($errors->any())
                        <div class="w-full mb-2 text-base text-center text-red-500">
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    @endif

                    <button type="submit" class="px-4 py-3 bg-[#242947] rounded-xl text-white text-center">Ganti</button>
                </div>
            </div>
        </form>
    </div>
</x-layout.layout-admin>
