<x-layout.layout-admin>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="-mx-px -mt-px">
        <div class="flex justify-between gap-1 text-4xl font-medium text-white bg-no-repeat bg-cover rounded-t-xl p-14 bg-karyawan-bg">
            <div >
                <h1>"{{ $datakaryawan->nama }}"</h1>
                <p class="text-lg">Divisi {{ $datakaryawan->divisi->divisi }}</p>
            </div>
            <div>
                <button data-modal-target="editkaryawan"
                    data-modal-toggle="editkaryawan"
                    class="text-white hover:bg-yellow-300 hover:text-gray-800 bg-yellow-400 px-2 rounded-lg py-1.5 text-center text-xl font-medium mr-3">
                    <i class="ri-edit-2-line"></i>
                </button>
            </div>
        </div>
    </div>
    <hr class="mt-2 border-t-2 border-gray-300">
    <div class="grid grid-cols-4 gap-4 p-5 text-sm capitalize">
        <div class="p-5 border-2 border-gray-400 rounded-xl">
            <div class="flex flex-col gap-5">
                <div class="flex flex-col gap-1">
                    <h2>Nama</h2>
                    <input type="text" class="px-3 py-1.5 border-2 border-gray-400 rounded-lg text-sm" value="{{ $datakaryawan->nama }}"/>
                </div>
                <div class="flex flex-col gap-1">
                    <h2>NIP</h2>
                    <input type="text" class="px-3 py-1.5 border-2 border-gray-400 rounded-lg text-sm" value="{{ $datakaryawan->nip }}"/>
                </div>
                <div class="flex flex-col gap-1">
                    <h2>Tempat Lahir</h2>
                    <input type="text" class="px-3 py-1.5 border-2 border-gray-400 rounded-lg text-sm" value="{{ $datakaryawan->tempat_lahir }}"/>
                </div>
                <div class="flex flex-col gap-1">
                    <h2>Tanggal Lahir</h2>
                    <input type="date" class="px-3 py-1.5 border-2 border-gray-400 rounded-lg text-sm" value="{{ $datakaryawan->tanggal_lahir }}"/>
                </div>
                <div class="flex flex-col gap-1">
                    <h2>Nomor HP</h2>
                    <input type="text" class="px-3 py-1.5 border-2 border-gray-400 rounded-lg text-sm" value="{{ $datakaryawan->telepon }}"/>
                </div>
            </div>
        </div>
        <div class="p-5 border-2 border-gray-400 rounded-xl">
            <div class="flex flex-col gap-5">
                <div class="flex flex-col gap-1">
                    <h2>Username</h2>
                    <input type="text" class="px-3 py-1.5 border-2 border-gray-400 rounded-lg text-sm" value="{{ $datakaryawan->akun->username }}"/>
                </div>
                <div class="flex flex-col gap-1">
                    <h2>Email</h2>
                    <input type="text" class="px-3 py-1.5 border-2 border-gray-400 rounded-lg text-sm" value="{{ $datakaryawan->akun->email }}"/>
                </div>
                <div class="flex flex-col gap-1">
                    <h2>Password Baru</h2>
                    <input type="password" class="px-3 py-1.5 border-2 border-gray-400 rounded-lg text-sm" disabled placeholder="isi jika ingin merubah password"/>
                </div>
                <div class="flex flex-col gap-1">
                    <h2>Konfirmasi password</h2>
                    <input type="password" class="px-3 py-1.5 border-2 border-gray-400 rounded-lg text-sm" vdisabled placeholder="ulangi password"/>
                </div>
            </div>
        </div>
    </div>
</x-layout.layout-admin>
