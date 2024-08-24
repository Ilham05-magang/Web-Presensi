@props(['title', 'action', 'id','data', 'datadivisi', 'datakantor', 'datashift'])
@if ($title == 'delete')
{{-- model delete --}}
<div id="{{ $id }}" tabindex="-1"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-xl max-h-full p-4">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <div class="p-4 text-center md:p-5">
                <svg class="w-12 h-12 mx-auto mb-4 text-gray-400 dark:text-gray-200" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                <h3 class="mb-5 text-lg font-semibold text-gray-700 dark:text-gray-400">Apakah Anda Yakin ingin menghapus Karyawan {{ $data }}? <br><span class="text-base font-medium text-red-600 font-italic" >(<span class="text-yellow-500">Attention: </span>Mengakibatkan Data Akun, Data Absensi, dan Data Karyawan terhapus untuk karyawan <span class="{{ $data }}"></span>)</span></h3>
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
  <div id="{{ $id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
      <div class="relative w-full max-w-md max-h-full p-4">
          <!-- Modal content -->
          <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
              <!-- Modal header -->
              <div class="flex items-center justify-between p-4 border-b rounded-t md:p-5 dark:border-gray-600">
                  <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                      {{ $title }}
                  </h3>
                  <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="{{ $id }}">
                      <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                      </svg>
                      <span class="sr-only">Close modal</span>
                  </button>
              </div>
              <!-- Modal body -->
              <div class="p-4 md:p-5">
                <form action="{{ $action }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div class="col-span-2">
                            <label for="nama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama</label>
                            <input type="text" name="nama" id="nama"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="{{ $data->nama }}"
                                value="{{ old('nama', $data->nama) }}"> <!-- Ensure value is pre-filled -->
                        </div>

                        <div class="col-span-1 sm:col-span-1">
                            <label for="kantor_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kantor</label>
                            <select id="kantor_id" name="kantor_id"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                @if (!$data->kantor_id)
                                    <option value="" disabled selected>Silakan pilih</option>
                                @endif
                                @foreach ($datakantor as $kantor)
                                    <option value="{{ $kantor->id }}"
                                        {{ $kantor->id == $data->kantor_id ? 'selected' : '' }}>
                                        {{ $kantor->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-span-1 sm:col-span-1">
                            <label for="shift_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Shift</label>
                            <select id="shift_id" name="shift_id"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                @if (!$data->shift_id)
                                    <option value="" disabled selected>Silakan pilih</option>
                                @endif
                                @foreach ($datashift as $shift)
                                    <option value="{{ $shift->id }}"
                                        {{ $shift->id == $data->shift_id ? 'selected' : '' }}>
                                        {{ $shift->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-span-1 sm:col-span-1">
                            <label for="divisi_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Divisi</label>
                            <select id="divisi_id" name="divisi_id"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                @if (!$data->divisi_id)
                                    <option value="" disabled selected>Silakan pilih</option>
                                @endif
                                @foreach ($datadivisi as $divisi)
                                    <option value="{{ $divisi->id }}"
                                        {{ $divisi->id == $data->divisi_id ? 'selected' : '' }}>
                                        {{ $divisi->divisi }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-span-1 sm:col-span-1">
                            <label for="status_akun" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status Akun</label>
                            <select id="status_akun" name="status_akun"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                @if ($data->akun->status_akun == 1 )
                                    <option selected="1" value="1">Akun Aktif</option>
                                    <option value="0">Non Aktifkan</option>
                                @else
                                    <option selected="0" value="0">Akun Belum aktif</option>
                                    <option value="1">Aktifkan Akun</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Simpan
                    </button>
                </form>
              </div>
          </div>
      </div>
  </div>
@endif
