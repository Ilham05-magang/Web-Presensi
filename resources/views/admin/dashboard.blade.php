<x-layout.layout-admin>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="flex items-center justify-between w-full px-10 py-8 text-2xl font-semibold">
        <h1>{{ $title }}</h1>
    </div>
    <hr class="border-t-2 border-gray-200">
    <div class="p-8">
        <div class="grid grid-cols-1 text-xl font-semibold text-white gap-7 md:grid-cols-2 xl:grid-cols-3">
            <div class="h-48 bg-green-400 border-[1px] border-green-600 shadow-xl shadow-green-700/50 rounded-2xl">
                <div class="px-5 pt-5">
                    <h2>Jumlah Karyawan</h2>
                    <h1 class="mt-2 text-4xl font-bold">{{ $totalkaryawan }}</h1>
                </div>
                <i
                    class=" flex justify-end w-full h-full pt-10 font-medium text-[90px] text-right ri-team-line text-green-500"></i>
            </div>
            <div class="h-48 bg-green-400 border-[1px] border-green-700 shadow-xl shadow-green-700/50 rounded-2xl">
                <div class="px-5 pt-5">
                    <h2>Jumlah Masuk</h2>
                    <h1 class="mt-2 text-4xl font-bold">{{ $totalmasuk }}</h1>
                </div>
                <i
                    class="flex justify-end w-full h-full pt-10 font-medium text-[90px] text-right ri-user-received-line text-green-500"></i>
            </div>
            <div
                class="row-span-2 h-full bg-gray-500/90 border-[1px] border-gray-700 shadow-xl shadow-gray-700/50 rounded-2xl">
                <div class="p-3 w-full overflow-y-auto">
                    <h2>Aktivitas Terbaru</h2>
                    <div class="pt-2">
                        <table class="table-auto w-full">
                            <tbody class="text-white">
                                @foreach ($aktivitas as $aktivitas)
                                    <tr>
                                        <td class="tracking-tighter whitespace-nowrap text-sm p-1 ">
                                            {{ $aktivitas->karyawan->nama }}
                                        </td>
                                        <td class="p-1 tracking-tighter font-medium whitespace-nowrap text-xs ">
                                            {{ $aktivitas->deskripsi }}
                                        </td>
                                        <td class="p-1 font-normal tracking-tighter whitespace-nowrap text-xs ">
                                            {{ $aktivitas->created_at->diffForHumans() }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            <div class="h-48 bg-red-500 border-[1px] border-red-600 shadow-xl shadow-red-700/50 rounded-2xl">
                <div class="px-5 pt-5">
                    <h2>Jumlah Tidak Masuk</h2>
                    <h1 class="mt-2 text-4xl font-bold">{{ $totaltidakmasuk }}</h1>
                </div>
                <i
                    class="flex justify-end w-full h-full pt-10 font-medium text-[90px] text-right ri-user-unfollow-line text-red-600"></i>
            </div>
            <div class="h-48 bg-yellow-400 border-[1px] border-yellow-700 shadow-xl shadow-yellow-700/50 rounded-2xl">
                <div class="px-5 pt-5">
                    <h2>Jumlah Izin</h2>
                    <h1 class="mt-2 text-4xl font-bold">{{ $totalIzin }}</h1>
                </div>
                <i
                    class="flex justify-end w-full h-full pt-10 font-medium text-[90px] text-right ri-user-minus-line text-yellow-500"></i>
            </div>
        </div>
    </div>
</x-layout.layout-admin>
