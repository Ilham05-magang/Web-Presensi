<x-layout.layout-admin>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="flex items-center justify-between w-full px-10 py-8 text-2xl">
        <div class="flex gap-1">
            <a href="{{ route('dashboard.gaji') }}"><i
                    class="py-1 pr-3 text-2xl hover:text-blue-600 ri-arrow-left-line"></i></a>
            <h1>{{ $title }} {{$karyawan->nama}}</h1>
        </div>
        <div class="p-4">
            <form class="flex items-center max-w-md mx-auto space-x-4"
                action="{{ route('dashboard.gaji.input.search', $karyawan->id) }}" method="GET">
                @csrf
                <div class="flex items-center justify-center gap-3 text-base">
                    <input type="date" name="tanggal_mulai" value="{{ $tanggalMulai ?? 0 }}"
                        class="block w-full py-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <h2 class="lowercase">s.d.</h2>
                    <input type="date" name="tanggal_selesai" value="{{ $tanggalSelesai ?? 0 }}"
                        class="block w-full py-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>

                <button type="submit"
                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-[#242947] border border-transparent rounded-md shadow-sm hover:bg-[#242947]/80 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 19l-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                    <span class="sr-only">Search</span>
                </button>
            </form>
        </div>
    </div>
    <hr class="border-t-2 border-gray-200">
    <div class="p-5 capitalize">
        @if ($tanggalMulai == null)
            <div>
                <h3 class="text-2xl font-bold text-center">Silakan Masukkan Periode Terlebih Dahulu</h3>
            </div>
        @else
            @php
                $tanggalMulai = Carbon\Carbon::parse($tanggalMulai)->locale('id')->translatedFormat('d M');
                $tanggalSelesai = Carbon\Carbon::parse($tanggalSelesai)->locale('id')->translatedFormat('d M Y');
            @endphp

            <form action="{{ route('dashboard.post.gaji', $karyawan->id) }}" method="POST">
                @csrf
                @method('POST')
                <div class="relative p-5 overflow-x-auto border border-gray-200 shadow-md rounded-xl">
                    <table class="w-full text-sm text-black bg-blue-100 table-auto text-start rtl:text-right">
                        <tbody id="tabelBody1">
                            <tr class="p-3 text-black bg-white text-start">
                                <td class="px-4 py-1 w-[50%]">
                                    Periode
                                </td>
                                <td class="px-1 flex items-center w-[50%]">
                                    :
                                    <input class="w-full font-bold text-black h-7 px-1 py-0 text-start text-sm border-none" type="text" name="Periode"
                                        value="{{ $tanggalMulai . ' - ' . $tanggalSelesai }}" id="" readonly>
                                </td>
                            </tr>
                            <tr class="p-3 text-black bg-white text-start">
                                <td class="px-4 py-1">
                                    Nama
                                </td>
                                <td class="px-1 py-1 flex items-center">
                                    :
                                    {{ $karyawan->nama }}
                                </td>
                            </tr>
                            <tr class="p-3 text-black bg-white text-start">
                                <td class="px-4 py-1">
                                    Metode Pembayaran
                                </td>
                                <td class="px-1 py-1 flex items-center">
                                    :
                                    <input class="px-1 py-0 text-sm border-none" type="text" name="MetodePembayaran"
                                        value="Transfer" id="">
                                </td>
                            </tr>
                            <tr class="uppercase bg-[#242947] py-14 rounded-t-lg">
                                <td class=" border-[#242947] rounded-tl-lg">
                                    <input class="rounded-tl-lg bg-[#242947] text-white w-full h-7 text-sm border-none"
                                        type="text" name="ShiftPeriode"
                                        value="Total Shift ({{ $tanggalMulai . ' - ' . $tanggalSelesai }})" id=""
                                        readonly>
                                </td>
                                <td class="text-end border-[#242947] rounded-tr-lg">
                                    <input class="rounded-tr-lg text-end bg-[#242947] text-white w-full h-7 text-sm border-none"
                                        type="text" name="ShiftTotal"
                                        value="{{ $jumlahHariTanpaMinggu - $jumlahTanggalLibur }}" id=""
                                        readonly>
                                </td>
                            </tr>
                            <tr class="text-start">
                                <td class=" border-[#242947] border-[1px]">
                                    <input class="w-full h-7 px-3 py-0 text-sm bg-blue-100 border-none"
                                        type="text" name="gajiHeaderName1" value="Terlambat" id="">
                                </td>
                                <td class="border-[#242947] border-[1px]">
                                    <input class="w-full h-7 px-3 py-0 text-sm text-right  border-none bg-gray-300/70 "
                                        type="text" name="gajiHeaderValue1" value="{{ $totalTelat }}"
                                        id="" readonly>
                                </td>
                            </tr>
                            <tr class="text-start">
                                <td class=" border-[#242947] border-[1px]">
                                    <input class="w-full h-7 px-3 py-0 text-sm bg-blue-100 border-none"
                                        type="text" name="gajiHeaderName2" value="Ijin Pulang Awal" id="">
                                </td>
                                <td class="border-[#242947] border-[1px]">
                                    <input class="w-full h-7 px-3 py-0 text-sm text-right bg-gray-300/70  border-none"
                                        type="text" name="gajiHeaderValue2" value="{{ $totalPulangCepat }}"
                                        id="" readonly>
                                </td>
                            </tr>
                            <tr class="text-start">
                                <td class=" border-[#242947] border-[1px]">
                                    <input class="w-full h-7 px-3 py-0 text-sm bg-blue-100 border-none"
                                        type="text" name="gajiHeaderName3" value="Tidak Hadir" id="">
                                </td>
                                <td class="border-[#242947] border-[1px]">
                                    <input
                                        class="w-full h-7 px-3 py-0 text-sm text-right bg-gray-300/70  border-none"
                                        type="text" name="gajiHeaderValue3"
                                        value="{{ $totaltidakmasuk + $totalIzin }}"readonly>
                                </td>
                            </tr>
                            <tr class="text-start">
                                <td class=" border-[#242947] border-[1px]">
                                    <input class="w-full h-7 px-3 py-0 text-sm bg-blue-100 border-none"
                                        type="text" name="gajiHeaderName4" value="Total Hadir Disiplin">
                                </td>
                                <td class="border-[#242947] border-[1px]">
                                    <input
                                        class="w-full h-7 px-3 py-0 text-sm text-right bg-gray-300/70  border-none"
                                        type="text" name="gajiHeaderValue4"
                                        value="{{ $totalmasuk - $totalTelat - $totalPulangCepat - $absensiLemburTotal }}"
                                        id="" readonly>
                                </td>
                            </tr>
                            <tr class="text-start">
                                <td class=" border-[#242947] border-[1px]">
                                    <input class="w-full h-7 px-3 py-0 text-sm bg-blue-100 border-none"
                                        type="text" name="gajiHeaderName5" value="Total Lembur Minggu">
                                </td>
                                <td class="border-[#242947] border-[1px]">
                                    <input
                                        class="w-full h-7 px-3 py-0 text-sm text-right bg-gray-300/70  border-none"
                                        type="text" name="gajiHeaderValue5" value="{{ $absensiLemburTotal }}"
                                        readonly>
                                </td>
                            </tr>
                            <tr class="text-start">
                                <td class=" border-[#242947] border-[1px]">
                                    <input class="w-full h-7 px-3 py-0 text-sm bg-blue-100 border-none"
                                        type="text" name="gajiHeaderName6" value="Total Kehadiran"
                                        id="">
                                </td>
                                <td class="border-[#242947] border-[1px]">
                                    <input
                                        class="w-full h-7 px-3 py-0 text-sm text-right bg-gray-300/70  border-none"
                                        type="text" name="gajiHeaderValue6"
                                        value="{{ $totalmasuk - $absensiLemburTotal }}" id="" readonly>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="pt-2">
                        <div id="buttonTambahKolom"
                            class="w-8 h-8 flex mx-auto items-center justify-center text-white hover:bg-[#5B6390] border-2 border-[#242947] bg-[#242947] rounded-lg cursor-pointer">
                            <i class="text-xl ri-add-circle-line"></i>
                        </div>
                    </div>
                    <div class="px-3 text-base font-bold">
                        Honorarium
                    </div>
                    <table
                        class="w-full text-sm text-black bg-blue-100 rounded-b-lg table-auto text-start rtl:text-right">
                        <tbody id="tabelBody2">
                            @php
                                $totalHonor = 0;
                                $counterHadir = 1;
                                $counterDisiplin = 1;
                                $counterLembur = 1;
                                $counterCustom = 1;
                                $counterRequest = 1;
                            @endphp
                            @foreach ($gaji as $default)
                                @if ($default->status == 1)
                                    <tr class="border-[#242947] border-[1px]">
                                        <td class="flex items-center gap-1">
                                            <input class="w-full h-7 px-3 py-0 text-sm bg-blue-100 border-none"
                                                type="text" name="gajiDetailName{{ $counterRequest }}"
                                                value="{{ $loop->iteration }}. {{ $default->name }}">
                                            <div class="flex items-center gap-1 px-2">
                                                <p>(</p>
                                                <input id="Hadir{{ $counterHadir }}"
                                                    name="gajiDetailQTY{{ $counterRequest }}"
                                                    class="w-10 h-7 px-0 py-0 text-sm text-center bg-blue-100 border-none"
                                                    type="text" value="{{ $totalmasuk - $absensiLemburTotal }}">
                                                <p>x</p>
                                                <input id="HadirValue{{ $counterHadir }}"
                                                    name="gajiDetailValue{{ $counterRequest }}"
                                                    class="h-7 px-0 py-0 text-sm text-center bg-blue-100 border-none w-28"
                                                    type="text" value="{{ $default->value }}">
                                                <p>)</p>
                                            </div>
                                        </td>
                                        <td class="border-[#242947] border-[1px] w-[50%]">
                                            <input id="totalHadir{{ $counterHadir }}"
                                                name="gajiDetailTotalValue{{ $counterRequest }}"
                                                class="w-full bg-gray-300/70  h-7 px-3 py-0 text-sm text-right bg-blue-100 border-none"
                                                type="text"
                                                value="{{ Number::currency(($totalmasuk - $absensiLemburTotal) * $default->value, 'IDR', locale: 'id_ID') }}"
                                                readonly>
                                        </td>
                                        @php
                                            $totalHonor += ($totalmasuk - $absensiLemburTotal) * $default->value;
                                            $counterHadir++;
                                            $counterRequest++;
                                        @endphp
                                    </tr>
                                @elseif ($default->status == 2)
                                    <tr class="border-[#242947] border-[1px]">
                                        <td class="flex items-center gap-1">
                                            <input class="w-full h-7 px-3 py-0 text-sm bg-blue-100 border-none"
                                                type="text" name="gajiDetailName{{ $counterRequest }}"
                                                value="{{ $loop->iteration }}. {{ $default->name }}">
                                            <div class="flex items-center gap-1 px-2">
                                                <p>(</p>
                                                <input id="disiplin{{ $counterDisiplin }}"
                                                    name="gajiDetailQTY{{ $counterRequest }}"
                                                    class="w-10 h-7 px-0 py-0 text-sm text-center bg-blue-100 border-none"
                                                    type="text"
                                                    value="{{ $totalmasuk - $totalTelat - $totalPulangCepat - $absensiLemburTotal }}">
                                                <p>x</p>
                                                <input id="disiplinValue{{ $counterDisiplin }}"
                                                    name="gajiDetailValue{{ $counterRequest }}"
                                                    class="h-7 px-0 py-0 text-sm text-center bg-blue-100 border-none w-28"
                                                    type="text" value="{{ $default->value }}">
                                                <p>)</p>
                                            </div>
                                        </td>
                                        <td class="border-[#242947] border-[1px] w-[50%]">
                                            <input id="totalDisiplin{{ $counterDisiplin }}"
                                                name="gajiDetailTotalValue{{ $counterRequest }}"
                                                class="w-full h-7 px-3 bg-gray-300/70  py-0 text-sm text-right bg-blue-100 border-none"
                                                type="text"
                                                value="{{ Number::currency(($totalmasuk - $totalTelat - $totalPulangCepat - $absensiLemburTotal) * $default->value, 'IDR', locale: 'id_ID') }}"
                                                readonly>
                                        </td>
                                        @php
                                            $totalHonor +=
                                                ($totalmasuk - $totalTelat - $totalPulangCepat - $absensiLemburTotal) *
                                                $default->value;
                                            $counterDisiplin++;
                                            $counterRequest++;
                                        @endphp
                                    </tr>
                                @elseif ($default->status == 3)
                                    <tr class="border-[#242947] border-[1px]">
                                        <td class="flex items-center gap-1">
                                            <input class="w-full h-7 px-3 py-0 text-sm bg-blue-100 border-none"
                                                type="text" name="gajiDetailName{{ $counterRequest }}"
                                                value="{{ $loop->iteration }}. {{ $default->name }}">
                                            <div class="flex items-center gap-1 px-2">
                                                <p>(</p>
                                                <input id="lembur{{ $counterLembur }}"
                                                    name="gajiDetailQTY{{ $counterRequest }}"
                                                    class="w-10 h-7 px-0 py-0 text-sm text-center bg-blue-100 border-none"
                                                    type="text" value="{{ $absensiLemburTotal }}">
                                                <p>x</p>
                                                <input id="lemburValue{{ $counterLembur }}"
                                                    name="gajiDetailValue{{ $counterRequest }}"
                                                    class="h-7 px-0 py-0 text-sm text-center bg-blue-100 border-none w-28"
                                                    type="text" value="{{ $default->value }}">
                                                <p>)</p>
                                            </div>
                                        </td>
                                        <td class="border-[#242947] border-[1px] w-[50%]">
                                            <input id="totalLembur{{ $counterLembur }}"
                                                name="gajiDetailTotalValue{{ $counterRequest }}"
                                                class="w-full h-7 px-3 bg-gray-300/70  py-0 text-sm text-right bg-blue-100 border-none"
                                                type="text"
                                                value="{{ Number::currency($absensiLemburTotal * $default->value, 'IDR', locale: 'id_ID') }}"
                                                readonly>
                                        </td>
                                        @php
                                            $totalHonor += $absensiLemburTotal * $default->value;
                                            $counterLembur++;
                                            $counterRequest++;
                                        @endphp
                                    </tr>
                                @elseif ($default->status == 4)
                                    <tr class="border-[#242947] border-[1px]">
                                        <td class="flex items-center gap-1">
                                            <input class="w-full h-7 px-3 py-0 text-sm bg-blue-100 border-none"
                                                type="text" name="gajiDetailName{{ $counterRequest }}"
                                                value="{{ $loop->iteration }}. {{ $default->name }}">
                                            <div class="flex items-center gap-1 px-2">
                                                <p>(</p>
                                                <input id="custom{{ $counterCustom }}"
                                                    name="gajiDetailQTY{{ $counterRequest }}"
                                                    class="w-10 h-7 px-0 py-0 text-sm text-center bg-blue-100 border-none"
                                                    type="text" value="1" readonly>
                                                <p>x</p>
                                                <input id="customValue{{ $counterCustom }}"
                                                    name="gajiDetailValue{{ $counterRequest }}"
                                                    class="h-7 px-0 py-0 text-sm text-center bg-blue-100 border-none w-28"
                                                    type="text" value="{{ $default->value }}">
                                                <p>)</p>
                                            </div>
                                        </td>
                                        <td class="border-[#242947] border-[1px] w-[50%]">
                                            <input id="totalcustom{{ $counterCustom }}"
                                                name="gajiDetailTotalValue{{ $counterRequest }}"
                                                class="w-full h-7 px-3 py-0 text-sm text-right bg-gray-300/70  border-none"
                                                type="text"
                                                value="{{ Number::currency(1 * $default->value, 'IDR', locale: 'id_ID') }}"
                                                readonly>
                                        </td>
                                        @php
                                            $totalHonor += 1 * $default->value;
                                            $counterCustom++;
                                            $counterRequest++;
                                        @endphp
                                    </tr>
                                @endif
                            @endforeach
                            <tr class="border-[#242947] border-[1px]">
                                <td class="">
                                    <input class="w-full h-7 px-3 py-0 text-sm font-bold bg-blue-100 border-none"
                                        type="text" name="gajiDetailName{{ $counterRequest }}"
                                        value="Total Honor">
                                </td>
                                <td class="border-[#242947] border-[1px]">
                                    <input id="TotalHonor"
                                        class="w-full h-7 px-3 py-0 text-sm text-right bg-gray-300/70  border-none"
                                        type="text" name="gajiDetailTotalValue{{ $counterRequest }}"
                                        value=" {{ Number::currency($totalHonor, 'IDR', locale: 'id_ID') }}"
                                        readonly>
                                </td>
                                @php
                                    $counterRequest++;
                                @endphp
                            </tr>
                        </tbody>
                    </table>
                    <div class="p-2">
                        <div id="buttonTambahKolom2"
                            class="w-8 h-8 flex mx-auto items-center justify-center text-white hover:bg-[#5B6390] border-2 border-[#242947] bg-[#242947] rounded-lg cursor-pointer">
                            <i class="text-xl ri-add-circle-line"></i>
                        </div>
                    </div>
                    <table class="w-full my-3 text-sm table-auto text-start">
                        <tbody class="w-full align-top border-t ">
                            <tr>
                                <td class="w-2/5"></td>
                                <td class="w-3/5 text-base font-bold">Note:</td>
                            </tr>
                            <tr>
                                <td class="px-3">Yogyakarta, {{ $datenow }}</td>
                                <td>
                                    <textarea name="note" id="" rows="4" class="w-full" placeholder="Tambahkan Catatan...."></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="px-3">HRD</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="flex justify-end py-4">
                    <button type="submit"
                        class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Submit
                    </button>
                </div>
            </form>
        @endif
    </div>
    <x-admin.popup-gaji title="Tambah Default Gaji" id="tambahdefaultgaji" action=""
        method="POST"></x-admin.popup-gaji>
    <script src="https://cdn.jsdelivr.net/npm/cleave.js@1.6.0/dist/cleave.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const buttonTambahKolom = document.querySelector('#buttonTambahKolom');
            let y = 7;

            buttonTambahKolom.addEventListener('click', function() {
                const customGaji = document.querySelector('#tabelBody1');

                const newTd = `
                <td class=" border-[#242947] border-[1px]">
                    <input id="customHeader_${y}" class="w-full h-7 px-0 px-3 py-0 text-sm bg-blue-100 border-none" type="text" name="gajiHeaderName${y}"
                        placeholder="Nama" id="">
                </td>
                <td class="border-[#242947] border-[1px]">
                    <input class="w-full h-7 px-0 px-3 py-0 text-sm text-right bg-blue-100 border-none" type="text" name="gajiHeaderValue${y}"
                        placeholder="Jumlah" id="customHeaderValue_${y}">
                </td>
                `;

                customGaji.insertAdjacentHTML('beforeend', newTd);
                y++;
            });

            let x = 1;

            function updateTotal(custom, customValue, customTotal) {
                const cusValue = parseFloat(custom.value) || 0;
                const cusValueVal = parseFloat(customValue.value) || 0;
                const resultCustom = cusValue * cusValueVal;
                const formattedResultCustom = new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR'
                }).format(resultCustom);
                customTotal.value = formattedResultCustom;
            }

            const buttonTambahKolom2 = document.querySelector('#buttonTambahKolom2');
            buttonTambahKolom2.addEventListener('click', function() {
                const tabelBody2 = document.querySelector('#tabelBody2');
                const totalHonorRow = tabelBody2.querySelector('tr:last-child');

                let counterRequest = {{ $counterRequest ?? 0 }};

                const newRow = document.createElement('tr');
                newRow.classList.add('border-[#242947]', 'border-[1px]');
                newRow.innerHTML = `
                    <td class="flex items-center gap-1">
                        <input class="w-full h-7 px-0 px-3 py-0 text-sm bg-blue-100 border-none" type="text" name="gajiDetailName${counterRequest}"
                        placeholder='Masukkan Nama'>
                        <div class="flex items-center gap-1 px-2">
                            <p>(</p>
                            <input id="custom1_${x}" class="w-10 h-7 px-0 py-0 text-sm text-center bg-blue-100 border-none" type="text" name="gajiDetailQTY${counterRequest}"
                            placeholder='QTY'>
                            <p>x</p>
                            <input id="custom1Value_${x}" class="h-7 px-0 py-0 text-sm text-center bg-blue-100 border-none w-28" type="text" name="gajiDetailValue${counterRequest}"
                            placeholder='Nominal'>
                            <p>)</p>
                        </div>
                    </td>
                    <td class="border-[#242947] border-[1px] w-[50%]">
                        <input id="custom1total_${x}" class="w-full h-7 px-0 px-3 py-0 text-sm text-right bg-gray-300/70 border-none" type="text" name="gajiDetailTotalValue${counterRequest}"
                            value="Rp0,00" readonly>
                    </td>
                `;

                tabelBody2.insertBefore(newRow, totalHonorRow);

                const custom = document.getElementById(`custom1_${x}`);
                const customValue = document.getElementById(`custom1Value_${x}`);
                const customTotal = document.getElementById(`custom1total_${x}`);

                custom.addEventListener('input', function() {
                    updateTotal(custom, customValue, customTotal);
                    updateTotalValue(); // Update overall total when custom inputs change
                });

                customValue.addEventListener('input', function() {
                    updateTotal(custom, customValue, customTotal);
                    updateTotalValue(); // Update overall total when custom inputs change
                });

                counterRequest++;
                x++;
            });

            function updateTotalValue() {
                let totalHonor = 0;

                // Calculate total for Hadir
                for (let i = 1; i < counterHadir; i++) {
                    let hadValue = parseFloat(document.getElementById('Hadir' + i).value) || 0;
                    let hadValueVal = parseFloat(document.getElementById('HadirValue' + i).value) || 0;
                    let resultHadir = hadValue * hadValueVal;
                    document.getElementById('totalHadir' + i).value = new Intl.NumberFormat('id-ID', {
                        style: 'currency',
                        currency: 'IDR'
                    }).format(resultHadir);
                    totalHonor += resultHadir;
                }

                // Calculate total for Disiplin
                for (let i = 1; i < counterDisiplin; i++) {
                    let disValue = parseFloat(document.getElementById('disiplin' + i).value) || 0;
                    let disValueVal = parseFloat(document.getElementById('disiplinValue' + i).value) || 0;
                    let resultDisiplin = disValue * disValueVal;
                    document.getElementById('totalDisiplin' + i).value = new Intl.NumberFormat('id-ID', {
                        style: 'currency',
                        currency: 'IDR'
                    }).format(resultDisiplin);
                    totalHonor += resultDisiplin;
                }

                // Calculate total for Lembur
                for (let i = 1; i < counterLembur; i++) {
                    let lemValue = parseFloat(document.getElementById('lembur' + i).value) || 0;
                    let lemValueVal = parseFloat(document.getElementById('lemburValue' + i).value) || 0;
                    let resultLembur = lemValue * lemValueVal;
                    document.getElementById('totalLembur' + i).value = new Intl.NumberFormat('id-ID', {
                        style: 'currency',
                        currency: 'IDR'
                    }).format(resultLembur);
                    totalHonor += resultLembur;
                }

                // Calculate total for custom rows
                for (let i = 1; i < counterCustom; i++) {
                    let cusValue = parseFloat(document.getElementById('custom' + i).value) || 0;
                    let cusValueVal = parseFloat(document.getElementById('customValue' + i).value) || 0;
                    let resultCustom = cusValue * cusValueVal;
                    document.getElementById('totalcustom' + i).value = new Intl.NumberFormat('id-ID', {
                        style: 'currency',
                        currency: 'IDR'
                    }).format(resultCustom);
                    totalHonor += resultCustom;
                }

                let totalCustomadd = 0;
                document.querySelectorAll('[id^="custom1total_"]').forEach(function(el) {
                    let valueStr = el.value.replace(/[^0-9,-]/g, '');
                    let value = parseFloat(valueStr.replace(',', '.')) || 0;
                    totalCustomadd += value;
                });

                // Calculate Total Honor
                let formattedResultHonor = new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR'
                }).format(totalHonor + totalCustomadd);
                document.getElementById('TotalHonor').value = formattedResultHonor;
            }

            // Initialize counters
            let counterHadir = {{ $counterHadir ?? 0 }};
            let counterDisiplin = {{ $counterDisiplin ?? 0 }};
            let counterLembur = {{ $counterLembur ?? 0 }};
            let counterCustom = {{ $counterCustom ?? 0 }};

            // Add event listeners for input fields
            for (let i = 1; i < counterHadir; i++) {
                document.getElementById('Hadir' + i).addEventListener('input', updateTotalValue);
                document.getElementById('HadirValue' + i).addEventListener('input', updateTotalValue);
            }

            for (let i = 1; i < counterDisiplin; i++) {
                document.getElementById('disiplin' + i).addEventListener('input', updateTotalValue);
                document.getElementById('disiplinValue' + i).addEventListener('input', updateTotalValue);
            }

            for (let i = 1; i < counterLembur; i++) {
                document.getElementById('lembur' + i).addEventListener('input', updateTotalValue);
                document.getElementById('lemburValue' + i).addEventListener('input', updateTotalValue);
            }

            for (let i = 1; i < counterCustom; i++) {
                document.getElementById('custom' + i).addEventListener('input', updateTotalValue);
                document.getElementById('customValue' + i).addEventListener('input', updateTotalValue);
            }

            // Initial calculation
            updateTotalValue();
        });
    </script>

</x-layout.layout-admin>
