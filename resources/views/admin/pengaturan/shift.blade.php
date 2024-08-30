<x-layout.layout-admin>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="flex items-center justify-between w-full px-10 py-8 text-2xl">
        <h1>{{ $title }}</h1>
        <button data-modal-target="tambahshift"
            data-modal-toggle="tambahshift"
                class="text-white hover:bg-[#5B6390] border-2 border-[#242947] font-bold bg-[#242947] px-2 rounded-lg py-1 text-center text-xl font-medium">
                <i class="text-2xl ri-add-circle-line"></i>
        </button>
    </div>
    <hr class="border-t-2 border-gray-200">
    <div class="px-5 py-8 capitalize">
        <div class="relative overflow-x-auto shadow-md sm:rounded-t-xl">
            <table class="w-full text-sm text-center text-black bg-blue-100 rounded-b-lg rtl:text-right">
                <thead class="text-xs uppercase bg-[#242947] py-14 border-[1px] border-[#242947] text-white">
                    <tr>
                        <th scope="col" class="p-3 border-[#242947] border-[1px] border-t-0">
                            No
                        </th>
                        <th scope="col" class="px-2 py-3 border-[#242947] border-[1px] border-t-0">
                            Nama
                        </th>
                        <th scope="col" class="px-4 py-3 border-[#242947] border-[1px] border-t-0">
                            Jam Mulai Kerja
                        </th>
                        <th scope="col" class="px-4 py-3 border-[#242947] border-[1px] border-t-0">
                            Jam Istirahat
                        </th>
                        <th scope="col" class="px-4 py-3 border-[#242947] border-[1px] border-t-0">
                            Jam Selesai Istirahat
                        </th>
                        <th scope="col" class="px-2 py-3 border-[#242947] border-[1px] border-t-0">
                            Jam Pulang
                        </th>
                        <th scope="col" class="px-2 py-3 border-[#242947] border-[1px] border-t-0">
                            Total Jam Kerja
                        </th>
                        <th class="px-2 py-3 ">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $shift)
                    <tr class="border-[#242947] border-[1px] border-t-0 ">
                        <td class="p-3 border-[#242947] border-[1px]">
                            {{ $loop->iteration }}
                        </td>
                        <td class="p-2 border-[#242947] border-[1px] border-t-0">
                            {{ $shift->nama }}
                        </td>
                        <td class="p-2 border-[#242947] border-[1px] border-t-0">
                            {{ $shift->jam_mulai ?? '--\\\--' }}
                        </td>
                        <td class="p-2 border-[#242947] border-[1px] border-t-0">
                            {{ $shift->jam_istirahat ?? '--\\\--' }}
                        </td>
                        <td class="p-2 border-[#242947] border-[1px] border-t-0">
                            {{ $shift->jam_selesai_istirahat ?? '--\\\--' }}
                        </td>
                        <td class="p-2 border-[#242947] border-[1px] border-t-0">
                            {{ $shift->jam_pulang ?? '--\\\--' }}
                        </td>
                        <td class="p-2 border-[#242947] border-[1px] border-t-0">
                            {{ $shift->jam_total_produktif ?? '--\\\--' }}
                        </td>
                        <td class="px-3 py-2">
                            <button data-modal-target="editshift{{ $shift->id }}"
                                data-modal-toggle="editshift{{ $shift->id }}" class="px-2 py-1 mr-3 text-base font-medium text-center text-white bg-yellow-400 rounded-lg hover:bg-yellow-300 hover:text-gray-800">
                                <i class="ri-edit-2-line"></i>
                            <button data-modal-target="deleteshift{{ $shift->id }}"
                                data-modal-toggle="deleteshift{{ $shift->id }}" class="px-2 py-1 text-base font-medium text-center text-white bg-red-500 rounded-lg hover:bg-red-400 hover:text-gray-800">
                                <i class="ri-delete-bin-6-line"></i>
                        </td>
                    </tr>
                        <x-admin.popup-tambah-data title="Edit Shift" :action="route('dashboard.pengaturan.editshift',$shift->id)" id="editshift{{ $shift->id }}" :data="$shift" method="PUT"/>
                        <x-admin.popup-tambah-data title="delete" :action="route('dashboard.pengaturan.deleteshift',$shift->id)" id="deleteshift{{ $shift->id }}" :data="$shift" />
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <x-admin.popup-tambah-data title="Tambah Shift" :action="route('dashboard.pengaturan.tambahshift')" id="tambahshift" />
</x-layout.layout-admin>
