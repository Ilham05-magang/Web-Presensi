<x-layout.layout-admin>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="flex items-center justify-between w-full px-10 py-8 text-2xl">
        <div class="flex gap-1">
            <a href="{{ route('dashboard.gaji.riwayat', $data->karyawan->id) }}"><i
                    class="py-1 pr-3 text-2xl hover:text-blue-600 ri-arrow-left-line"></i></a>
            <h1>{{ $title }} Karyawan {{ $data->karyawan->nama }} {{ $data->periode }}</h1>
        </div>
        <button id="editButton" data-modal-target="editRiwayatGaji" data-modal-toggle="editRiwayatGaji"
            class="text-white hover:bg-yellow-300 hover:text-gray-800 bg-yellow-400 px-2 rounded-lg py-1.5 text-center text-xl font-medium ">
            <i class="ri-edit-2-line"></i>
        </button>
    </div>
    <hr class="border-t-2 border-gray-200">
    <div class="p-5 capitalize ">
        <form action="{{ route('dashboard.gaji.edit', $data->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="relative p-5 overflow-x-auto border border-gray-200 shadow-md rounded-xl">
                <table class="w-full text-sm text-black bg-blue-100 table-auto text-start rtl:text-right">
                    <tbody id="tabelBody1 ">
                        <tr class="p-3 text-black bg-white text-start">
                            <td class="px-4 py-1 w-[50%]">
                                Periode
                            </td>
                            <td class="px-1 flex items-center w-[50%]">
                                :
                                <input readonly
                                    class="w-full font-bold text-black h-7 px-1 py-0 text-start text-sm border-none"
                                    type="text" name="Periode" value="{{ $data->periode }}" id="" readonly>
                            </td>
                        </tr>
                        <tr class="p-3 text-black bg-white text-start">
                            <td class="px-4 py-1">
                                Nama
                            </td>
                            <td class="px-1 py-1 flex items-center">
                                :
                                {{ $data->karyawan->nama }}
                            </td>
                        </tr>
                        <tr class="p-3 text-black bg-white text-start">
                            <td class="px-4 py-1">
                                Metode Pembayaran
                            </td>
                            <td class="px-1 py-1 flex items-center">
                                :
                                <input readonly class="editgaji px-1 py-0 text-sm border-none bg-white" type="text"
                                    name="MetodePembayaran" value="Transfer" id="">
                            </td>
                        </tr>
                        <tr class="uppercase bg-[#242947] py-14 rounded-t-lg">
                            <td class=" border-[#242947] rounded-tl-lg">
                                <input readonly
                                    class="rounded-tl-lg bg-[#242947] text-white w-full h-7 text-sm border-none"
                                    type="text" name="ShiftPeriode" value="{{ $data->shift }}" id="">
                            </td>
                            <td class="text-end border-[#242947] rounded-tr-lg">
                                <input readonly
                                    class="rounded-tr-lg text-end bg-[#242947] text-white w-full h-7 text-sm border-none"
                                    type="text" name="ShiftTotal" value="{{ $data->shift_total }}" id="">
                            </td>
                        </tr>
                        @foreach ($data->gajiHeader as $gajiHeader)
                            <tr class="text-start">
                                <td class=" border-[#242947] border-[1px]">
                                    <input readonly
                                        class="editgaji bg-gray-300/70  w-full h-7 px-3 py-0 text-sm bg-blue-100 border-none"
                                        type="text" name="gajiHeaderName{{ $loop->iteration }}"
                                        value="{{ $gajiHeader->name }}" id="">
                                </td>
                                <td class="border-[#242947] border-[1px]">
                                    <input readonly
                                        class="w-full h-7 px-3 py-0 text-sm text-right  border-none bg-gray-300/70 "
                                        type="text" name="gajiHeaderValue{{ $loop->iteration }}"
                                        value="{{ $gajiHeader->value }}" id="">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="px-3 py-2 text-base font-bold">
                    Honorarium
                </div>
                <table class="w-full text-sm text-black bg-blue-100 rounded-b-lg table-auto text-start rtl:text-right">
                    <tbody id="tabelBody2">
                        @php
                            $counterRequest = 1;
                        @endphp
                        @foreach ($data->gajiDetail as $gajiDetail)
                            <tr class="border-[#242947] border-[1px]">
                                @if ($gajiDetail->value == null && $gajiDetail->multiply == null)
                                    <td class="flex items-center font-bold gap-1">
                                        <input
                                            class="editgaji bg-gray-300/70 w-full h-7 px-3 py-0 text-sm  border-none"
                                            type="text" name="gajiDetailName{{ $counterRequest }}"
                                            value="{{ $gajiDetail->name }}">
                                    </td>
                                    <td class="border-[#242947] font-bold border-[1px] w-[50%]">
                                        <input id="TotalHonor" name="gajiDetailTotalValue{{ $counterRequest }}"
                                            class="bg-gray-300/70 w-full h-7 px-3 py-0 text-sm text-right  border-none"
                                            type="text" value="{{ $gajiDetail->value_total }}" readonly>
                                    </td>
                                @else
                                    <td class="flex items-center">
                                        <input readonly
                                            class=" editgaji bg-gray-300/70 w-full h-7  px-3 py-0 text-sm border-none"
                                            type="text" name="gajiDetailName{{ $counterRequest }}"
                                            value="{{ $gajiDetail->name }}">
                                        <div class="flex items-center gap-1 px-2 bg-gray-300/70 editgaji">
                                            (<input readonly id="Hadir{{ $counterRequest }}"
                                                name="gajiDetailQTY{{ $counterRequest }}"
                                                class=" editgaji2 bg-gray-300/10 w-10 h-7 px-0 py-0 text-sm text-center border-none"
                                                type="number" value="{{ $gajiDetail->multiply }}">
                                            x
                                            <input readonly id="HadirValue{{ $counterRequest }}"
                                                name="gajiDetailValue{{ $counterRequest }}"
                                                class=" editgaji2 bg-gray-300/10 h-7 px-0 py-0 text-sm text-center  border-none w-28"
                                                type="number" value="{{ $gajiDetail->value }}">)
                                        </div>
                                    </td>
                                    <td class="border-[#242947] border-[1px] w-[50%]">
                                        <input id="totalHadir{{ $counterRequest }}"
                                            name="gajiDetailTotalValue{{ $counterRequest }}"
                                            class="w-full bg-gray-300/70  h-7 px-3 py-0 text-sm text-right  border-none"
                                            type="text" value="{{ $gajiDetail->value_total }}" readonly>
                                    </td>
                                    @php
                                        $counterRequest++;
                                    @endphp
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <table class="w-full my-3 text-sm table-auto text-start">
                    <tbody class="w-full align-top border-t ">
                        <tr>
                            <td class="w-1/2"></td>
                            <td class="w-1/2 text-base font-bold">Note:</td>
                        </tr>
                        <tr>
                            <td class="px-3">Yogyakarta, {{ $datenow }}</td>
                            <td>
                                <textarea readonly name="note" id="" rows="4" class="text-sm editgaji w-full"
                                    placeholder="Tambahkan Catatan....">{{ $data->note }}</textarea>
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
                <div class="flex justify-end gap-3 py-4">
                    <div id="BatalEdit"
                        class=" cursor-pointer w-32 hidden text-white bg-red-600 hover:bg-red-500 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-800 dark:hover:bg-red-700 dark:focus:ring-red-800">
                        Batal
                    </div>
                    <button type="submit" id="submitForm"
                        class=" w-32 hidden text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Simpan
                    </button>
                </div>
            </div>
        </form>
    </div>
    <x-admin.popup-gaji :data="$data"  title="editRiwayatGaji" id="editRiwayatGaji" action=""
        method="POST"></x-admin.popup-gaji>
    <script src="https://cdn.jsdelivr.net/npm/cleave.js@1.6.0/dist/cleave.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function updateTotalValue() {
                let totalHonor = 0;

                // Calculate total for Hadir
                for (let i = 1; i < counterRequest; i++) {
                    let hadValue = parseFloat(document.getElementById('Hadir' + i).value) || 0;
                    let hadValueVal = parseFloat(document.getElementById('HadirValue' + i).value) || 0;
                    let resultHadir = hadValue * hadValueVal;
                    document.getElementById('totalHadir' + i).value = new Intl.NumberFormat('id-ID', {
                        style: 'currency',
                        currency: 'IDR'
                    }).format(resultHadir);
                    totalHonor += resultHadir;
                }

                // Calculate Total Honor
                let formattedResultHonor = new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR'
                }).format(totalHonor);

                document.getElementById('TotalHonor').value = formattedResultHonor;
            }

            // Initialize counters
            let counterRequest = {{ $counterRequest ?? 0 }};

            // Add event listeners for input fields
            for (let i = 1; i < counterRequest; i++) {
                document.getElementById('Hadir' + i).addEventListener('input', updateTotalValue);
                document.getElementById('HadirValue' + i).addEventListener('input', updateTotalValue);
            }

            // Initial calculation
            updateTotalValue();
        });

        const editGajiButton = document.querySelector('#editButtonGaji');
        const editGajiStatus = document.querySelectorAll('.editgaji');
        const editGajiStatus2 = document.querySelectorAll('.editgaji2');
        const editButton = document.querySelector('#editButton')

        editGajiButton.addEventListener('click', function() {
            editButton.disabled = true; // Disable the edit button
            editButton.classList.toggle('text-white');
            editButton.classList.toggle('hover:bg-yellow-300');
            submitForm.classList.remove('hidden');
            BatalEdit.classList.remove('hidden');

            editGajiStatus.forEach(function(element) {
                element.classList.add('bg-blue-100');
                element.classList.remove('read-only:text-gray-600');
                element.classList.remove('bg-gray-300/70');
                element.classList.remove('bg-gray-300/10');
                if (element.tagName === 'INPUT') {
                    element.removeAttribute('readonly'); // Remove readonly attribute
                }
                
                if (element.tagName === 'TEXTAREA') {
                    element.classList.add('bg-white');
                    element.classList.remove('bg-gray-300/70');
                }
                element.removeAttribute('readonly'); // Remove readonly attribute
            });

            editGajiStatus2.forEach(function(element) {
                element.classList.add('bg-blue-100');
                element.classList.remove('bg-gray-300/70');
                if (element.tagName === 'INPUT') {
                    element.removeAttribute('readonly'); // Remove readonly attribute
                    element.classList.remove('bg-gray-300/10');
                }
            });
        });

        BatalEdit.addEventListener('click', function() {
            editButton.disabled = false; // Enable the edit button again
            submitForm.classList.add('hidden');
            BatalEdit.classList.add('hidden');
            editButton.classList.toggle('text-white');
            editButton.classList.toggle('hover:bg-yellow-300');

            editGajiStatus.forEach(function(element) {
                element.classList.add('bg-gray-300/70');
                element.classList.remove('bg-blue-100');
                if (element.tagName === 'INPUT') {
                    element.setAttribute('readonly', true); // Set readonly attribute
                }
               
                if (element.tagName === 'TEXTAREA') {
                    element.classList.add('bg-white');
                    element.classList.remove('bg-gray-300/70');
                    element.setAttribute('readonly', true); // Set readonly attribute
                }

            });

            editGajiStatus2.forEach(function(element) {
                if (element.tagName === 'INPUT') {
                    element.classList.remove('bg-blue-100');
                    element.setAttribute('readonly', true); // Remove readonly attribute
                    element.classList.add('bg-gray-300/10');
                }
            });
        });
    </script>

</x-layout.layout-admin>
