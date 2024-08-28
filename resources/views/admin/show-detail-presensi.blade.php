@php
    use Carbon\Carbon;
    Carbon::setLocale('id');

    $year = now()->year;
    $dateString = $year . '-' . $selectedMonth;
    $tanggalsearch = Carbon::parse($dateString)->locale('id')->translatedFormat('F - Y');
@endphp

<x-layout.layout-admin>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="flex items-center justify-between w-full py-8 text-2xl capitalize px-7">
        <div class="flex items-center justify-center gap-2">
            <a href="{{ route('dashboard.presensi') }}"><i class="py-1 pr-3 text-2xl hover:text-blue-600 ri-arrow-left-line"></i></a>
            <div class="flex flex-col gap-1">
                <h1>{{ $title }}:  {{ $karyawan->nama }}</h1>
                <p class="text-base font-medium">Data per Bulan: {{ $tanggalsearch  }}</p>
            </div>
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
                            @foreach ($dataAbsensi as $absensi)
                                <tr class="border-[#242947] border-[1px]">
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

                                    <td class="p-1 border-[#242947] border-[1px]">
                                        {{ $absensi->jam_mulai ?? '--\\\--' }} | {{ $absensi->jam_pulang ?? '--\\\--' }}
                                    </td>
                                    <td class="p-1 border-[#242947] border-[1px]">
                                        {{ $absensi->jam_istirahat ?? '--\\\--' }} | {{ $absensi->jam_selesai_istirahat ?? '--\\\--' }}
                                    </td>
                                    <td class="p-1 border-[#242947] border-[1px]">
                                        {{ $absensi->jam_izin ?? '--\\\--' }} | {{ $absensi->jam_selesai_izin ?? '--\\\--' }}
                                    </td>
                                    <td class="p-1 border-[#242947] border-[1px]">
                                        {{ $absensi->jam_total_produktif ?? '--\\\--' }}
                                    </td>
                                    <td class="p-1 border-[#242947] border-[1px]">
                                        {{ $absensi->status_kehadiran ?? 'Tidak Masuk' }}
                                    </td>
                                    <td class="px-3 py-2 text-center">
                                        @if ($absensi->status_kehadiran == 'Izin' || $absensi->status_kehadiran == 'Tidak Masuk')
                                            <button data-modal-target="editkehadiran{{ $absensi->id }}"
                                                data-modal-toggle="editkehadiran{{ $absensi->id }}"
                                                class="px-2 py-1 mr-3 text-base font-medium text-center text-white bg-yellow-400 rounded-lg hover:bg-yellow-300 hover:text-gray-800">
                                                <i class="ri-edit-2-line"></i>
                                            </button>
                                            <x-admin.popup-presensi title="Edit Status Kehadiran" id="editkehadiran{{ $absensi->id }}" :action="route('dashboard.editpresensi', $absensi->id)" :data="$absensi" :nama="$karyawan->nama" />
                                        @else
                                            <button data-modal-target="editpresensi{{ $absensi->id }}"
                                                data-modal-toggle="editpresensi{{ $absensi->id }}"
                                                class="px-2 py-1 mr-3 text-base font-medium text-center text-white bg-yellow-400 rounded-lg hover:bg-yellow-300 hover:text-gray-800">
                                                <i class="ri-edit-2-line"></i>
                                            </button>
                                            <x-admin.popup-presensi title="Edit Absensi Karyawan {{ $karyawan->nama }}" id="editpresensi{{ $absensi->id }}" :action="route('dashboard.editpresensi', $absensi->id)" :data="$absensi" />
                                        @endif
                                        @if ($absensi->status_kehadiran == 'Izin')
                                            <button data-modal-target="previewstatus{{ $absensi->id }}"
                                                data-modal-toggle="previewstatus{{ $absensi->id }}"
                                                class="px-2 py-1 mr-3 text-base font-medium text-center text-white bg-yellow-400 rounded-lg hover:bg-yellow-300 hover:text-gray-800">
                                                <i class="ri-eye-2-line"></i>
                                            </button>
                                            <x-admin.popup-presensi title="Preview Absensi" id="previewstatus{{ $absensi->id }}"  :data="$absensi" :nama="$karyawan->nama" />
                                        @endif
                                        <button data-modal-target="deletedetailpresensi{{ $absensi->id }}" data-modal-toggle="deletedetailpresensi{{ $absensi->id }}"
                                            class="px-2 py-1 text-base font-medium text-center text-white bg-red-500 rounded-lg hover:bg-red-400 hover:text-gray-800">
                                            <i class="ri-delete-bin-6-line"></i>
                                        </button>
                                    </td>
                                </tr>
                                <x-admin.popup-presensi title="Edit Absensi Karyawan {{ $karyawan->nama }}" id="editdetailpresensi{{ $absensi->id }}" :action="route('dashboard.editpresensi', $absensi->id)" :data="$absensi" />
                                <x-admin.popup-presensi title="delete" id="deletedetailpresensi{{ $absensi->id }}" :action="route('dashboard.deletepresensi',$absensi->id)" :data="$absensi" :tanggal="$tanggal" />
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="border-[1px] border-t-0 border-[#242947]/50 rounded-b-lg pt-5 pb-2">
                <span class="block text-sm text-center text-gray-500">© 2024 <a class="hover:underline">Seven Inc™</a>. All Rights Reserved.</span>
            </div>
        </div>
    </div>
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '{{ session('success') }}',
            });
        </script>
    @endif
    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '{{ session('error') }}',
            });
        </script>
    @endif
</x-layout.layout-admin>
