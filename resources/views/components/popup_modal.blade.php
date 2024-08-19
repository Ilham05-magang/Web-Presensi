@props(['title', 'type' => null])
<!-- Main modal -->

@if ($type == 'izin')
    <div id="modal-izin" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-md p-4 max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow pt-3 dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-bold text-center w-full text-gray-900 dark:text-white">
                        Izin
                    </h3>
                </div>
                <!-- Modal body -->
                <form class="p-5 flex flex-col gap-1">
                    <div class="font-medium text-base"> Alasan izin</div>
                    <textarea id="description" rows="4"
                        class="resize-none h-40 block p-2.5 w-full text-sm placeholder:font-medium selection: bg-[#F2F2F2] rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Tuliskan keterangan (opsional)"></textarea>
                    <div class="font-medium text-base "> Bukti foto</div>
                    <p class="text-[10px] font-medium text-[#00000080]">Bukti fisik dapat dikumpulkan ke HR kantor
                        masing-masing pada hari berikutnya</p>
                    <a href="#" class="text-[#0019FF] font-bold text-[10px]">Contoh Klik Disini</a>
                    <input type="text"
                        class=" text-sm placeholder:font-medium bg-[#F2F2F2] rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Masukan link Gdrive">
                    <div class="flex items-center justify-evenly mt-3">
                        <button type="submit"
                            class=" text-[#858585] hover:text-white inline-flex items-center hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Cancel
                        </button>
                        <button type="submit"
                            class=" text-white inline-flex items-center bg-red-button hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@else
    <div id="modal-add" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow p-4 dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between rounded-t dark:border-gray-600">
                    <h3 class="text-base font-bold text-center w-full text-gray-900 dark:text-white">
                        Keterangan
                    </h3>
                </div>
                <!-- Modal body -->
                <form class="p-5 flex flex-col gap-4">
                    <textarea id="description" rows="4"
                        class="resize-none h-40 block p-2.5 w-full text-sm placeholder:font-bold font-bold text-[#00000080] bg-[#F2F2F2] rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Tuliskan keterangan (opsional)"></textarea>
                    <div class="flex items-end justify-end">
                        <button type="submit"
                            class=" text-white inline-flex items-center bg-red-button hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endif
