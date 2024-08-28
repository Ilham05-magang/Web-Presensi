@props(['method' => 'PUT', 'izin' => false])
<x-layout.layout>
    <x-slot:title>Presensi Karyawan</x-slot:title>
    <x-navbar :user="$user" :quotes="$quotes"></x-navbar>
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Sukses',
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
    <div
        class="grid mt-4 grid-cols-4 max-md:grid-cols-3 max-sm:grid-cols-2 w-full relative py-5 px-16 max-md:px-8 mx-auto justify-center  gap-4 max-md:flex-col ">
        <div class="max-w-48 flex flex-col gap-3 tracking-[.13em] max-md:hidden">
            <div class="text-center text-2xl font-bold ">{{ $user->karyawan->shift->nama ?? 'Shift ???' }}</div>
            <form class="flex" action="/presensi" method="POST">
                @if ($method == 'POST')
                    @method('POST')
                @else
                    @method('PUT')
                @endif
                @csrf
                <button {{ ($absensi && $absensi->jam_pulang) || $izin || !$user->karyawan->shift_id || ($absensi && $absensi->status_kehadiran == 'Izin')  ? 'disabled' : '' }} type="submit"
                    class="disabled:opacity-20 bg-button w-full text-white font-semibold rounded-xl px-3 py-3 text-sm justify-center gap-1 ">{{ $titleButton ?? 'Masuk' }}</button>
            </form>
            <form action="{{ route('izin') }}" method="post">
                @method('PUT')
                @csrf
                <button
                    {{ $titleButton == 'Kembali' || $titleButton == 'Telah Pulang' || $titleButton == 'Masuk' || $absensi->jam_selesai_izin ? 'disabled' : '' }}
                    class="disabled:opacity-20 px-3 py-3 text-sm w-full bg-button text-white font-semibold rounded-xl justify-center gap-1 flex">
                    @if (empty($absensi->jam_selesai_izin))
                        {{ $izin == true ? 'Selesai izin' : 'izin' }}
                    @else
                        Telah Izin
                    @endif
                </button>
            </form>
            @if ($user->karyawan->kantor_id != '')
                <a target="_blank" href="{{ $user->karyawan->kantor->link_gmaps}}" class="text-xs text-center tracking-tight text-blue-700 font-bold underline">Lihat lokasi kantor</a>
            @else
                <div class="cursor-text text-center text-xs tracking-tight font-medium text-gray-300">Kantor belum di tentukan</div>
            @endif
        </div>
        <div class="col-span-3">
            <div class="gap-4 grid grid-cols-3 grid-rows-2 w-full max-md:grid-cols-2">
                <x-presensi_card title="Masuk" presensi="{{ $absensi->jam_mulai ?? '---' }}"></x-presensi_card>
                <x-presensi_card title="Istirahat" presensi="{{ $absensi->jam_istirahat ?? '---' }}"></x-presensi_card>
                <x-presensi_card title="Izin" presensi="{{ $absensi->jam_izin ?? '---' }}"></x-presensi_card>
                <x-presensi_card title="Kembali"
                    presensi="{{ $absensi->jam_selesai_istirahat ?? '---' }}"></x-presensi_card>
                <x-presensi_card title="Pulang" presensi="{{ $absensi->jam_pulang ?? '---' }}"></x-presensi_card>
                <x-presensi_card title="Selesai Izin"
                    presensi="{{ $absensi->jam_selesai_izin ?? '---' }}"></x-presensi_card>
            </div>
        </div>
        {{-- <div class="col-span-1 gap-4 grid grid-cols-1 grid-rows-2 w-full">

        </div> --}}
        <div class="hidden max-md:flex bottom-0 left-0 right-0 px-5 bg-white fixed h-24 w-full items-center gap-4">
            <form class="flex w-full" action="/presensi" method="POST">
                @if ($method == 'POST')
                    @method('POST')
                @else
                    @method('PUT')
                @endif
                @csrf
                <button {{ ($absensi && $absensi->jam_pulang) || $izin ? 'disabled' : '' }} type="submit"
                    class="disabled:opacity-20 flex justify-center items-center w-full h-16 rounded-xl text-white font-bold tracking-widest bg-button">{{ $titleButton ?? 'Masuk' }}</button>
            </form>
            <form class="w-full" action="{{ route('izin') }}" method="post">
                @method('PUT')
                @csrf
                <button
                    {{ $titleButton == 'Kembali' || $titleButton == 'Telah Pulang' || $titleButton == 'Masuk' || $absensi->jam_selesai_izin ? 'disabled' : '' }}
                    class="disabled:opacity-20 flex w-full justify-center items-center text-white h-16 rounded-xl font-bold tracking-widest bg-button">
                    @if (empty($absensi->jam_selesai_izin))
                        {{ $izin == true ? 'Selesai izin' : 'izin' }}
                    @else
                        Telah Izin
                    @endif
                </button>
            </form>
        </div>
        <x-popup_modal type="izin"></x-popup_modal>
        <x-popup_modal type=""></x-popup_modal>
    </div>
</x-layout.layout>
