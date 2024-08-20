<x-layout.layout-admin>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="flex items-center justify-between w-full py-8 text-2xl px-7">
        <div class="flex flex-col gap-1">
            <h1>{{ $title2 }}</h1>
            <p class="text-base font-medium">Data per Tanggal: {{ $datenow }}</p>
        </div>
        <x-admin.searchbutton action="" />
    </div>
    <hr class="border-t-2 border-gray-200">
    <div class="p-6">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <div class="p-5 text-lg font-semibold text-left text-white text-gray-900 bg-[#242947] rtl:text-right">
                Total Kehadiran
                <hr>
                <div class="flex items-end justify-between gap-2 pt-3">
                    <div class="flex gap-2 font-medium">
                        <div class="flex gap-1">
                            <h2>Total Masuk:</h2>
                            <p class="px-1 py-0.5 bg-green-600 rounded-lg"> 2000</p>
                        </div>
                        <div class="flex gap-1">
                            <h2>Total Izin:</h2>
                            <p class="px-1 py-0.5 bg-yellow-400 rounded-lg"> 2000</p>
                        </div>
                        <div class="flex gap-1">
                            <h2>Total Tidak Masuk:</h2>
                            <p class="px-1 py-0.5 bg-red-600 rounded-lg"> 2000</p>
                        </div>
                    </div>
                    <div class="">
                        <form class="max-w-md mx-auto" action="" method="GET">
                            <div class="relative">
                                <div class="absolute inset-y-0 flex items-center pointer-events-none start-0 ps-3">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                    </svg>
                                </div>
                                <input type="date" id="date" class="block w-full px-3 py-2 text-sm text-gray-900 border border-gray-300 rounded-lg ps-10 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" required />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <table class="w-full text-sm text-left text-center text-white bg-gray-400 rtl:text-right">
                <thead class="text-xs uppercase bg-gray-700">
                    <tr>
                        <th scope="col" class="p-3">
                            No
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nama
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Jam Kerja
                            <hr>
                            Masuk | Pulang
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Jam Istirahat
                            <hr>
                            Istirahat | Kembali
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Total Jam Kerja
                            <hr>
                            Total | (+)(-)
                        </th>
                        <th scope="col" class="px-6 py-3 ">
                            Status Kehadiran
                        </th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-[#242947] border-b border-gray-700">
                        <td class="p-3">
                            1
                        </td>
                        <td class="px-5 py-3">
                            Laptop
                        </td>
                        <td class="px-5 py-3">
                            13:00:00 | 13:00:00
                        </td>
                        <td class="px-5 py-3">
                            13:00:00 | 13:00:00
                        </td>
                        <td class="px-5 py-3">
                            13:00:00 | 13:00:00
                        </td>
                        <td class="px-5 py-3 ">
                            Hadir
                        </td>
                        <td class="px-5 py-3 text-right">
                            <a href="#" class="font-medium text-blue-500 hover:underline">Edit</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</x-layout.layout-admin>
