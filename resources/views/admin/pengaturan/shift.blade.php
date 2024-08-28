<x-layout.layout-admin>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="flex items-center justify-between w-full px-10 py-8 text-2xl">
        <h1>{{ $title }}</h1>
        <button data-modal-target="tambahshift"
            data-modal-toggle="tambahshift"
            class="text-white hover:bg-[#5B6390] border-2 border-[#242947] font-bold bg-[#242947] px-2 rounded-lg py-1.5 text-center text-xl font-medium mr-3">
            <i class="items-center ri-add-circle-line"><span class="px-2 text-center">Tambah Shift</span></i>
        </button>
    </div>
    <hr class="border-t-2 border-gray-200">
    <div class="px-5 py-8 capitalize">
        <table class="w-full text-sm text-left text-center text-black border-[1px]  border-[#242947]  bg-gray-100 rtl:text-right rounded-b-lg">
            <thead class="text-xs uppercase bg-gray-100 border-[1px] border-t-0  border-[#242947] ">
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
                            data-modal-toggle="editshift{{ $shift->id }}" class="text-white hover:bg-yellow-300 hover:text-gray-800 bg-yellow-400 px-2.5 rounded-lg py-1 text-center text-xl font-medium mr-3">
                            <i class="ri-edit-2-line"></i>
                        <button data-modal-target="deleteshift{{ $shift->id }}"
                            data-modal-toggle="deleteshift{{ $shift->id }}" class="text-white hover:bg-red-400 hover:text-gray-800 bg-red-500 px-2 rounded-lg py-1.5 text-center text-xl font-medium">
                            <i class="ri-delete-bin-6-line"></i>
                    </td>
                </tr>
                    <x-admin.popup-tambah-data title="Edit Shift" :action="route('dashboard.pengaturan.editshift',$shift->id)" id="editshift{{ $shift->id }}" :data="$shift" method="PUT"/>
                    <x-admin.popup-tambah-data title="delete" :action="route('dashboard.pengaturan.deleteshift',$shift->id)" id="deleteshift{{ $shift->id }}" :data="$shift" />
                @endforeach
            </tbody>
        </table>
    </div>
    <x-admin.popup-tambah-data title="Tambah Shift" :action="route('dashboard.pengaturan.tambahshift')" id="tambahshift" />
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '{{ session('success') }}',
            });
        </script>
    @endif
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: '{{ $error }}',
                });
            </script>
        @endforeach
    @endif
</x-layout.layout-admin>
