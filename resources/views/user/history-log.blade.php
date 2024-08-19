<x-layout.layout><x-slot:title>{{ $title }}</x-slot:title><x-navbar />
    <div class="p-5">
        <div class="flex relative items-center pt-12">
            <a href="/" class="absolute left-0 cursor-pointer"><i class="ri-arrow-left-s-line text-3xl"></i></a>
            <div class="mx-auto font-extrabold text-base tracking-[.16rem]">History Log Activity</div>
        </div>
        <div class="pt-7">
            <table class="table-fixed w-full text-xs border text-left border-collapse rounded-lg ">
                <thead class="bg-[#F2F4F8] border-t border-l  border-r border-b-[3px] border-solid border-[#0000005E]">
                    <tr class="text-left font-bold ">
                        <th class="w-1/12 p-3 text-center">No</th>
                        <th class="w-2/12">Tanggal</th>
                        <th class="text-left w-3/12">Activity Log</th>
                        <th class="w-2/12">Status</th>
                        <th class="w-2/12">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="text-left odd:bg-[#D8DADF] even:bg-white">
                        <td class="text-center p-3">1</td>
                        <td>23 Agustus 2023</td>
                        <td class="text-left">Menghadiri meeting proyek</td>
                        <td>Selesai</td>
                        <td><button class="bg-blue-500 text-white px-3 py-1 rounded-xl font-semibold">Lihat</button>
                        </td>
                    </tr>
                    <tr class="text-left odd:bg-[#D8DADF] even:bg-white">
                        <td class="text-center p-3">1</td>
                        <td>23 Agustus 2023</td>
                        <td class="text-left">Menghadiri meeting proyek</td>
                        <td>Selesai</td>
                        <td><button class="bg-blue-500 text-white px-3 py-1 rounded-xl font-semibold">Lihat</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</x-layout.layout>
