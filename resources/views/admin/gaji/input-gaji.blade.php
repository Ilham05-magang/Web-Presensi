<x-layout.layout-admin>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="flex items-center justify-between w-full px-10 py-8 text-2xl">
        <div class="flex gap-1">
            <a href="{{ route('dashboard.gaji') }}"><i
                    class="py-1 pr-3 text-2xl hover:text-blue-600 ri-arrow-left-line"></i></a>
            <h1>{{ $title }} Juleha</h1>
        </div>
        {{-- <button data-modal-target="tambahdefaultgaji" data-modal-toggle="tambahdefaultgaji"
            class="text-white hover:bg-[#5B6390] border-2 border-[#242947] font-bold bg-[#242947] px-2 rounded-lg py-1 text-center text-xl font-medium">
            <i class="text-2xl ri-add-circle-line"></i>
        </button> --}}
        <div class="p-4">
            <form class="flex items-center max-w-md mx-auto space-x-4" action="" method="POST">
                @csrf
                @method('POST')
                <div class="flex items-center justify-center gap-3 text-base">
                    <input type="date" name="tanggal_mulai"
                        class="block w-full py-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <h2 class="lowercase">s.d.</h2>
                    <input type="date" name="tanggal_selesai"
                        class="block w-full py-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
                <button type="submit"
                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-[#242947] border border-transparent rounded-md shadow-sm hover:bg-[#242947]/80 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 19l-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                    <span class="sr-only">Search</span>
                </button>
            </form>
        </div>
    </div>
    <hr class="border-t-2 border-gray-200">
    <div class="p-5 capitalize">
        <form action="{{ route('dashboard.gaji.test') }}" method="POST">
            @csrf
            @method('POST')
            <div class="relative overflow-x-auto shadow-md rounded-xl border border-gray-200 p-4">
                <table class="w-full text-sm text-start table-auto text-black bg-blue-100 rtl:text-right">
                    <tbody class="" id="tabelBody1">
                        <tr class="p-3 bg-white text-start">
                            <td class="px-1 py-3 ">
                                Periode
                            </td>
                            <td class="px-1 py-3 ">
                                1 Sep - 1 Okt 2024
                            </td>
                        </tr>
                        <tr class="p-3 bg-white text-start">
                            <td class="px-1 py-3 ">
                                Nama
                            </td>
                            <td class="px-1 py-3 ">
                                Rudi Hartono
                            </td>
                        </tr>
                        <tr class="p-3 bg-white text-start">
                            <td class="px-1 py-3 ">
                                Metode Pembayaran
                            </td>
                            <td class="px-1 py-3 ">
                               Transfer
                            </td>
                        </tr>
                        <tr class="text-start">
                            <td class="w-2/5 border-[#242947] border-[1px]">
                                <input class="bg-blue-100 w-full h-full text-sm border-none" type="text"
                                    name="" placeholder="Total Shift" id="">
                            </td>
                            <td class="w-3/5 px-3 py-3 text-end border-[#242947] border-[1px]">
                                26
                            </td>
                        </tr>
                        <tr class="text-start">
                            <td class="border-[#242947] border-[1px]">
                                <input class="bg-blue-100 w-full h-full text-sm border-none" type="text"
                                    name="" placeholder="Terlambat" id="">
                            </td>
                            <td class="px-3 py-3 text-end border-[#242947] border-[1px]">
                                2
                            </td>
                        </tr>
                        <tr class="text-start">
                            <td class=" border-[#242947] border-[1px]">
                                <input class="bg-blue-100 w-full h-full text-sm border-none" type="text"
                                    name="" placeholder="Tidak Hadir" id="">
                            </td>
                            <td class="px-3 py-3 text-end border-[#242947] border-[1px]">
                                2
                            </td>
                        </tr>
                        <tr class="text-start">
                            <td class=" border-[#242947] border-[1px]">
                                <input class="bg-blue-100 text-sm w-full h-full border-none" type="text"
                                    name="" placeholder="Ijin Pulang Awal" id="">
                            </td>
                            <td class="px-3 py-3 text-end border-[#242947] border-[1px]">
                                1
                            </td>
                        </tr>
                        <tr class="text-start">
                            <td class=" border-[#242947] border-[1px]">
                                <input class="w-full h-full bg-blue-100 text-sm border-none" type="text"
                                    name="" placeholder="Total Hadir Disiplin" id="">
                            </td>
                            <td class="px-3 py-3 text-end border-[#242947] border-[1px]">
                                21
                            </td>
                        </tr>
                        <tr class="text-start">
                            <td class=" border-[#242947] border-[1px]">
                                <input class="bg-blue-100 text-sm w-full h-full border-none" type="text"
                                    name="" placeholder="Total Kehadiran" id="">
                            </td>
                            <td class="px-3 py-3 text-end border-[#242947] border-[1px]">
                                24
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="p-2">
                    <div id="buttonTambahKolom"
                        class="w-7 h-7 flex items-center justify-center text-white hover:bg-[#5B6390] border-2 border-[#242947] bg-[#242947] rounded-lg cursor-pointer">
                        <i class="text-sm ri-add-circle-line"></i>
                    </div>
                </div>
                <div class="font-bold text-base py-2 px-3">
                    Honorarium
                </div>
                <table class="w-full text-sm text-start table-auto text-black bg-blue-100 rounded-b-lg rtl:text-right">
                    <tbody id="tabelBody2">
                        <tr class="w-2/5 p-3 border-[#242947] border-[1px]">
                            <td class=" px-3 border-[#242947] border-[1px] py-3">
                                1. Honorarium Utama (21 x 700000)
                            </td>
                            <td class="w-3/5 px-3 text-end py-3 border-[#242947] border-[1px]">
                                Rp. 1,680,000
                        </tr>
                        <tr class="p-3 border-[#242947] border-[1px]">
                            <td class="px-3 py-3 border-[#242947] border-[1px]">
                                2. Honorarium Utama (21 x 700000)
                            </td>
                            <td class="px-3 py-3 text-end border-[#242947] border-[1px]">
                                Rp. 1,680,000
                        </tr>
                        <tr class="p-3 border-[#242947] border-[1px]">
                            <td class="px-3 py-3 border-[#242947] border-[1px]">
                                3. Honorarium Utama (21 x 700000)
                            </td>
                            <td class="px-3 py-3 text-end border-[#242947] border-[1px]">
                                Rp. 1,680,000
                        </tr>
                        <tr class="p-3 border-[#242947] border-[1px]">
                            <td class="px-3 py-3 font-bold border-[#242947] border-[1px]">
                                Total Honor
                            </td>
                            <td class="px-3 py-3 font-bold text-end border-[#242947] border-[1px]">
                                Rp. 5,680,000
                        </tr>
                    </tbody>
                </table>
                <div class="p-2">
                    <div id="buttonTambahKolom2"
                        class="w-7 h-7 flex items-center justify-center text-white hover:bg-[#5B6390] border-2 border-[#242947] bg-[#242947] rounded-lg cursor-pointer">
                        <i class="text-sm ri-add-circle-line"></i>
                    </div>
                </div>
                <table class="my-3 w-full text-sm text-start table-auto">
                    <tbody class="w-full align-top border-t   ">
                        <tr>
                            <td class="w-2/5"></td>
                            <td class="w-3/5 font-bold text-base">Note:</td>
                        </tr>
                        <tr>
                            <td class="px-3">Yogyakarta, 2024-12-28</td>
                            <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae nam distinctio delectus
                                vitae
                                accusamus nemo dolores est, repellendus cum. Architecto aperiam tenetur nam labore
                                consectetur
                                necessitatibus illo quae aut perferendis!</td>
                        </tr>
                        <tr>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="px-3">HRD</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="flex justify-end py-4">
                <button type="submit"
                    class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Submit
                </button>
            </div>
        </form>
    </div>
    <x-admin.popup-gaji title="Tambah Default Gaji" id="tambahdefaultgaji" action=""
        method="POST"></x-admin.popup-gaji>

    <script>
        const buttonTambahKolom = document.querySelector('#buttonTambahKolom');
        let y = 1;
        buttonTambahKolom.addEventListener('click', function() {
            const customGaji = document.querySelector('#tabelBody1');

            // Buat elemen <td> dengan <input> di dalamnya menggunakan string literal
            const newTd =
                `
                    <td class="px-3 border-[#242947] border-[1px]">
                        <input name="customHeader_${y}" class="bg-blue-100 text-sm px-0 border-none" type="text" placeholder="Masukkan Gaji">
                    </td>
                    <td class="px-3 border-[#242947] border-[1px] text-end">
                        <input name="customHeaderValue_${y}" class="bg-blue-100 text-sm px-0 border-none no-spinner text-end" type="number" placeholder="?">
                    </td>
                `;

            // Tambahkan elemen <td> baru ke dalam <tr> (customGaji)
            customGaji.insertAdjacentHTML('beforeend', newTd);
            y++;
        });
        let x = 1;

        const buttonTambahKolom2 = document.querySelector('#buttonTambahKolom2');
        buttonTambahKolom2.addEventListener('click', function() {
            const tabelBody2 = document.querySelector('#tabelBody2');
            const totalHonorRow = tabelBody2.querySelector('tr:last-child');

            // Create the new row with the input fields
            const newRow = document.createElement('tr');
            newRow.innerHTML = `
                                <td class="px-3 border-[#242947] border-[1px]">
                                    <input name="custom_${x}" class="bg-blue-100 text-sm px-1 border-none" type="text" placeholder="Masukkan Gaji">
                                </td>
                                <td class="px-3 border-[#242947] border-[1px] text-end text-sm">
                                    <input name="customValue_${x}" class="bg-blue-100 text-sm px-1 no-spinner border-none text-end" type="number" placeholder="????">
                                </td>
                            `;
            // Insert the new row before the Total Honor row
            tabelBody2.insertBefore(newRow, totalHonorRow);
            x++;
        });
    </script>
</x-layout.layout-admin>
