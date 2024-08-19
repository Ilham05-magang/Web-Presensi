<x-layout.layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-navbar></x-navbar>
    <div class="flex relative py-5 px-16 max-md:px-8 mx-auto justify-center items-center gap-16 max-md:flex-col "> 
        <div class="flex flex-col flex-none py-10 gap-3 tracking-[.13em] max-md:hidden"> 
            <div class="text-center text-2xl font-bold "> Shift Middle </div>
            <a href="#" class="cursor-pointer bg-button text-white font-semibold rounded-xl px-3 py-3 text-xs justify-center gap-1 flex">Masuk</a>
            <button data-modal-target="modal-add" data-modal-toggle="modal-add" class="px-3 py-3 text-xs bg-button text-white font-semibold rounded-xl justify-center gap-1 flex"><img src="assets/file-add-icon.svg" class="w-4" alt="add-log"> Log Activity</button>
            <a href="/history-log" class="cursor-pointer bg-button text-white font-semibold rounded-xl px-3 py-3 text-xs justify-center gap-1 flex"><img src="assets/file-history-icon.svg" class="w-4" alt="history-log"> History Log Activity</a>
        </div>
        <div class="flex gap-4 flex-auto max-md:flex-col">
            <div class="text-center text-2xl font-bold max-md:block hidden tracking-[.13em] pb-7"> Shift Middle </div>
            <div class="gap-4 grid grid-cols-2 grid-rows-2 w-full">
                <x-presensi_card></x-presensi_card>
                <x-presensi_card></x-presensi_card>
                <x-presensi_card></x-presensi_card>
                <x-presensi_card></x-presensi_card>
            </div>
            <div class="flex max-md:flex-col h-full items-end gap-4 max-md:pb-20">
                {{-- <div class="flex w-1/2 flex-col px-4 py-2 border border-[#ADADAD] max-md:w-full  border-solid rounded-md gap-2">
                    <div class="font-medium text-xs">Sudahkah Anda berbuat kebaikan hari ini? </div>
                    <textarea class="resize-none bg-[#E9ECEF] text-xs border-none max-md:h-32"  name="" id="" placeholder="|Tambahkan kebaikan apa hari ini yang telah anda lakukan" ></textarea>
                    <div class="flex gap-5 justify-end items-end">
                        <button class="px-3 py-3 font-semibold rounded-xl text-xs">Batal</button>
                        <button class="bg-button px-12 py-2 text-white font-semibold rounded-sm text-xs  ">Tambahkan</button>
                    </div>
                </div>   --}}
                <div class="flex h-full flex-col gap-3 max-md:w-full justify-center w-full">
                    <div class="text-red font-bold text-center   text-red-500">Attention !</div>
                    <div class="flex h-full items-center gap-4 ">
                        <div class="flex border w-3/5 p-3 h-32 items-center justify-center border-red-600 rounded-md">
                            <div class="text-xs text-center text-red-500"> <li>
                                Kemarin anda absen pulang di kost jangan diulang! </li></div>
                        </div>
                        <div class="flex gap-1 h-32 p-3 items-center w-2/5 justify-center flex-col flex-auto border border-red-600 rounded-md">
                            <div class="text-xs text-center  text-red-500">Anda memiliki kekurangan jam kerja</div>
                            <div class="w-full border border-red-500 rounded-sm bg-gray-200 text-xs text-red-500 font-semibold text-center ">
                                -14:00:00
                            </div>
                            <a href="/data-ganti-jam" class="font-bold text-[9px] text-[#0019FF]">Lihat detail</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="hidden max-md:flex bottom-0 left-0 right-0 px-5 bg-white fixed h-24 w-full items-center gap-4"> 
            <a class="flex justify-center items-center w-3/5 h-16 rounded-xl text-white font-bold tracking-widest bg-button">
                   Masuk
            </a>
            <button data-modal-target="modal-add" data-modal-toggle="modal-add" class="flex justify-center items-center w-1/5 h-16 rounded-xl bg-button">
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
