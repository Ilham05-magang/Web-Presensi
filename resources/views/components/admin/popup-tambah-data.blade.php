@props(['title', 'action', 'id', 'data'=>null, 'method'=>null])
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
                <h3 class="mb-5 text-lg font-semibold text-gray-700 dark:text-gray-400">Apakah Anda Yakin ingin menghapus {{ $data->nama }}<br><span class="text-base font-medium text-red-600 font-italic" >(<span class="text-yellow-500">Attention: </span>Mengakibatkan <span class="text-yellow-500">{{ $data->nama }} </span> Pada karyawan terhapus)</span> </h3>
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
                    @if ($method == 'PUT')
                        @method('PUT')
                    @else
                        @method('POST')
                    @endif

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        @if ($title == 'Tambah Kantor' || $title == 'Edit Kantor')
                            <div class="col-span-2">
                                <label for="nama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama</label>
                                <input type="text" name="nama" id="nama"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="{{ $data->nama ?? 'Nama Kantor...' }}"
                                    value="{{ $data->nama ?? '' }}" required>
                            </div>
                            <div class="col-span-2">
                                <label for="link_gmaps" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama</label>
                                <input type="text" name="link_gmaps" id="link_gmaps"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="{{ $data->link_gmaps ?? 'Link Gmaps...' }}"
                                    value="">
                            </div>
                        @else
                            <div class="col-span-2">
                                <label for="nama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama</label>
                                <input type="text" name="nama" id="nama"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="{{ $data->nama ?? 'Nama Shift...' }}"
                                    value="" required> <!-- Ensure value is pre-filled -->
                            </div>
                            <div class="col-span-1">
                                <label for="jam_mulai" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jam Mulai</label>
                                <input type="text" name="jam_mulai" id="time-picker" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="{{ $data->jam_mulai ?? 'Jam mulai...' }}" value="" required >
                            </div>
                            <div class="col-span-1">
                                <label for="jam_istirahat" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jam Istirahat</label>
                                <input type="text" name="jam_istirahat" id="time-picker" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="{{ $data->jam_istirahat ?? 'Jam Istirahat...' }}" value="" required >
                            </div>
                            <div class="col-span-1">
                                <label for="jam_selesai_istirahat" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jam Selesai Istirahat</label>
                                <input type="text" name="jam_selesai_istirahat" id="time-picker" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="{{ $data->jam_selesai_istirahat ?? 'Jam Selesai Istirahat...' }}" value="" required >
                            </div>
                            <div class="col-span-1">
                                <label for="jam_pulang" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jam Pulang</label>
                                <input type="text" name="jam_pulang" id="time-picker" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="{{ $data->jam_pulang ?? 'Jam Pulang...' }}" value="" required >
                            </div>
                        @endif
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
