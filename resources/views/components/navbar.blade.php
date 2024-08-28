@props(['user', 'quotes'])
@php
    use Carbon\Carbon;

    // Mendapatkan tanggal hari ini
    $tanggal = Carbon::now();

    // Mengatur format tanggal
    $formatTanggal = $tanggal->locale('id')->isoFormat('dddd, D MMMM YYYY');
    $monthAbbreviations = [
        '01' => 'JAN',
        '02' => 'FEB',
        '03' => 'MAR',
        '04' => 'APR',
        '05' => 'MAY',
        '06' => 'JUN',
        '07' => 'JUL',
        '08' => 'AGST',
        '09' => 'SEP',
        '10' => 'OCT',
        '11' => 'NOV',
        '12' => 'DEC',
    ];

    // Konversi ke date
    $carbonDate = Carbon::parse($user->created_at);

    // Format bulan
    $month = $carbonDate->format('m');
    $monthAbbreviation = $monthAbbreviations[$month];

    // Format tahun
    $year = $carbonDate->format('Y');
    $formattedDate = $monthAbbreviation . $year;
    $quotesJson = json_encode($quotes);
@endphp
<header>
    <div class="flex flex-wrap items-center justify-between mx-auto">
        <div
            class="bg-user-background w-screen h-full flex items-center flex-col px-10 max-md:px-3 rounded-b-2xl max-md:rounded-none">
            <div class="w-full flex items-center justify-between pt-3 ">
                <div class="flex items-center gap-2">
                    <i class="ri-calendar-2-line text-2xl text-white max-md:text-base"></i>
                    <div class="text-white font-medium text-base max-md:text-xs" >
                        {{$formatTanggal}}
                    </div>
                </div>
                <span class="text-white text-2xl font-semibold max-md:text-base" x-data="{
                    time: '--:--:--',
                    updateTime() {
                        setInterval(() => {
                            this.time = new Date().toLocaleTimeString('en-GB', {
                                hour: '2-digit',
                                minute: '2-digit',
                                second: '2-digit',
                                hour12: false
                            });
                        });
                    }
                }"
                    x-init="updateTime()" x-text="time"
                    >------</span>
            </div>
            <div class="h-32 flex justify-center items-center">
                <h2 class="mx-auto text-white font-semibold italic text-2xl max-md:text-base max-md:py-20"
                    x-data="{
                        quotes: {{$quotesJson}},
                        currentQuote: '---------------',
                        updateQuote() {
                            const hour = new Date().getHours();
                            const index = hour % this.quotes.length;
                            this.currentQuote = this.quotes[index];
                        }
                    }" x-init="updateQuote()" x-text="currentQuote">
                </h2>
            </div>

            <div class="w-full flex justify-between pb-5 max-md:pb-3 items-end">
                <div
                    class="flex gap-2 items-center pr-9 bg-[#00000066] rounded-[32px] p-1 max-md:p-[2px] max-md:pr-9 max-md:gap-1">
                    <div
                        class="w-12 h-12 max-md:w-7 max-md:h-7 rounded-full bg-red-600 flex items-center justify-center">
                        <i class="ri-user-fill text-3xl max-md:text-base text-white"></i>
                    </div>
                    <div class="flex flex-col gap-[2px] ">
                        <div class="font-medium text-white text-base max-md:text-xs max-md:leading-none">
                            {{ $user->karyawan->nama }}</div>
                        <div class="font-light text-white text-xs max-md:text-[10px] max-md:leading-none">
                            K/{{ $user->karyawan->divisi->divisi ?? '???' }}/{{ $user->karyawan->nip ?? '???' }}/{{ $formattedDate }}/{{ $user->karyawan->id ?? '???' }}
                        </div>
                    </div>
                </div>
                <i data-modal-target="popup-modal" data-modal-toggle="popup-modal"
                    class="cursor-pointer ri-logout-box-r-line text-3xl max-md:text-xl text-white"></i>
            </div>
        </div>
    </div>
    <x-popup_button title="Log out" description="Apa anda yakin ingin keluar?"></x-popup_button>
</header>
