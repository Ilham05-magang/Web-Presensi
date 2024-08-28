<x-layout.layout-admin>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="flex items-center justify-between w-full px-10 py-8 text-2xl">
        <h1>{{ $title2 }}</h1>
        <x-admin.searchbutton :action="route('dashboard.searchkaryawan')" />
    </div>
    <hr class="border-t-2 border-gray-200">
    <div class="p-5 capitalize">
        <div class="relative overflow-x-auto ">
            <table class="w-full text-sm text-center text-black border-[1px]  border-[#242947]  bg-gray-100 rtl:text-right rounded-b-lg">
                <thead class="text-xs uppercase bg-gray-100 border-[1px] border-t-0  border-[#242947] ">
                    <tr>
                        <th scope="col" class="p-1 border-[#242947] border-[1px]">
                            No
                        </th>
                        <th scope="col" class="px-2 py-1 border-[#242947] border-[1px]">
                            Nama
                        </th>
                        <th scope="col" class="px-2 py-1 border-[#242947] border-[1px]">
                            Divisi
                        </th>
                        <th scope="col" class="px-2 py-1 border-[#242947] border-[1px]">
                            Kantor
                        </th>
                        <th scope="col" class="px-2 py-1 border-[#242947] border-[1px]">
                            Shift
                        </th>
                        <th scope="col" class="px-2 py-1 border-[#242947] border-[1px] ">
                            Status Akun
                        </th>
                        <th scope="col" class="px-2 py-1 border-[#242947] border-[1px] ">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datakaryawan as $data)
                    <tr class="border-[#242947] border-[1px] border-t-0">
                        <td class="p-1 border-[#242947] border-[1px]">
                            {{ $loop->iteration }}
                        </td>
                        <td class="px-3 py-1 border-[#242947] border-[1px]">
                            {{ $data->nama }}
                        </td>
                        <td class="px-3 py-1 border-[#242947] border-[1px] text-left">
                            {{ $data->divisi->divisi ?? '--//--' }}
                        </td>
                        <td class="px-3 py-1 border-[#242947] border-[1px]">
                            {{ $data->kantor->nama ?? '--//--' }}
                        </td>
                        <td class="px-3 py-1 border-[#242947] border-[1px]">
                            {{ $data->shift->nama?? '--//--' }}
                        </td>
                        <td class="px-3 py-1 border-[#242947] border-[1px] ">
                            @if ($data->akun->status_akun == 1)
                            Akun Aktif
                            @else
                            Akun Belum Aktif
                            @endif
                        </td>
                        <td class="py-2 text-center">
                            <a href="{{ route('dashboard.karyawan.show', $data->id) }}"
                                class="px-2 py-2 pl-3 text-sm font-medium text-center text-white bg-yellow-400 rounded-lg hover:bg-yellow-300 hover:text-gray-800">
                                Detail
                            </a>
                            <button data-modal-target="delete{{ $data->id }}" data-modal-toggle="delete{{ $data->id }}"
                                class="px-2 py-1 ml-4 text-base font-medium text-center text-white bg-red-500 rounded-lg hover:bg-red-400 hover:text-gray-800">
                                <i class="ri-delete-bin-6-line"></i>
                            </button>
                        </td>
                    </tr>
                    <x-admin.popup-admin title="delete" :action="route('dashboard.deletekaryawan',$data->id)"
                        :id="'delete' . $data->id" :data="$data->nama" />
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
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
