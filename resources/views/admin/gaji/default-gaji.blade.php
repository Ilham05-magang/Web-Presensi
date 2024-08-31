<x-layout.layout-admin>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="flex items-center justify-between w-full px-10 py-8 text-2xl">
        <div class="flex gap-1">
            <a href="{{ route('dashboard.gaji') }}"><i
                    class="py-1 pr-3 text-2xl hover:text-blue-600 ri-arrow-left-line"></i></a>
            <h1>{{ $title }}</h1>
        </div>
        <button data-modal-target="tambahdefaultgaji" data-modal-toggle="tambahdefaultgaji"
            class="text-white hover:bg-[#5B6390] border-2 border-[#242947] font-bold bg-[#242947] px-2 rounded-lg py-1 text-center text-xl font-medium">
            <i class="text-2xl ri-add-circle-line"></i>
        </button>
    </div>
    <hr class="border-t-2 border-gray-200">
    <div class="p-5 capitalize">
        <div class="relative overflow-x-auto shadow-md sm:rounded-t-xl">
            <table class="w-full text-sm text-center text-black bg-blue-100 rounded-b-lg rtl:text-right">
                <thead class="text-xs uppercase bg-[#242947] py-14 border-[1px] border-[#242947] text-white">
                    <tr>
                        <th scope="col" class="p-1">
                            No
                        </th>
                        <th scope="col" class="px-2 py-5">
                            Nama
                        </th>
                        <th scope="col" class="px-2 py-5">
                            Value
                        </th>
                        <th scope="col" class="px-2 py-5">
                            Status
                        </th>
                        <th scope="col" class="px-2 py-5">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-[#242947] border-[1px]">
                        <td class="px-1 py-3 border-[#242947] border-[1px]">
                            1
                        </td>
                        <td class="px-1 py-3 border-[#242947] border-[1px]">
                            Honor Utama
                        </td>
                        <td class="px-1 py-3 border-[#242947] border-[1px]">
                            70000
                        </td>
                        <td class="px-1 py-3 border-[#242947] border-[1px]">
                            1
                        </td>
                        <td class="px-1 py-3 border-[#242947] border-[1px]">
                            <button data-modal-target="editgaji" data-modal-toggle="editgaji"
                                class="px-2 py-1 mr-3 text-base font-medium text-center text-white bg-yellow-400 rounded-lg hover:bg-yellow-300 hover:text-gray-800">
                                <i class="ri-edit-2-line"></i>
                                <button data-modal-target="deletegaji" data-modal-toggle="deletegaji"
                                    class="px-2 py-1 ml-4 text-base font-medium text-center text-white bg-red-500 rounded-lg hover:bg-red-400 hover:text-gray-800">
                                    <i class="ri-delete-bin-6-line"></i>
                                </button>
                        </td>

                    </tr>
                    <x-admin.popup-gaji title="Edit Gaji" id="editgaji" action=""
                        method="PUT"></x-admin.popup-gaji>
                    <x-admin.popup-gaji title="deletegaji" id="deletegaji" action=""></x-admin.popup-gaji>
                    {{-- <x-admin.popup-admin title="delete" :action="route('dashboard.deletekaryawan',$data->id)"
                        :id="'delete' . $data->id" :data="$data->nama" /> --}}

                </tbody>
            </table>
        </div>
    </div>
    <x-admin.popup-gaji title="Tambah Default Gaji" id="tambahdefaultgaji" action=""
        method="POST"></x-admin.popup-gaji>
</x-layout.layout-admin>
