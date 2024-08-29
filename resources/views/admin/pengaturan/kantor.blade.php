<x-layout.layout-admin>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="flex items-center justify-between w-full px-10 py-8 text-2xl">
        <h1>{{ $title }}</h1>
        <button data-modal-target="tambahkantor"
            data-modal-toggle="tambahkantor"
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
                            Link Gmaps
                        </th>
                        <th class="px-2 py-3 ">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $kantor)
                        <tr>
                            <td class="p-3 border-[#242947] border-[1px]">
                                {{ $loop->iteration }}
                            </td>
                            <td class="p-2 border-[#242947] border-[1px] border-t-0">
                                {{ $kantor->nama }}
                            </td>
                            <td class="p-3 border-[#242947] border-[1px] border-t-0 normal-case">
                                <a href="{{ $kantor->link_gmaps}}" target="_blank" rel="noopener noreferrer" class="text-blue-500 hover:underline">{{ $kantor->link_gmaps ?? '--\\\--' }}</a>
                            </td>
                            <td class="px-3 py-2 border-[#242947] border-[1px] ">
                                <button data-modal-target="editkantor{{ $kantor->id }}"
                                data-modal-toggle="editkantor{{ $kantor->id }}" class="px-2 py-1 mr-3 text-base font-medium text-center text-white bg-yellow-400 rounded-lg hover:bg-yellow-300 hover:text-gray-800">
                                <i class="ri-edit-2-line"></i>
                                <button data-modal-target="deletekantor{{ $kantor->id }}"
                                    data-modal-toggle="deletekantor{{ $kantor->id }}" class="px-2 py-1 text-base font-medium text-center text-white bg-red-500 rounded-lg hover:bg-red-400 hover:text-gray-800">
                                    <i class="ri-delete-bin-6-line"></i>
                            </td>
                        </tr>
                        <x-admin.popup-tambah-data title="Edit Kantor" :action="route('dashboard.pengaturan.editkantor',$kantor->id)" id="editkantor{{ $kantor->id }}" :data="$kantor" method="PUT" />
                        <x-admin.popup-tambah-data title="delete" :action="route('dashboard.pengaturan.deletekantor',$kantor->id)" id="deletekantor{{ $kantor->id }}" :data="$kantor" />
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <x-admin.popup-tambah-data title="Tambah Kantor" :action="route('dashboard.pengaturan.tambahkantor')" id="tambahkantor" />
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
