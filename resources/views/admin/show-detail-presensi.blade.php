@php
use Carbon\Carbon;
Carbon::setLocale('id');
// dd($tanggalPerPeriode);

if(!$tanggalMulai == null){
    $tanggalmulai = Carbon::parse($tanggalMulai)->locale('id')->translatedFormat('d-F-Y');
    $tanggalselesai = Carbon::parse($tanggalSelesai)->locale('id')->translatedFormat('d-F-Y');
}
// $tanggal = Carbon::create($dateString)->locale('id')->translatedFormat('F - Y');
$day = \Carbon\Carbon::parse(request('date') ?? $datenow->format('Y-m-d'))->dayOfWeek;
@endphp

<x-layout.layout-admin>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="flex items-center justify-between w-full py-8 text-2xl capitalize px-7">
        <div class="flex items-center justify-center gap-2">
            <a href="{{ route('dashboard.presensi') }}"><i class="py-1 pr-3 text-2xl hover:text-blue-600 ri-arrow-left-line"></i></a>
            <div class="flex flex-col gap-1">
                <h1>{{ $title }}: {{ $karyawan->nama }}</h1>
                <p class="text-base font-medium lowercase">Data per tanggal: {{ $tanggalmulai ?? '--\\--' }}  S.d. {{ $tanggalselesai ?? '--\\--' }}</p>
            </div>
        </div>
        <div class="p-4">
            <form class="flex items-center max-w-md mx-auto space-x-4" action="{{ route('dashboard.presensi.searchdetail',$karyawan->id) }}" method="GET">
                @csrf
                <div class="flex items-center justify-center gap-3 text-base">
                    <input type="date" name="tanggal_mulai" class="block w-full py-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <h2 class="lowercase">s.d.</h2>
                    <input type="date" name="tanggal_selesai" class="block w-full py-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
                <button type="submit" class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-[#242947] border border-transparent rounded-md shadow-sm hover:bg-[#242947]/80 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 19l-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                    <span class="sr-only">Search</span>
                </button>
            </form>
        </div>
    </div>
    <hr class="border-t-2 border-gray-200 ">
    <div class="px-2 py-6 capitalize">
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
                        <div class="flex gap-1">
                            <h2>Total Telat:</h2>
                            <p class="px-1.5 py-0.5 bg-[#DBB80C] text-white rounded-lg"> {{ $totalTelat ?? '0'}}</p>
                        </div>
                        <div class="flex gap-1">
                            <h2>Total Pulang Lebih Awal:</h2>
                            <p class="px-1.5 py-0.5 bg-[#DBB80C] text-white rounded-lg"> {{ $totalPulangCepat ?? '0'}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="px-2 border-[1px] border-t-0 border-b-0 border-[#242947]/50">
                <div class="relative overflow-x-auto shadow-md sm:rounded-t-xl">
                    <table class="w-full text-sm text-center text-black bg-blue-100 rounded-b-lg rtl:text-right">
                        <thead class="text-xs uppercase bg-[#242947] py-14 border-[1px] border-[#242947] text-white">
                            <tr>
                                <th scope="col" class="p-2 border-[#242947] border-[1px]">
                                    No
                                </th>
                                <th scope="col" class="p-4 border-[#242947] border-[1px]">
                                    Tanggal
                                </th>
                                <th scope="col" class="px-2 py-3 border-[#242947] border-[1px]">
                                    Jam Kerja
                                    <hr>
                                    Masuk | Pulang
                                </th>
                                <th scope="col" class="px-2 py-3 border-[#242947] border-[1px]">
                                    Jam Istirahat
                                    <hr>
                                    Istirahat | Kembali
                                </th>
                                <th scope="col" class="px-2 py-3 border-[#242947] border-[1px]">
                                    Jam Izin
                                    <hr>
                                    <span class="md:ml-6">Izin</span> | Kembali
                                </th>
                                <th scope="col" class="px-2 py-3 border-[#242947] border-[1px]">
                                    Total Jam Kerja
                                </th>
                                <th scope="col" class="px-1 py-3 border-[#242947] border-[1px]">
                                    Status Kehadiran
                                </th>
                                <th class="px-2 py-3 ">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!$tanggalPerPeriode)
                                <tr class="text-xl font-semibold">
                                    <td colspan="7" class="py-5 text-center">Silakan Masukan Periode Terlebih Dahulu</td>
                                </tr>
                            @else
                            {{-- @dd($tanggalPerPeriode); --}}
                                @foreach ($tanggalPerPeriode as $tanggal)
                                @php
                                    $found = false;
                                    $formattedDate = \Carbon\Carbon::parse($tanggal)->locale('id')->translatedFormat('d-F-Y');
                                @endphp
                                <tr class="border-[#242947] border-[1px] border-t-0
                                        {{
                                            in_array(\Carbon\Carbon::parse($tanggal)->format('Y-m-d'), $dataTanggalLibur->pluck('tanggal_libur')->toArray()) ||
                                                \Carbon\Carbon::parse($tanggal)->dayOfWeek === \Carbon\Carbon::SUNDAY ?
                                                'bg-red-300' :
                                                (in_array(\Carbon\Carbon::parse($tanggal)->format('Y-m-d'), $tanggalTelat) ? 'bg-yellow-200' :
                                                (in_array(\Carbon\Carbon::parse($tanggal)->format('Y-m-d'), $tanggalPulangCepat) ? 'bg-yellow-200' : '')
                                            ) }}">
                                        <td class="p-1 border-[#242947] border-[1px]">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td class="p-1 border-[#242947] border-[1px]">
                                            {{ $formattedDate }}
                                        </td>
                                @foreach ($dataAbsensi as $absensi)
                                @if (\Carbon\Carbon::parse($absensi->tanggal)->format('Y-m-d') == $tanggal)
                                    @php
                                        $found = true;
                                    @endphp
                                    <td class="p-1 border-[#242947] border-[1px]">
                                        {{ $absensi->jam_mulai ?? '--\\\--' }} | {{ $absensi->jam_pulang ?? '--\\\--' }}
                                    </td>
                                    <td class="p-1 border-[#242947] border-[1px]">
                                        {{ $absensi->jam_istirahat ?? '--\\\--' }} | {{ $absensi->jam_selesai_istirahat ??
                                        '--\\\--' }}
                                    </td>
                                    <td class="p-1 border-[#242947] border-[1px]">
                                        {{ $absensi->jam_izin ?? '--\\\--' }} | {{ $absensi->jam_selesai_izin ?? '--\\\--'
                                        }}
                                    </td>
                                    <td class="p-1 border-[#242947] border-[1px]">
                                        {{ $absensi->jam_total_produktif ?? '--\\\--' }}
                                    </td>
                                    <td class="p-1 border-[#242947] border-[1px]">
                                        {{ $absensi->status_kehadiran ?? 'Tidak Masuk' }}
                                    </td>
                                    <td class="px-3 py-2 text-center">
                                        @if ($absensi->status_kehadiran == 'Izin' || $absensi->status_kehadiran == 'Tidak
                                        Masuk')
                                        <button data-modal-target="editkehadiran{{ $absensi->id }}" data-modal-toggle="editkehadiran{{ $absensi->id }}" class="px-2 py-1 mr-3 text-base font-medium text-center text-white bg-yellow-400 rounded-lg hover:bg-yellow-300 hover:text-gray-800">
                                            <i class="ri-edit-2-line"></i>
                                        </button>
                                        <x-admin.popup-presensi title="Edit Status Kehadiran" id="editkehadiran{{ $absensi->id }}" :action="route('dashboard.editpresensi', $absensi->id)" :data="$absensi" :nama="$karyawan->nama" />
                                        @else
                                        <button data-modal-target="editpresensi{{ $absensi->id }}" data-modal-toggle="editpresensi{{ $absensi->id }}" class="px-2 py-1 mr-3 text-base font-medium text-center text-white bg-yellow-400 rounded-lg hover:bg-yellow-300 hover:text-gray-800">
                                            <i class="ri-edit-2-line"></i>
                                        </button>
                                        <x-admin.popup-presensi title="Edit Absensi Karyawan {{ $karyawan->nama }}" id="editpresensi{{ $absensi->id }}" :action="route('dashboard.editpresensi', $absensi->id)" :data="$absensi" />
                                        @endif
                                        @if ($absensi->status_kehadiran == 'Izin')
                                        <button data-modal-target="previewstatus{{ $absensi->id }}" data-modal-toggle="previewstatus{{ $absensi->id }}" class="px-2 py-1 mr-3 text-base font-medium text-center text-white bg-yellow-400 rounded-lg hover:bg-yellow-300 hover:text-gray-800">
                                            <i class="ri-eye-2-line"></i>
                                        </button>
                                        <x-admin.popup-presensi title="Preview Absensi" id="previewstatus{{ $absensi->id }}" :data="$absensi" :nama="$karyawan->nama" />
                                        @endif
                                        <button data-modal-target="deletedetailpresensi{{ $absensi->id }}" data-modal-toggle="deletedetailpresensi{{ $absensi->id }}" class="px-2 py-1 text-base font-medium text-center text-white bg-red-500 rounded-lg hover:bg-red-400 hover:text-gray-800">
                                            <i class="ri-delete-bin-6-line"></i>
                                        </button>
                                    </td>
                                </tr>
                                <x-admin.popup-presensi title="Edit Absensi Karyawan {{ $karyawan->nama }}" id="editdetailpresensi{{ $absensi->id }}" :action="route('dashboard.editpresensi', $absensi->id)" :data="$absensi" />
                                <x-admin.popup-presensi title="delete" id="deletedetailpresensi{{ $absensi->id }}" :action="route('dashboard.deletepresensi', $absensi->id)" :data="$absensi" :tanggal="$formattedDate" />
                                @endif
                                @endforeach

                                @if (!$found)
                                    <td class="p-2 border-[#242947] border-[1px] border-t-0">--\\-- | --\\--</td>
                                    <td class="p-2 border-[#242947] border-[1px] border-t-0">--\\-- | --\\--</td>
                                    <td class="p-2 border-[#242947] border-[1px] border-t-0">--\\-- | --\\--</td>
                                    <td class="p-2 border-[#242947] border-[1px] border-t-0">--\\--</td>
                                    <td class="p-2 border-[#242947] border-[1px] border-t-0">--\\--</td>
                                    <td class="py-2 pl-3 rounded-br-lg">
                                        <button data-modal-target="tambahstatus{{ $tanggal }}"
                                            data-modal-toggle="tambahstatus{{ $tanggal }}"
                                            class="px-2 py-1 mr-3 text-base font-medium text-center text-white bg-yellow-400 rounded-lg hover:bg-yellow-300 hover:text-gray-800">
                                            <i class="ri-edit-2-line"></i>
                                        </button>
                                    </td>
                                    <x-admin.popup-presensi title="Edit Tidak Masuk" id="tambahstatus{{ $tanggal }}" :action="route('dashboard.postpresensi', [$tanggal, $karyawan->id])"  :data="$karyawan" :nama="$karyawan->nama" method="POST" :tanggal="$formattedDate" />
                                @endif
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="border-[1px] border-t-0 border-[#242947]/50 rounded-b-lg pt-5 pb-2">
                @if ($tanggalPerPeriode !== null)
                    <nav aria-label="Page navigation example" class="flex justify-center w-full pb-5 text-center">
                        <ul class="inline-flex -space-x-px text-sm">
                            @foreach ($tanggalPerPeriode->links()->elements as $element)
                                @if (is_array($element))
                                    @foreach ($element as $page => $url)
                                        <li>
                                            <a href="{{ $url }}&tanggal_mulai={{ request('tanggal_mulai') }}&tanggal_selesai={{ request('tanggal_selesai') }}"
                                            class="flex items-center justify-center px-2.5 py-0.5 border-white border-2 text-lg bg-[#242947] text-white rounded-lg
                                            {{ $tanggalPerPeriode->currentPage() == $page ? 'bg-[#5B6390] pointer-events-none' : 'hover:bg-[#5B6390]  dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white' }}">
                                                {{ $page }}
                                            </a>
                                        </li>
                                    @endforeach
                                @endif
                            @endforeach
                        </ul>
                    </nav>
                @endif
                <span class="block text-sm text-center text-gray-500">© 2024 <a class="hover:underline">Seven Inc™</a>.
                    All Rights Reserved.</span>
            </div>
        </div>
    </div>
</x-layout.layout-admin>

