<header>
    <nav>
        <div class="flex flex-wrap items-center justify-between mx-auto">
            <div style="background-image: url('assets/user-dashboard.svg')" class=" w-screen flex items-center flex-col px-10 max-md:px-3 rounded-b-2xl max-md:rounded-none">
                <div class="w-full flex items-center justify-between pt-3 ">
                    <div class="flex items-center gap-2">
                        <i class="ri-calendar-2-line text-2xl text-white max-md:text-base"></i>
                        <div class="text-white font-normal text-base max-md:text-[10px]"> Rabu, 23 Agustus 2023</div>
                    </div>
                    <div class="text-white text-2xl font-semibold max-md:text-base "> 09:30:01</div>
                </div>
                <div class="py-6 text-white font-semibold italic text-2xl max-md:text-base max-md:py-20">" Change your life for better future</div>
                <div class="w-full flex justify-between pb-5 max-md:pb-3 items-end">
                    <div class="flex gap-2 items-center pr-9 bg-[#00000066] rounded-[32px] p-1 max-md:p-[2px] max-md:pr-9 max-md:gap-1">
                        <div class="w-12 h-12 max-md:w-7 max-md:h-7 rounded-full bg-red-600 flex items-center justify-center">
                            <i class="ri-user-fill text-3xl max-md:text-base text-white"></i>
                        </div>
                        <div class="flex flex-col gap-[2px] ">
                            <div class="font-medium text-white text-base max-md:text-[10px] max-md:leading-none">Syalita Widyandini</div>
                            <div class="font-light text-white text-xs max-md:text-[7px] max-md:leading-none">MJ/UIUX/POLINES/AGST2023/06</div>
                        </div>
                    </div>
                    <i data-modal-target="popup-modal" data-modal-toggle="popup-modal" class="cursor-pointer ri-logout-box-r-line text-3xl max-md:text-xl text-white"></i>
                </div>
            </div>
        </div>
    </nav>
    <x-popup_button title="Log out" description="Apa anda yakin ingin keluar?" ></x-popup_button>
</header>
