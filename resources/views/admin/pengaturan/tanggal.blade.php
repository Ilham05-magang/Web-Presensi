<x-layout.layout-admin>
    <x-slot:title>{{ $title }}</x-slot:title>
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Sukses',
                text: '{{ session('success') }}',
            });
        </script>
    @endif
    @if ($errors->any())
        <div class="bg-gray-100 p-5 text-center text-red-600 rounded-md">
            <ul>
                @foreach ($errors->all() as $error)
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: '{{ $error }}',
                        });
                    </script>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="flex items-center justify-between w-full px-10 py-8 text-2xl">
        <h1>{{ $title }}</h1>
        <button data-modal-target="tambahtanggal" data-modal-toggle="tambahtanggal"
            class="text-white hover:bg-[#5B6390] border-2 border-[#242947] bg-[#242947] px-2 rounded-lg py-1.5 text-center text-xl font-medium mr-3">
            <i class="items-center ri-add-circle-line"><span class="px-2 text-center">Tambah Tanggal Libur</span></i>
        </button>
    </div>
    <hr class="border-t-2 border-gray-200">
    @if ($errors->any())
        <div class="bg-gray-100 p-5 text-center text-red-600 rounded-md">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="px-5 py-8">
        <table
            class="w-full text-sm text-center text-black border-[1px]  border-[#242947]  bg-gray-100 rtl:text-right rounded-b-lg">
            <thead class="text-xs uppercase bg-gray-100 border-[1px] border-t-0  border-[#242947] ">
                <tr>
                    <th scope="col" class="p-3 border-[#242947] border-[1px] border-t-0">
                        No
                    </th>
                    <th scope="col" class="px-2 py-3 border-[#242947] border-[1px] border-t-0">
                        Tanggal
                    </th>
                    <th class="px-2 py-3 ">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $tanggal)
                    <tr class="border-[#242947] border-[1px] border-t-0 ">
                        <td class="p-3 border-[#242947] border-[1px]">
                            {{ $loop->iteration }}
                        </td>
                        <td class="p-2 border-[#242947] border-[1px] border-t-0">
                            @php
                                $date = \Carbon\Carbon::parse($tanggal->tanggal_libur)->translatedFormat('d-F-Y');
                            @endphp
                            {{ $date }}
                        </td>
                        <td class="p-2 border-[#242947] border-[1px] border-t-0">
                            <button data-modal-target="edittanggal{{ $tanggal->id }}"
                                data-modal-toggle="edittanggal{{ $tanggal->id }}"
                                class="text-white hover:bg-yellow-300 hover:text-gray-800 bg-yellow-400 px-2.5 rounded-lg py-1 text-center text-xl font-medium mr-3">
                                <i class="ri-edit-2-line"></i>
                                <button data-modal-target="deletetanggal{{ $tanggal->id }}"
                                    data-modal-toggle="deletetanggal{{ $tanggal->id }}"
                                    class="text-white hover:bg-red-400 hover:text-gray-800 bg-red-500 px-2 rounded-lg py-1.5 text-center text-xl font-medium">
                                    <i class="ri-delete-bin-6-line"></i>
                        </td>

                    </tr>
                    <x-admin.popup-tambah-data title="Edit Tanggal" :action="route('dashboard.pengaturan.edittanggal', $tanggal->id)"
                        id="edittanggal{{ $tanggal->id }}" :data="$tanggal" method="PUT" />
                    <x-admin.popup-tambah-data title="deleteTanggal" :action="route('dashboard.pengaturan.deletetanggal', $tanggal->id)"
                        id="deletetanggal{{ $tanggal->id }}" :data="$tanggal" />
                @endforeach
            </tbody>
        </table>
    </div>
    <x-admin.popup-tambah-data title="Tambah Tanggal" methdod="POST" :action="route('dashboard.pengaturan.tambahtanggal')" id="tambahtanggal" />
</x-layout.layout-admin>
