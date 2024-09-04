<x-layout.layout-admin>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="flex items-center justify-between w-full px-10 py-8 text-2xl">
        <div class="flex gap-1">
            <a href="{{ route('dashboard.gaji') }}"><i
                    class="py-1 pr-3 text-2xl hover:text-blue-600 ri-arrow-left-line"></i></a>
            <h1>{{ $title }} Juleha</h1>
        </div>
    </div>
    <hr class="border-t-2 border-gray-200">
    <div class="p-5 capitalize">
        <div class="relative overflow-x-auto shadow-md ">
            <div class=" grid grid-cols-2 gap-5">
                <div class="border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 p-4">
                    <div class="flex justify-between py-2">
                        <div>
                            <h1 class="font-bold text-xl">
                                Agustus
                            </h1>
                        </div>
                        <div>
                            <a href="{{ route('dashboard.gaji.detail') }}"
                                class="px-1 py-2 pl-2 text-sm font-medium text-center text-white bg-yellow-400 rounded-lg hover:bg-yellow-300 hover:text-gray-800">
                                <i class="ri-eye-2-line"></i>

                            </a>
                            <button data-modal-target="deletegaji" data-modal-toggle="deletegaji"
                                class="px-2 py-1 ml-4 text-base font-medium text-center text-white bg-red-500 rounded-lg hover:bg-red-400 hover:text-gray-800">
                                <i class="ri-delete-bin-6-line"></i>
                            </button>
                        </div>
                    </div>
                    <table class="w-full text-sm text-start text-black bg-blue-100 ">
                        <tbody>
                            <tr class="border-[#242947] border-[1px] ">
                                <td class="px-2 border-[#242947] border-[1px]">
                                    Nama
                                </td>
                                <td class="px-2 text-end border-[#242947] border-[1px]">
                                    Rudi Hartono
                                </td>
                            </tr>
                            <tr class="border-[#242947] border-[1px]">
                                <td class="px-2 border-[#242947] border-[1px]">
                                    Metode Pembayaran
                                </td>
                                <td class="px-2 text-end border-[#242947] border-[1px]">
                                    Transfer
                                </td>
                            </tr>
                            {{-- Foreach gaji header disini --}}
                            <tr class="text-start">
                                <td class="px-2 border-[#242947] border-[1px]">
                                    Total Shift
                                </td>
                                <td class=" px-2 text-end border-[#242947] border-[1px]">
                                    26
                                </td>
                            </tr>
                            <tr class="text-start">
                                <td class="px-2 border-[#242947] border-[1px]">
                                    Terlambat
                                </td>
                                <td class="px-2 text-end border-[#242947] border-[1px]">
                                    2
                                </td>
                            </tr>
                            <tr class="text-start">
                                <td class="px-2 border-[#242947] border-[1px]">
                                    Tidak Hadir
                                </td>
                                <td class="px-2 text-end border-[#242947] border-[1px]">
                                    2
                                </td>
                            </tr>
                            <tr class="text-start">
                                <td class="px-2 border-[#242947] border-[1px]">
                                    Ijin Pulang Awal
                                </td>
                                <td class="px-2 text-end border-[#242947] border-[1px]">
                                    1
                                </td>
                            </tr>
                            <tr class="text-start">
                                <td class="px-2 border-[#242947] border-[1px]">
                                    Total Hadir Disiplin
                                </td>
                                <td class="px-2 text-end border-[#242947] border-[1px]">
                                    21
                                </td>
                            </tr>
                            <tr class="text-start">
                                <td class="px-2 border-[#242947] border-[1px]">
                                    Total Kehadiran
                                </td>
                                <td class="px-2 text-end border-[#242947] border-[1px]">
                                    24
                                </td>
                            </tr>
                            <tr class="border-none bg-white">
                                <td class="px-2 font-bold ">Honorarium</td>
                                <td>&nbsp;</td>
                            </tr>
                            {{-- Foreach gaji detail disini --}}
                            <tr class=" border-[#242947] border-[1px]">
                                <td class=" px-2 border-[#242947] border-[1px]">
                                    1. Honorarium Utama (21 x 700000)
                                </td>
                                <td class=" px-2 text-end border-[#242947] border-[1px]">
                                    Rp. 1,680,000
                            </tr>
                            <tr class=" border-[#242947] border-[1px]">
                                <td class="px-2 border-[#242947] border-[1px]">
                                    2. Honorarium Utama (21 x 700000)
                                </td>
                                <td class="px-2 text-end border-[#242947] border-[1px]">
                                    Rp. 1,680,000
                            </tr>
                            <tr class=" border-[#242947] border-[1px]">
                                <td class="px-2 border-[#242947] border-[1px]">
                                    3. Honorarium Utama (21 x 700000)
                                </td>
                                <td class="px-2 text-end border-[#242947] border-[1px]">
                                    Rp. 1,680,000
                            </tr>
                            <tr class=" border-[#242947] border-[1px]">
                                <td class="px-2 font-bold border-[#242947] border-[1px]">
                                    Total Honor
                                </td>
                                <td class="px-2 font-bold text-end border-[#242947] border-[1px]">
                                    Rp. 5,680,000
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 p-4">
                    <div class="flex justify-between py-2">
                        <div>
                            <h1 class="font-bold text-xl">
                                Agustus
                            </h1>
                        </div>
                        <div>
                            <a href="{{ route('dashboard.gaji.detail') }}"
                                class="px-1 py-2 pl-2 text-sm font-medium text-center text-white bg-yellow-400 rounded-lg hover:bg-yellow-300 hover:text-gray-800">
                                <i class="ri-eye-2-line"></i>

                            </a>
                            <button data-modal-target="deletegaji" data-modal-toggle="deletegaji"
                                class="px-2 py-1 ml-4 text-base font-medium text-center text-white bg-red-500 rounded-lg hover:bg-red-400 hover:text-gray-800">
                                <i class="ri-delete-bin-6-line"></i>
                            </button>
                        </div>
                    </div>
                    <table class="w-full text-sm text-start text-black bg-blue-100 ">
                        <tbody>
                            <tr class="border-[#242947] border-[1px] ">
                                <td class="px-2 border-[#242947] border-[1px]">
                                    Nama
                                </td>
                                <td class="px-2 text-end border-[#242947] border-[1px]">
                                    Rudi Hartono
                                </td>
                            </tr>
                            <tr class="border-[#242947] border-[1px]">
                                <td class="px-2 border-[#242947] border-[1px]">
                                    Metode Pembayaran
                                </td>
                                <td class="px-2 text-end border-[#242947] border-[1px]">
                                    Transfer
                                </td>
                            </tr>
                            {{-- Foreach gaji header disini --}}
                            <tr class="text-start">
                                <td class="px-2 border-[#242947] border-[1px]">
                                    Total Shift
                                </td>
                                <td class=" px-2 text-end border-[#242947] border-[1px]">
                                    26
                                </td>
                            </tr>
                            <tr class="text-start">
                                <td class="px-2 border-[#242947] border-[1px]">
                                    Terlambat
                                </td>
                                <td class="px-2 text-end border-[#242947] border-[1px]">
                                    2
                                </td>
                            </tr>
                            <tr class="text-start">
                                <td class="px-2 border-[#242947] border-[1px]">
                                    Tidak Hadir
                                </td>
                                <td class="px-2 text-end border-[#242947] border-[1px]">
                                    2
                                </td>
                            </tr>
                            <tr class="text-start">
                                <td class="px-2 border-[#242947] border-[1px]">
                                    Ijin Pulang Awal
                                </td>
                                <td class="px-2 text-end border-[#242947] border-[1px]">
                                    1
                                </td>
                            </tr>
                            <tr class="text-start">
                                <td class="px-2 border-[#242947] border-[1px]">
                                    Total Hadir Disiplin
                                </td>
                                <td class="px-2 text-end border-[#242947] border-[1px]">
                                    21
                                </td>
                            </tr>
                            <tr class="text-start">
                                <td class="px-2 border-[#242947] border-[1px]">
                                    Total Kehadiran
                                </td>
                                <td class="px-2 text-end border-[#242947] border-[1px]">
                                    24
                                </td>
                            </tr>
                            <tr class="border-none bg-white">
                                <td class="px-2 font-bold ">Honorarium</td>
                                <td>&nbsp;</td>
                            </tr>
                            {{-- Foreach gaji detail disini --}}
                            <tr class=" border-[#242947] border-[1px]">
                                <td class=" px-2 border-[#242947] border-[1px]">
                                    1. Honorarium Utama (21 x 700000)
                                </td>
                                <td class=" px-2 text-end border-[#242947] border-[1px]">
                                    Rp. 1,680,000
                            </tr>
                            <tr class=" border-[#242947] border-[1px]">
                                <td class="px-2 border-[#242947] border-[1px]">
                                    2. Honorarium Utama (21 x 700000)
                                </td>
                                <td class="px-2 text-end border-[#242947] border-[1px]">
                                    Rp. 1,680,000
                            </tr>
                            <tr class=" border-[#242947] border-[1px]">
                                <td class="px-2 border-[#242947] border-[1px]">
                                    3. Honorarium Utama (21 x 700000)
                                </td>
                                <td class="px-2 text-end border-[#242947] border-[1px]">
                                    Rp. 1,680,000
                            </tr>
                            <tr class=" border-[#242947] border-[1px]">
                                <td class="px-2 font-bold border-[#242947] border-[1px]">
                                    Total Honor
                                </td>
                                <td class="px-2 font-bold text-end border-[#242947] border-[1px]">
                                    Rp. 5,680,000
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
    <x-admin.popup-gaji title="Tambah Default Gaji" id="tambahdefaultgaji" action=""
        method="POST"></x-admin.popup-gaji>
</x-layout.layout-admin>
