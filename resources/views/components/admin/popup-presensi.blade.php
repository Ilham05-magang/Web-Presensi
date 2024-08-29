@props(['title', 'action'=>null, 'id', 'data'=>null, 'method'=>null, 'tanggal'=>null, 'nama'=>null])
@if ($title == 'delete')
{{-- model delete --}}
<div id="{{ $id }}" tabindex="-1"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-2rem)] max-h-full">
    <div class="relative w-full max-w-xl max-h-full p-4">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <div class="p-4 text-center md:p-5">
                <svg class="w-12 h-12 mx-auto mb-4 text-gray-400 dark:text-gray-200" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                <h3 class="mb-5 text-lg font-semibold text-gray-700 dark:text-gray-400">Apakah Anda Yakin ingin
                    menghapus Absensi {{ $data->nama }} <br><span
                        class="text-base font-medium text-red-600 font-italic">(<span class="text-yellow-500">Attention:
                        </span>Mengakibatkan Data Absensi Karyawan <span class="text-yellow-500">{{ $data->nama }}
                        </span> pada tanggal <span class="text-yellow-500">{{ $tanggal }}</span> terhapus)</span> </h3>
                <form action="{{ $action }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                        Hapus
                    </button>
                </form>
                <button data-modal-hide="{{ $id }}" type="button"
                    class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                    Batal</button>
            </div>
        </div>
    </div>
</div>
@else
<!-- Main modal -->
<div id="{{ $id }}" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 mt-5 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-xl max-h-full p-4">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 border-b rounded-t md:p-5 dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    {{ $title }} {{ $nama }}
                    <p class="pt-1">{{ $tanggal }}</p>
                </h3>
                <button type="button"
                    class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="{{ $id }}">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            @if ($title == "Preview Absensi")
            <div class="p-4 md:p-5">
                <div class="grid grid-cols-2 gap-4 mb-4 text-left ">
                    <div class="col-span-1">
                        <h2
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Status Kehadiran
                        </h2>
                        <div
                            class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <p>Izin</p>
                        </div>
                    </div>
                    <div class="col-span-1">
                        <h2
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Keterangan
                        </h2>
                        <div
                            class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <p>{{ $data->keterangan ?? 'Tidak Ada Keterangan' }}</p>
                        </div>
                    </div>
                    <div class="col-span-2 fileInputContainer">
                        <h2
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            File Pendukung
                        </h2>
                        @if (str_ends_with($data->file_input, '.pdf'))
                            <iframe src="{{ asset('storage/absensi_files/' . basename($data->file_input)) }}"
                                width="100%" height="500px" style="border: none;"></iframe>
                        @else
                            <img
                                src="{{ asset('storage/absensi_files/' . basename($data->file_input)) }}"
                                alt="Tidak Ada File Pendukung">
                        @endif
                    </div>
                </div>
            </div>
            @else
            <div class="p-4 md:p-5">
                <form action="{{ $action }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if ($method == "POST")
                    @method('POST')
                    @else
                    @method('PUT')
                    @endif
                    @if ($title == "Edit Tidak Masuk" || $data->status_kehadiran == 'Izin' || $data->status_kehadiran =='Tidak Masuk' || $title == "Edit Status Kehadiran")
                    <div class="grid grid-cols-2 gap-4 mb-4 text-left">
                        <div class="col-span-2">
                            <label for="status_kehadiran"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Status Kehadiran
                            </label>
                            <select name="status_kehadiran"
                                    class="status_kehadiran bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option value="Tidak Masuk" {{ $data->status_kehadiran == 'Tidak Masuk' ? 'selected' : '' }}>Tidak Masuk</option>
                                <option value="Izin" {{ $data->status_kehadiran == 'Izin' ? 'selected' : '' }}>Izin</option>
                            </select>
                        </div>
                        <div class="col-span-2">
                            <label for="keterangan"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Keterangan</label>
                            <textarea name="keterangan" rows="2"
                                class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Keterangan..."></textarea>
                        </div>
                        <!-- Input file yang disembunyikan -->
                        <div class="col-span-2 fileInputContainer">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                for="file_input">Upload file</label>
                            <input
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                aria-describedby="file_input_help" id="file_input" type="file" name="file_input">
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">PNG, JPG or
                                PDF (Max. 1 <i class="fas fa-meh-blank "></i> ).</p>
                        </div>
                    </div>
                    @else
                    <div class="grid grid-cols-3 gap-4 mb-4">
                        <div class="col-span-1">
                            <label for="jam_mulai"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jam Mulai</label>
                            <input type="text" name="jam_mulai" id="time-picker"
                                class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="{{ $data->jam_mulai ?? 'Jam mulai...' }}" />
                        </div>
                        <div class="col-span-1">
                            <label for="jam_pulang"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jam Pulang</label>
                            <input type="text" name="jam_pulang" id="time-picker"
                                class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="{{ $data->jam_pulang ?? 'Jam Pulang...' }}" />
                        </div>
                        <div class="col-span-1">
                            <label for="jam_istirahat"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jam
                                Istirahat</label>
                            <input type="text" name="jam_istirahat" id="time-picker"
                                class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="{{ $data->jam_istirahat ?? 'Jam Istirahat...' }}" />
                        </div>
                        <div class="col-span-1">
                            <label for="jam_selesai_istirahat"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jam Selesai
                                Istirahat</label>
                            <input type="text" name="jam_selesai_istirahat" id="time-picker"
                                class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="{{ $data->jam_selesai_istirahat ?? 'Jam Selesai Istirahat...' }}" />
                        </div>
                        <div class="col-span-1">
                            <label for="jam_izin"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jam Izin</label>
                            <input type="text" name="jam_izin" id="time-picker"
                                class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="{{ $data->jam_izin ?? 'Jam izin...' }}" />
                        </div>
                        <div class="col-span-1">
                            <label for="jam_selesai_izin"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jam Selesai
                                Izin</label>
                            <input type="text" name="jam_selesai_izin" id="time-picker"
                                class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="{{ $data->jam_selesai_izin ?? 'jam_selesai_izin...' }}" />
                        </div>
                    </div>
                    @endif
                    <button type="submit"
                        class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Simpan
                    </button>
                </form>
            </div>
            @endif
        </div>
    </div>
</div>
@endif
