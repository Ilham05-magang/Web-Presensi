<x-layout.layout-admin>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="-mx-px -mt-px shadow-xl shadow-[#242947]/40">
        <div class="flex justify-between gap-1 px-8 text-4xl font-medium text-white bg-no-repeat bg-cover py-14 rounded-t-xl bg-karyawan-bg">
            <div class="flex items-center gap-3">
                <a href="{{ route('dashboard.karyawan') }}"><i class="py-1 pr-3 text-2xl hover:text-blue-600 ri-arrow-left-line"></i></a>
                <div>
                    <h1>"{{ $datakaryawan->nama }}"</h1>
                    <p class="text-lg">Divisi {{ $datakaryawan->divisi->divisi ?? '--\\--' }}</p>
                </div>
            </div>
            <div>
                <button id="buttonfirst" data-modal-target="EditKaryawan{{ $datakaryawan->id }}" data-modal-toggle="EditKaryawan{{ $datakaryawan->id }}"
                    class="text-white hover:bg-yellow-300 hover:text-gray-800 bg-yellow-400 px-2 rounded-lg py-1.5 text-center text-xl font-medium mr-3">
                    <i class="ri-edit-2-line"></i>
                </button>
                <x-admin.popup-admin title="Ingin Edit Karyawan"
                    :id="'EditKaryawan' . $datakaryawan->id" :data="$datakaryawan->nama" />
            </div>
        </div>
    </div>
    <form class="grid grid-cols-4 gap-4 p-5 text-sm capitalize" action="{{ route('dashboard.editkaryawan',$datakaryawan->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="p-5 border-2 border-gray-400 rounded-xl">
            <div class="flex flex-col gap-5">
                <div class="flex flex-col gap-1">
                    <label>Nama</label>
                    <input type="text" name="nama" disabled class="editstatus px-3 py-1.5 border-2 border-gray-400 rounded-lg text-sm" value="{{ $datakaryawan->nama }}"/>
                </div>
                <div class="flex flex-col gap-1">
                    <label>NIP</label>
                    <input type="text" name="nip" disabled class="editstatus px-3 py-1.5 border-2 border-gray-400 rounded-lg text-sm" value="{{ $datakaryawan->nip }}"/>
                </div>
                <div class="flex flex-col gap-1">
                    <label>Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" disabled class="editstatus px-3 py-1.5 border-2 border-gray-400 rounded-lg text-sm" value="{{ $datakaryawan->tempat_lahir }}"/>
                </div>
                <div class="flex flex-col gap-1">
                    <label>Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" disabled class="editstatus px-3 py-1.5 border-2 border-gray-400 rounded-lg text-sm" value="{{ $datakaryawan->tanggal_lahir }}"/>
                </div>
                <div class="flex flex-col gap-1">
                    <label>Nomor HP</label>
                    <input type="text" name="telepon" disabled class="editstatus px-3 py-1.5 border-2 border-gray-400 rounded-lg text-sm" value="{{ $datakaryawan->telepon }}"/>
                </div>
            </div>
        </div>
        <div class="p-5 border-2 border-gray-400 rounded-xl">
            <div class="flex flex-col gap-5">
                <div class="flex flex-col gap-1">
                    <label>Username</label>
                    <input type="text" disabled class="editstatus px-3 py-1.5 border-2 border-gray-400 rounded-lg text-sm" value="{{ $datakaryawan->akun->username }}"/>
                </div>
                <div class="flex flex-col gap-1">
                    <label>Email</label>
                    <input type="text" disabled class="editstatus px-3 py-1.5 border-2 border-gray-400 rounded-lg text-sm" value="{{ $datakaryawan->akun->email }}"/>
                </div>
                <div class="relative flex flex-col gap-1">
                    <label for="password" class="font-semibold">Password Baru</label>
                    <input type="password" id="password" name="password" disabled class="text-sm rounded-lg editstatus" placeholder="Ubah Password" >
                    <button type="button" id="togglePassword" disabled class="absolute inset-y-0 flex items-center editstatus top-6 right-3">
                        <i id="eyeIcon" class="ri-eye-off-fill"></i>
                    </button>
                </div>
                <div class="relative flex flex-col gap-1">
                    <label for="password_confirmation" class="font-semibold">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" disabled id="password_confirmation" class="text-sm rounded-lg editstatus" placeholder="Ulangi Password">
                    <button type="button" id="toggleKonfirmasiPassword" disabled class="absolute inset-y-0 flex items-center editstatus top-6 right-3">
                        <i id="eyeIconKonfirmasi" class="ri-eye-off-fill"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="p-5 border-2 border-gray-400 rounded-xl">
            <div class="flex flex-col gap-5">
                <div class="flex flex-col gap-1">
                    <label>Tanggal Masuk</label>
                        <input type="date" name="tanggal_masuk" disabled class="editstatus px-3 py-1.5 border-2 border-gray-400 rounded-lg text-sm" value="{{ $datakaryawan->tanggal_masuk }}"/>
                </div>
                <div class="flex flex-col gap-1">
                    <label>Tanggal Keluar</label>
                    <input type="date" name="tanggal_keluar" disabled class="editstatus px-3 py-1.5 border-2 border-gray-400 rounded-lg text-sm" value="{{ $datakaryawan->tanggal_keluar }}"/>
                </div>
                <div class="flex flex-col gap-1">
                    <label for="divisi_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Divisi</label>
                    <select id="divisi_id" name="divisi_id" disabled
                        class="editstatus bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        @if (!$datakaryawan->divisi_id)
                            <option value="" disabled selected>Silakan pilih</option>
                        @endif
                        @foreach ($datadivisi as $divisi)
                            <option value="{{ $divisi->id }}"
                                {{ $divisi->id == $datakaryawan->divisi_id ? 'selected' : '' }}>
                                {{ $divisi->divisi }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="flex flex-col gap-1">
                    <label for="shift_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Shift</label>
                    <select id="shift_id" name="shift_id" disabled
                        class="editstatus bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        @if (!$datakaryawan->shift_id)
                            <option value="" disabled selected>Silakan pilih</option>
                        @endif
                        @foreach ($datashift as $shift)
                            <option value="{{ $shift->id }}"
                                {{ $shift->id == $datakaryawan->shift_id ? 'selected' : '' }}>
                                {{ $shift->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="p-5 border-2 border-gray-400 rounded-xl">
            <div class="flex flex-col gap-5">
                <div class="flex flex-col gap-1">
                    <label for="os" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">OS</label>
                    <select id="os" name="os" disabled
                        class="editstatus bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        <option value="Windows" {{ $datakaryawan->akun->os == 'Windows' ? 'selected' : '' }}>Windows</option>
                        <option value="macOS" {{ $datakaryawan->akun->os == 'macOS' ? 'selected' : '' }}>macOS</option>
                        <option value="Ubuntu" {{ $datakaryawan->akun->os == 'Ubuntu' ? 'selected' : '' }}>Ubuntu</option>
                        <option value="Linux" {{ $datakaryawan->akun->os == 'Linux' ? 'selected' : '' }}>Linux</option>
                        <option value="Android" {{ $datakaryawan->akun->os == 'Android' ? 'selected' : '' }}>Android</option>
                        <option value="IOS" {{ $datakaryawan->akun->os == 'IOS' ? 'selected' : '' }}>IOS</option>
                    </select>
                </div>
                <div class="flex flex-col gap-1">
                    <label for="browser" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Browser</label>
                    <select id="browser" name="browser" disabled
                        class="editstatus bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        <option value="Chrome" {{ $datakaryawan->akun->browser == 'Chrome' ? 'selected' : '' }}>Chrome</option>
                        <option value="Edge" {{ $datakaryawan->akun->browser == 'Edge' ? 'selected' : '' }}>Edge</option>
                        <option value="Firefox" {{ $datakaryawan->akun->browser == 'Firefox' ? 'selected' : '' }}>Firefox</option>
                        <option value="IE" {{ $datakaryawan->akun->browser == 'IE' ? 'selected' : '' }}>IE</option>
                        <option value="Safari" {{ $datakaryawan->akun->browser == 'Safari' ? 'selected' : '' }}>Safari</option>
                        <option value="Opera" {{ $datakaryawan->akun->browser == 'Opera' ? 'selected' : '' }}>Opera</option>
                    </select>
                </div>
                <div class="flex flex-col gap-1">
                    <label for="kantor_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kantor</label>
                    <select id="kantor_id" name="kantor_id" disabled
                        class="editstatus bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        @if (!$datakaryawan->kantor_id)
                            <option value="" disabled selected>Silakan pilih</option>
                        @endif
                        @foreach ($datakantor as $kantor)
                            <option value="{{ $kantor->id }}"
                                {{ $kantor->id == $datakaryawan->kantor_id ? 'selected' : '' }}>
                                {{ $kantor->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="flex flex-col gap-1">
                    <label for="status_akun" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status Akun</label>
                    <select id="status_akun" name="status_akun" disabled
                        class="editstatus bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        @if ($datakaryawan->akun->status_akun == 1 )
                            <option selected="1" value="1">Akun Aktif</option>
                            <option value="0">Non Aktifkan</option>
                        @else
                            <option selected="0" value="0">Akun Belum aktif</option>
                            <option value="1">Aktifkan Akun</option>
                        @endif
                    </select>
                </div>
            </div>
        </div>
        <div class="flex gap-5">
            <button type="submit" id="submitForm" class=" w-32 hidden text-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Simpan
            </button>
            <div id="BatalEdit" class=" cursor-pointer w-32 hidden text-center text-white bg-red-600 hover:bg-red-500 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-800 dark:hover:bg-red-700 dark:focus:ring-red-800">
                Batal
            </div>
        </div>
    </form>
</x-layout.layout-admin>
