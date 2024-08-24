<x-layout.layout-admin>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="flex items-center justify-between w-full px-10 py-8 text-2xl">
        <h1>{{ $title2 }}</h1>
        <x-admin.searchbutton :action="route('dashboard.searchkaryawan')" />
    </div>
    <hr class="border-t-2 border-gray-200">
    <div class="p-5">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-center text-white bg-gray-400 rtl:text-right">
                <thead class="text-xs uppercase bg-gray-700">
                    <tr>
                        <th scope="col" class="p-3">
                            No
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nama
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Divisi
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Kantor
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Shift
                        </th>
                        <th scope="col" class="px-6 py-3 ">
                            Status Akun
                        </th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datakaryawan as $data)
                    <tr class="bg-[#242947] border-b border-gray-700">
                        <td class="p-3">
                            {{ $loop->iteration }}
                        </td>
                        <td class="px-5 py-3">
                            {{ $data->nama }}
                        </td>
                        <td class="px-5 py-3">
                            {{ $data->divisi->divisi ?? '--//--' }}
                        </td>
                        <td class="px-5 py-3">
                            {{ $data->kantor->nama ?? '--//--' }}
                        </td>
                        <td class="px-5 py-3">
                            {{ $data->shift->nama?? '--//--' }}
                        </td>
                        <td class="px-5 py-3 ">
                            @if ($data->akun->status_akun == 1)
                            Akun Aktif
                            @else
                            Akun Belum Aktif
                            @endif
                        </td>
                        <td class="py-3">
                            <button data-modal-target="editkaryawan{{ $data->id }}"
                                data-modal-toggle="editkaryawan{{ $data->id }}"
                                class="text-white hover:bg-yellow-300 hover:text-gray-800 bg-yellow-400 px-2 rounded-lg py-1.5 text-center text-xl font-medium mr-3">
                                <i class="ri-edit-2-line"></i>
                            </button>
                            <button data-modal-target="delete{{ $data->id }}" data-modal-toggle="delete{{ $data->id }}"
                                class="text-white hover:bg-red-400 hover:text-gray-800 bg-red-500 px-2 rounded-lg py-1.5 text-center text-xl font-medium">
                                <i class="ri-delete-bin-6-line"></i>
                            </button>
                        </td>
                    </tr>
                    <x-admin.popup-admin title="Edit Data Karyawan" :action="route('dashboard.editkaryawan', $data->id)"
                        :id="'editkaryawan' . $data->id" :data="$data" :datadivisi="$datadivisi" :datakantor="$datakantor" :datashift="$datashift" />
                    <x-admin.popup-admin title="delete" :action="route('dashboard.deletekaryawan',$data->id)"
                        :id="'delete' . $data->id" :data="$data->nama" />
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</x-layout.layout-admin>
