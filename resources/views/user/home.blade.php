@props(['method' => 'PUT', 'izin' => false])
<x-layout.layout>
    <x-slot:title>Presensi Karyawan</x-slot:title>
    <x-navbar :user="$user"></x-navbar>
    <div
        class="grid grid-cols-4 max-md:grid-cols-3 max-sm:grid-cols-2 w-full relative py-5 px-16 max-md:px-8 mx-auto justify-center items-center gap-4 max-md:flex-col ">
        <div class="max-w-52 flex flex-col py-10 gap-3 tracking-[.13em] max-md:hidden">
            <div class="text-center text-2xl font-bold ">{{ $user->karyawan->shift->nama ?? 'Shift ???' }}</div>
            <form class="flex" action="/presensi" method="POST">
                @if ($method == 'POST')
                    @method('POST')
                @else
                    @method('PUT')
                @endif
                @csrf
                <button {{ $absensi && $absensi->jam_pulang || $izin ? 'disabled' : '' }} type="submit"
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
        </div>
        <div class="col-span-3">
            <div class="gap-4 grid grid-cols-3 grid-rows-2 w-full">
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
            <a
                class="flex justify-center items-center w-3/5 h-16 rounded-xl text-white font-bold tracking-widest bg-button">
                Masuk
            </a>
            <button data-modal-target="modal-add" data-modal-toggle="modal-add"
                class="flex justify-center items-center w-1/5 h-16 rounded-xl bg-button">
                <img src="assets/file-add-icon.svg" class="mx-auto " alt="icon-log">
            </button>
            <a href="/history-log" class="w-1/5 h-16 rounded-xl flex bg-button">
                <img src="assets/file-history-icon.svg" class="mx-auto w-6" alt="icon-history-log">
            </a>
        </div>
        <x-popup_modal type="izin"></x-popup_modal>
        <x-popup_modal type=""></x-popup_modal>
    </div>
</x-layout.layout>
