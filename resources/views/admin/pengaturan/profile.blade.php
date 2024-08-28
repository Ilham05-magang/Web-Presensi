<x-layout.layout-admin>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="flex items-center justify-between w-full px-10 py-8 text-2xl">
        <h1>{{ $title }}</h1>
    </div>

    <hr class="border-t-2 border-gray-200">
    <div class="p-8 text-left capitalize">
        <form action="{{ route('dashboard.pengaturan.editprofile', $data->admin->id) }}" method="POST">
            @csrf
            @method('PUT')
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
                            icon: 'success',
                            title: 'Success',
                            text: '{{ session('success') }}',
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

                    <button type="submit" class="px-5 py-1.5 bg-[#242947] rounded-xl text-white text-lg font-medium text-center hover:bg-[#5B6390]">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</x-layout.layout-admin>
