<x-layout.layout-admin>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="flex items-center justify-between w-full px-10 py-8 text-2xl">
        <div class="flex gap-1">
            <a href="{{ route('dashboard.gaji') }}"><i
                    class="py-1 pr-3 text-2xl hover:text-blue-600 ri-arrow-left-line"></i></a>
            <h1>{{ $title }} {{ $data->first()->karyawan->nama }}</h1>
        </div>
    </div>
    <hr class="border-t-2 border-gray-200">
    <div class="p-5 capitalize">
        <div class="relative overflow-x-auto shadow-md ">
            <div class=" grid grid-cols-2 gap-5">
                @foreach ($data as $data)
                    <div class="border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 p-4">
                        <div class="flex justify-between py-2">
                            <div>
                                <h1 class="font-semibold text-base">
                                    {{ $data->periode }}
                                </h1>
                            </div>
                            <div>
                                <a href="{{ route('dashboard.gaji.detail') }}"
                                    class="px-1 py-2 pl-2 text-sm font-medium text-center text-white bg-yellow-400 rounded-lg hover:bg-yellow-300 hover:text-gray-800">
                                    <i class="ri-eye-2-line"></i>
                                </a>
                                <button data-modal-target="deletegaji" data-modal-toggle="deletegaji"
                                    class="px-2 py-1 ml-4 text-base font-medium text-center text-white bg-red-500 rounded-lg hover:bg-red-400 hover:text-gray-800">
                                    <i class="ri-delete-bin-6-line"></i>
                                </button>
                            </div>
                        </div>
                        <table class="w-full text-sm text-start text-black bg-blue-100 ">
                            <tbody>
                                <tr class="bg-[#242947] text-white rounded-t-lg">
                                    <td class="px-2 py-1 border-[#242947] rounded-tl-lg ">
                                        {{ $data->shift }}
                                    </td>
                                    <td class="px-2 py-1 text-end rounded-tr-lg border-[#242947]">
                                        {{ $data->shift_total }}

                                    </td>
                                </tr>
                                <tr class="bg-[#242947] text-white border-white border-t">
                                    <td class="px-2 py-1 border-[#242947] ">
                                        Metode Pembayaran
                                    </td>
                                    <td class="px-2 py-1 text-end border-[#242947]">
                                        {{ $data->method }}
                                    </td>
                                </tr>
                                {{-- Foreach gaji header disini --}}
                                @foreach ($data->gajiHeader as $gajiHeader)
                                    <tr class="text-start">
                                        <td class="px-2 border-[#242947] border-[1px]">
                                            {{ $gajiHeader->name }}
                                        </td>
                                        <td class=" px-2 text-end border-[#242947] border-[1px]">
                                            {{ $gajiHeader->value }}
                                        </td>
                                    </tr>
                                @endforeach
                                <tr class="bg-white font-bold">
                                    <td class="pt-2">Honorarium</td>
                                    <td></td>
                                </tr>
                                {{-- Foreach gaji detail disini --}}
                                @foreach ($data->gajiDetail as $gajiDetail)
                                    <tr class=" border-[#242947] border-[1px] {{$gajiDetail->value == null && $gajiDetail->multiply == null ? 'font-bold' : ''}}">
                                        <td class=" px-2 border-[#242947] border-[1px]">
                                            {{ $gajiDetail->name }}
                                        </td>
                                        <td class="px-2 text-end border-[#242947] border-[1px]">
                                            {{ $gajiDetail->value_total }}
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="2" class="bg-white font-bold pt-2"> Note</td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="bg-white border border-[#242947] p-2">{{$data->note}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <x-admin.popup-gaji title="Tambah Default Gaji" id="tambahdefaultgaji" action=""
        method="POST"></x-admin.popup-gaji>
</x-layout.layout-admin>
