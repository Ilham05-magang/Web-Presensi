@php
    use Carbon\Carbon;
@endphp

<x-layout.layout-admin>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="-mx-px -mt-px shadow-xl shadow-[#242947]/40">
        <div class="flex justify-between gap-1 px-8 text-4xl font-medium text-white bg-no-repeat bg-cover py-14 rounded-t-xl bg-karyawan-bg">
            <div class="flex items-center gap-3">
                <a href="{{ route('dashboard.karyawan') }}"><i class="py-1 pr-3 text-2xl hover:text-blue-600 ri-arrow-left-line"></i></a>
                <div>
                    <h1>"{{ $datakaryawan->nama }}"</h1>
                    <p class="text-lg">Divisi {{ $datakaryawan->divisi->divisi ?? '--//--' }}</p>
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
                <div class="flex flex-col gap-1">
                    <label>Password Baru</label>
                    <input type="password" name="password" disabled class="editstatus px-3 py-1.5 border-2 border-gray-400 rounded-lg text-sm" disabled placeholder="Ubah Password"/>
                </div>
                <div class="flex flex-col gap-1">
                    <label>Konfirmasi password</label>
                    <input type="password" name="password_confirmation" disabled class="editstatus px-3 py-1.5 border-2 border-gray-400 rounded-lg text-sm" disabled placeholder="Ulangi Password"/>
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
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '{{ session('success') }}',
            });
        </script>
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
</x-layout.layout-admin>

<script>
    const buttonEdit = document.getElementById('buttonEdit');
    const editStatusElements = document.querySelectorAll('.editstatus');
    const buttonfirst = document.getElementById('buttonfirst');
    const submitForm = document.getElementById('submitForm');
    const BatalEdit = document.getElementById('BatalEdit');

    buttonEdit.addEventListener('click', function() {
        buttonfirst.disabled = !buttonfirst.disabled;
        submitForm.classList.remove('hidden');
        BatalEdit.classList.remove('hidden');
        buttonfirst.classList.remove('hover:bg-yellow-300', 'hover:text-gray-800');
        buttonfirst.classList.add('bg-yellow-100');

        editStatusElements.forEach(function(element) {
            if (element.tagName === 'INPUT' || element.tagName === 'SELECT') {
                element.disabled = !element.disabled;
            }
        });
    });

    BatalEdit.addEventListener('click', function() {
        buttonfirst.disabled = !buttonfirst.disabled;
        submitForm.classList.add('hidden');
        BatalEdit.classList.add('hidden');

        buttonfirst.classList.add('hover:bg-yellow-300', 'hover:text-gray-800');
        buttonfirst.classList.remove('bg-yellow-100');
        editStatusElements.forEach(function(element) {
            if (element.tagName === 'INPUT' || element.tagName === 'SELECT') {
                element.disabled = !element.disabled;
            }
        });
    });
</script>
