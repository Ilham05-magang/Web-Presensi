@php
    use Carbon\Carbon;
    Carbon::setLocale('id');
    $tanggalselect = Carbon::parse($dateQuery)->locale('id')->translatedFormat('d - F - Y');
    $datenow = Carbon::parse($dateQuery);
    $day = \Carbon\Carbon::parse(request('date') ?? $datenow->format('Y-m-d'))->dayOfWeek;
@endphp
<x-layout.layout-admin>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="flex items-center justify-between w-full py-8 text-2xl px-7">
        <div class="flex flex-col gap-1">
            <h1>{{ $title2 }}</h1>
            <p class="text-base font-medium">Data per Tanggal: {{ $tanggalselect }}</p>
        </div>
        <x-admin.searchbutton :action="route('dashboard.searchpresensi', $dateQuery)" />
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
                    <div class="">
                        <form class="max-w-md mx-auto" action="{{ route('dashboard.searchpresensibydate') }}" method="GET">
                            @csrf
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                                    <button type="submit">
                                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                        </svg>
                                    </button>
                                </div>
                                <input type="date" id="date" name="date" value="{{ $dateQuery }}"
                                    class="block w-full px-3 py-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    required />

                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="px-2 border-[1px] border-t-0 border-b-0 border-[#242947]/50">
                <div class="relative overflow-x-auto shadow-md sm:rounded-t-xl">
                    <table class="w-full text-sm text-center text-black bg-blue-100 rounded-b-lg rtl:text-right">
                        <thead class="text-xs uppercase bg-[#242947] py-14 border-[1px] border-[#242947] text-white">
                            <tr>
                                <th scope="col" class="p-3">
                                    No
                                </th>
                                <th scope="col" class="px-3 py-3">
                                    Nama
                                </th>
                                <th scope="col" class="px-4 py-3">
                                    Jam Kerja
                                    <hr>
                                    Masuk | Pulang
                                </th>
                                <th scope="col" class="px-4 py-3">
                                    Jam Istirahat
                                    <hr>
                                    Istirahat | Kembali
                                </th>
                                <th scope="col" class="px-4 py-3">
                                    Jam Izin
                                    <hr>
                                    <span class="md:ml-6">Izin</span> | Kembali
                                </th>
                                <th scope="col" class="px-2 py-3">
                                    Total Jam Kerja
                                </th>
                                <th scope="col" class="px-2 py-3">
                                    Status Kehadiran
                                </th>
                                <th class="px-2 py-3 ">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataAbsensi as $data)
                            <tr class="border-[#242947] border-[1px] border-t-0 
                        {{in_array( request('date') ?? $datenow->format('Y-m-d'), $dataTanggalLibur->pluck('tanggal_libur')->toArray()) || $day == \Carbon\Carbon::SUNDAY ? 'bg-red-300' : ''}}
                        ">
                                <td class="p-1 border-[#242947] border-[1px]">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="p-1 border-[#242947] border-[1px]">
                                    <a class="hover:underline hover:text-blue-600" href="{{ route('dashboard.presensi.detail',$data->id) }}">
                                        {{ $data->nama }}
                                    </a>
                                </td>
                                @php
                                    $absensiCount = $data->absensi->count(); // Ambil jumlah data absensi
                                @endphp
                                @if ($absensiCount > 0)
                                    @foreach ($data->absensi as $absensi)
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
                                                <x-admin.popup-presensi title="Edit Status Kehadiran" id="editkehadiran{{ $absensi->id }}" :action="route('dashboard.editpresensi', $absensi->id)" :data="$absensi" :nama="$data->nama" />
                                            @else
                                                <button data-modal-target="editpresensi{{ $absensi->id }}"
                                                    data-modal-toggle="editpresensi{{ $absensi->id }}"
                                                    class="px-2 py-1 mr-3 text-base font-medium text-center text-white bg-yellow-400 rounded-lg hover:bg-yellow-300 hover:text-gray-800">
                                                    <i class="ri-edit-2-line"></i>
                                                </button>
                                                <x-admin.popup-presensi title="Edit Absensi Karyawan {{ $data->nama }}" id="editpresensi{{ $absensi->id }}" :action="route('dashboard.editpresensi', $absensi->id)" :data="$absensi" />
                                            @endif
                                            @if ($absensi->status_kehadiran == 'Izin')
                                                <button data-modal-target="previewstatus{{ $absensi->id }}"
                                                    data-modal-toggle="previewstatus{{ $absensi->id }}"
                                                    class="px-2 py-1 mr-3 text-base font-medium text-center text-white bg-yellow-400 rounded-lg hover:bg-yellow-300 hover:text-gray-800">
                                                    <i class="ri-eye-2-line"></i>
                                                </button>
                                                <x-admin.popup-presensi title="Preview Absensi" id="previewstatus{{ $absensi->id }}"  :data="$absensi" :nama="$data->nama" />
                                            @endif
                                            <button data-modal-target="deletepresensi{{ $absensi->id }}" data-modal-toggle="deletepresensi{{ $absensi->id }}"
                                                class="px-2 py-1 text-base font-medium text-center text-white bg-red-500 rounded-lg hover:bg-red-400 hover:text-gray-800">
                                                <i class="ri-delete-bin-6-line"></i>
                                            </button>
                                        </td>

                                        <x-admin.popup-presensi title="delete" id="deletepresensi{{ $absensi->id }}" :action="route('dashboard.deletepresensi',$absensi->id)" :data="$data" :tanggal="$tanggalselect" />
                                    @endforeach
                                @else
                                    <td class="p-2 border-[#242947] border-[1px] border-t-0">--\\-- | --\\--</td>
                                    <td class="p-2 border-[#242947] border-[1px] border-t-0">--\\-- | --\\--</td>
                                    <td class="p-2 border-[#242947] border-[1px] border-t-0">--\\-- | --\\--</td>
                                    <td class="p-2 border-[#242947] border-[1px] border-t-0">--\\--</td>
                                    <td class="p-2 border-[#242947] border-[1px] border-t-0">--\\--</td>
                                    <td class="py-2 pl-3 rounded-br-lg">
                                        <button data-modal-target="tambahstatus{{ $data->id }}"
                                            data-modal-toggle="tambahstatus{{ $data->id }}"
                                            class="px-2 py-1 mr-3 text-base font-medium text-center text-white bg-yellow-400 rounded-lg hover:bg-yellow-300 hover:text-gray-800">
                                            <i class="ri-edit-2-line"></i>
                                        </button>
                                    </td>
                                    <x-admin.popup-presensi title="Edit Tidak Masuk" id="tambahstatus{{ $data->id }}" :action="route('dashboard.postpresensi', [$dateQuery, $data->id])"  :data="$data" :nama="$data->nama" method="POST" />
                                @endif
                            </tr>
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
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: '{{ $error }}',
                });
            </script>
        @endforeach
    @endif
</x-layout.layout-admin>
