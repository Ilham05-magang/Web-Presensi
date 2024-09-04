<x-layout.layout-admin>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="flex items-center justify-between w-full px-10 py-8 text-2xl">
        <div class="flex gap-1">
            <a href="{{ route('dashboard.gaji.riwayat') }}"><i
                    class="py-1 pr-3 text-2xl hover:text-blue-600 ri-arrow-left-line"></i></a>
            <h1>{{ $title }} Periode</h1>
        </div>
        <button id="editButtonGaji" data-modal-target="" data-modal-toggle=""
            class="text-white hover:bg-yellow-300 hover:text-gray-800 bg-yellow-400 px-2 rounded-lg py-1.5 text-center text-xl font-medium ">
            <i class="ri-edit-2-line"></i>
        </button>
        {{-- <x-admin.popup-admin title="Ingin Edit Gaji"
            :id="" /> --}}
    </div>
    <hr class="border-t-2 border-gray-200">
    <div class="p-5 capitalize">
        <form action="">
            <div class="relative overflow-x-auto shadow-md rounded-xl rounded-t-lg border-gray-200 p-3">
                <table id="tabelGaji"
                    class="w-full text-sm text-start table-auto rounded-t-lg text-black read-only:text-gray-600 bg-gray-300/70 rtl:text-right">
                    <tbody class="w-full rounded-t-lg">
                        <tr class="p-3 text-black bg-white text-start">
                            <td class="px-1 py-1 ">
                                <input readonly class="w-full text-black h-7 px-1 py-1 text-start text-sm border-none"
                                    type="text" name="" value="Periode" id="">
                            </td>
                            <td class="font-bold px-1 py-1 flex items-center">
                                :
                                <input readonly class="w-full text-black h-7 px-1 py-1 text-start text-sm border-none"
                                    type="text" name="" value="1 Sep - 1 Okt 2024" id="">
                            </td>
                        </tr>
                        <tr class="p-3 text-black bg-white text-start">
                            <td class="px-1 py-1">
                                <input readonly class="w-full text-black h-7 px-1 py-1 text-start text-sm border-none"
                                    type="text" name="" value="Nama" id="">
                            </td>
                            <td class="px-1 py-1 flex items-center">
                                :
                                <input readonly class="w-full text-black h-7 px-1 py-1 text-start text-sm border-none"
                                    type="text" name="" value="Rudi Hartono" id="">
                            </td>
                        </tr>
                        <tr class="p-3 bg-white text-start">
                            <td class="px-1 py-1 text-black">
                                <input readonly class="w-full text-black h-7 px-1 py-1 text-start text-sm border-none"
                                    type="text" name="" value="Metode Pembayaran" id="">
                            </td>
                            <td class="px-1 py-1 flex items-center">
                                :
                                <input readonly
                                    class="editgaji w-full bg-white text-black h-7 px-1 py-1 text-start text-sm border-none"
                                    type="text" name="" value="Transfer" id="">
                            </td>
                        </tr>
                        <tr class="uppercase bg-[#242947] py-14 rounded-t-lg">
                            <td class="border-[#242947] rounded-tl-lg">
                                <input readonly
                                    class="rounded-tl-lg bg-[#242947] text-white w-full h-7 text-sm border-none"
                                    type="text" name="" value="Total Shift" id="">
                            </td>
                            <td class="text-end border-[#242947] rounded-tr-lg">
                                <input readonly
                                    class="bg-[#242947] rounded-t-lg text-white w-full h-7 text-end text-sm border-none"
                                    type="text" name="" value="26" id="">
                            </td>
                        </tr>
                        <tr class="text-start">
                            <td class="border-[#242947] border-[1px]">
                                <input readonly class="editgaji bg-gray-300/70 w-full h-7 text-sm border-none"
                                    type="text" name="" value="Terlambat" id="">
                            </td>
                            <td class="text-end border-[#242947] border-[1px]">
                                <input readonly class=" bg-gray-300/70 w-full h-7 text-end text-sm border-none"
                                    type="text" name="" value="2" id="">
                            </td>
                        </tr>
                        <tr class="text-start">
                            <td class=" border-[#242947] border-[1px]">
                                <input readonly class="editgaji bg-gray-300/70 w-full h-7 text-sm border-none"
                                    type="text" name="" value="Tidak Hadir" id="">
                            </td>
                            <td class="text-end border-[#242947] border-[1px]">
                                <input readonly class=" bg-gray-300/70 w-full h-7 text-end text-sm border-none"
                                    type="text" name="" value="0" id="">
                            </td>
                        </tr>
                        <tr class="text-start">
                            <td class=" border-[#242947] border-[1px]">
                                <input readonly class="editgaji bg-gray-300/70 text-sm w-full h-7 border-none"
                                    type="text" name="" value="Ijin Pulang Awal" id="">
                            </td>
                            <td class="text-end border-[#242947] border-[1px]">
                                <input readonly class="bg-gray-300/70 w-full h-7 text-end text-sm border-none"
                                    type="text" name="" value="1" id="">
                            </td>
                        </tr>
                        <tr class="text-start">
                            <td class=" border-[#242947] border-[1px]">
                                <input readonly class="editgaji w-full h-7 bg-gray-300/70 text-sm border-none"
                                    type="text" name="" value="Total Hadir Disiplin" id="">
                            </td>
                            <td class="text-end border-[#242947] border-[1px]">
                                <input readonly class="bg-gray-300/70 w-full h-7 text-end text-sm border-none"
                                    type="text" name="" value="20" id="">
                            </td>
                        </tr>
                        <tr class="text-start">
                            <td class=" border-[#242947] border-[1px]">
                                <input readonly class="editgaji bg-gray-300/70 text-sm w-full h-7 border-none"
                                    type="text" name="" value="Total Kehadiran" id="">
                            </td>
                            <td class="text-end border-[#242947] border-[1px]">
                                <input readonly class="bg-gray-300/70 w-full h-7 text-end text-sm border-none"
                                    type="text" name="" value="30" id="">
                            </td>
                        </tr>
                        <tr class="bg-white ">
                            <td class="py-2 px-3 text-black font-bold text-base">Honorarium</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr class="p-3 border-[#242947] border-[1px]">
                            <td class="bg-gray-300/70 flex gap-1 items-center editgaji">
                                <input readonly class="editgaji w-2/5 bg-gray-300/70  h-7 text-sm border-none"
                                    type="text" name="" value="Honor Utama" id="">
                                (
                                <input readonly
                                    class="editgaji w-1/5 text-center bg-gray-300/70 px-0 h-7 text-sm border-none"
                                    type="text" name="" value="" id="">
                                x
                                <input readonly
                                    class="editgaji  w-2/5 bg-gray-300/70 px-0 text-center h-7 text-sm border-none"
                                    type="text" name="" value="Rp. 70.000" id="">)
                            </td>
                            <td class="border-[#242947] border-[1px]">
                                <input readonly
                                    class="text-black bg-gray-300/70 text-end w-full h-7 text-sm border-none"
                                    type="text" name="" value="???" id="">
                        </tr>
                        <tr class="bg-white">
                            <td class="px-3 pt-3 text-black">Yogyakarta,</td>
                            <td class="w-3/5 pt-3 text-black font-bold text-base">Note:</td>
                        </tr>
                        <tr class="bg-white">
                            <td></td>
                            <td>
                                <textarea name="" id="" placeholder="Masukkan Note" readonly rows="4"
                                    class="text-sm editgaji bg-white border-[#242947] border-[1px] w-full px-1"></textarea>
                            </td>
                        </tr>
                        <tr class="bg-white">
                            <td class="px-3 text-black">HRD</td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="flex justify-end gap-3 py-4">
                <button type="submit" id="submitForm"
                    class=" w-32 hidden text-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Simpan
                </button>
                <div id="BatalEdit"
                    class=" cursor-pointer w-32 hidden text-center text-white bg-red-600 hover:bg-red-500 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-800 dark:hover:bg-red-700 dark:focus:ring-red-800">
                    Batal
                </div>
            </div>
        </form>
    </div>
    <x-admin.popup-gaji title="Tambah Default Gaji" id="tambahdefaultgaji" action=""
        method="POST"></x-admin.popup-gaji>

    <script>
        const editGajiButton = document.querySelector('#editButtonGaji');
        const editGajiStatus = document.querySelectorAll('.editgaji');
        const tabelGaji = document.querySelector('#tabelGaji');

        console.log(editGajiButton);

        editGajiButton.addEventListener('click', function() {
            editGajiButton.disabled = true; // Disable the edit button
            submitForm.classList.remove('hidden');
            BatalEdit.classList.remove('hidden');

            editGajiStatus.forEach(function(element) {
                if (element.tagName === 'INPUT' || element.tagName === 'TEXTAREA') {
                    element.removeAttribute('readonly'); // Remove readonly attribute
                }
                element.classList.remove('read-only:text-gray-600');
                element.classList.remove('bg-gray-300/70');
                element.classList.add('bg-blue-100');
            });
        });

        BatalEdit.addEventListener('click', function() {
            editGajiButton.disabled = false; // Enable the edit button again
            submitForm.classList.add('hidden');
            BatalEdit.classList.add('hidden');

            editGajiStatus.forEach(function(element) {
                if (element.tagName === 'INPUT') {
                    element.setAttribute('readonly', true); // Set readonly attribute
                }
                element.classList.add('read-only:text-gray-600');
                element.classList.add('bg-gray-300/70');
                element.classList.remove('bg-blue-100');
                if (element.tagName === 'TEXTAREA') {
                    element.classList.add('bg-white');  
                    element.classList.remove('bg-gray-300/70');
                    element.setAttribute('readonly', true); // Set readonly attribute
                }
                
            });
        });
    </script>
</x-layout.layout-admin>
