@php
    use Carbon\Carbon;
    Carbon::setLocale('id');
    $tanggal = Carbon::create($datenow)->locale('id')->translatedFormat('F - Y');
    $day = \Carbon\Carbon::parse(request('date') ?? $datenow->format('Y-m-d'))->dayOfWeek;
@endphp

<x-layout.layout-admin>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="flex items-center justify-between w-full py-8 text-2xl px-7">
        <div class="flex flex-col gap-1">
            <h1>{{ $title }}:  {{ $karyawan->nama }}</h1>
            <p class="text-base font-medium">Data per Bulan: {{ $tanggal }}</p>
        </div>
        <div class="p-4">
            <form class="flex items-center max-w-md mx-auto space-x-4" action="{{ route('dashboard.presensi.searchdetail',$karyawan->id) }}" method="GET">
                @csrf
                <div class="relative flex-grow">
                    <select name="month" id="month" class="block w-full px-4 py-2 text-gray-900 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        <option value="" disabled {{ $selectedMonth ? '' : 'selected' }}>Pilih Bulan</option>
                        @foreach (range(1, 12) as $month)
                            @php
                                $monthName = Carbon::create()->month($month)->locale('id')->translatedFormat('F');
                            @endphp
                            <option value="{{ $month }}" {{ $month == $selectedMonth ? 'selected' : '' }}>
                                {{ $monthName }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-500 border border-transparent rounded-md shadow-sm hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 19l-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                    <span class="sr-only">Search</span>
                </button>
            </form>
        </div>
    </div>
    <hr class="border-t-2 border-gray-200 ">
    <div class="px-2 py-6">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <div class="p-5 text-lg font-bold text-left text-black text-gray-900 border-[1px] border-b-0 border-[#242947]/50 rounded-t-lg">
                Total Kehadiran
                <hr>
                <div class="flex items-end justify-between gap-2 pt-3">
                    <div class="flex gap-2 font-medium font-semibold">
                        <div class="flex gap-1">
                            <h2>Total Masuk:</h2>
                            <p class="px-1.5 py-0.5 bg-green-600 text-white rounded-lg">{{ $totalmasuk }}</p>
                        </div>
                        <div class="flex gap-1">
                            <h2>Total Izin:</h2>
                            <p class="px-1.5 py-0.5 bg-yellow-500 text-white rounded-lg">{{ $totalIzin }}</p>
                        </div>
                        <div class="flex gap-1">
                            <h2>Total Tidak Masuk:</h2>
                            <p class="px-1.5 py-0.5 bg-red-600 text-white rounded-lg"> {{ $totaltidakmasuk }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="px-2 border-[1px] border-t-0 border-b-0 border-[#242947]/50">
                <table class="w-full text-sm text-left text-center text-black border-[1px]  border-[#242947]  bg-gray-100 rtl:text-right rounded-b-lg">
                    <thead class="text-xs uppercase bg-gray-100 border-[1px] border-t-0  border-[#242947] ">
                        <tr>
                            <th scope="col" class="p-2 border-[#242947] border-[1px] border-t-0">
                                No
                            </th>
                            <th scope="col" class="p-4 border-[#242947] border-[1px] border-t-0">
                                Tanggal
                            </th>
                            <th scope="col" class="px-2 py-3 border-[#242947] border-[1px] border-t-0">
                                Jam Kerja
                                <hr>
                                Masuk | Pulang
                            </th>
                            <th scope="col" class="px-2 py-3 border-[#242947] border-[1px] border-t-0">
                                Jam Istirahat
                                <hr>
                                Istirahat | Kembali
                            </th>
                            <th scope="col" class="px-2 py-3 border-[#242947] border-[1px] border-t-0">
                                Jam Izin
                                <hr>
                                <span class="md:ml-6">Izin</span> | Kembali
                            </th>
                            <th scope="col" class="px-2 py-3 border-[#242947] border-[1px] border-t-0">
                                Total Jam Kerja
                            </th>
                            <th scope="col" class="px-1 py-3 border-[#242947] border-[1px] border-t-0">
                                Status Kehadiran
                            </th>
                            <th class="px-2 py-3 ">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataAbsensi as $absensi)
                            <tr class="border-[#242947] border-[1px] border-t-0 
                            {{in_array(\Carbon\Carbon::parse($absensi->tanggal)->format('Y-m-d'), $dataTanggalLibur->pluck('tanggal_libur')->toArray()) || \Carbon\Carbon::parse($absensi->tanggal)->dayOfWeek == \Carbon\Carbon::SUNDAY ? 'bg-red-300' : ''}}">
                                @php
                                    $absensiCount = $absensi->count();
                                    $tanggal = \Carbon\Carbon::parse($absensi->tanggal)->locale('id')->translatedFormat('d-F-Y');
                                @endphp
                                <td class="p-1 border-[#242947] border-[1px]">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="p-1 border-[#242947] border-[1px]">
                                    {{ $tanggal }}
                                </td>

                                <td class="p-1 border-[#242947] border-[1px] border-t-0">
                                    {{ $absensi->jam_mulai ?? '--\\\--' }} | {{ $absensi->jam_pulang ?? '--\\\--' }}
                                </td>
                                <td class="p-1 border-[#242947] border-[1px] border-t-0">
                                    {{ $absensi->jam_istirahat ?? '--\\\--' }} | {{ $absensi->jam_selesai_istirahat ?? '--\\\--' }}
                                </td>
                                <td class="p-1 border-[#242947] border-[1px] border-t-0">
                                    {{ $absensi->jam_izin ?? '--\\\--' }} | {{ $absensi->jam_selesai_izin ?? '--\\\--' }}
                                </td>
                                <td class="p-1 border-[#242947] border-[1px] border-t-0">
                                    {{ $absensi->jam_total_produktif ?? '--\\\--' }}
                                </td>
                                <td class="p-1 border-[#242947] border-[1px] border-t-0">
                                    {{ $absensi->status_kehadiran ?? 'Tidak Masuk' }}
                                </td>
                                <td class="px-1 py-2">
                                    <button data-modal-target="editdetailpresensi{{ $absensi->id }}"
                                        data-modal-toggle="editdetailpresensi{{ $absensi->id }}"
                                        class="text-white hover:bg-yellow-300 hover:text-gray-800 bg-yellow-400 px-2 rounded-lg py-1.5 text-center text-xl font-medium mr-3">
                                        <i class="ri-edit-2-line"></i>
                                    </button>
                                    <button data-modal-target="deletedetailpresensi{{ $absensi->id }}" data-modal-toggle="deletedetailpresensi{{ $absensi->id }}"
                                        class="text-white hover:bg-red-400 hover:text-gray-800 bg-red-500 px-2 rounded-lg py-1.5 text-center text-xl font-medium">
                                        <i class="ri-delete-bin-6-line"></i>
                                    </button>
                                </td>
                            </tr>
                            <x-admin.popup-presensi title="Edit Absensi Karyawan {{ $karyawan->nama }}" id="editdetailpresensi{{ $absensi->id }}" :action="route('dashboard.editpresensi', $absensi->id)" :data="$absensi" />
                            <x-admin.popup-presensi title="delete" id="deletedetailpresensi{{ $absensi->id }}" :action="route('dashboard.deletepresensi',$absensi->id)" :data="$absensi" :tanggal="$tanggal" />
                        @endforeach
                        @if ($errors->any())
                            <div class="w-full mb-2 text-base text-center text-red-500">
                                @foreach ($errors->all() as $error)
                                    <div>{{ $error }}</div>
                                @endforeach
                            </div>
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="border-[1px] border-t-0 border-[#242947]/50 rounded-b-lg pt-5 pb-2">
                <span class="block text-sm text-center text-gray-500">© 2024 <a class="hover:underline">Seven Inc™</a>. All Rights Reserved.</span>
            </div>
        </div>
    </div>
</x-layout.layout-admin>
