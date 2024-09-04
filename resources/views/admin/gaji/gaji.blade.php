<x-layout.layout-admin>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="flex items-center justify-between w-full px-10 py-8 text-2xl">
        <h1>{{ $title2 }}</h1>
        <x-admin.searchbutton :action="route('dashboard.searchkaryawan')" />
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
                            NIP
                        </th>
                        <th scope="col" class="px-2 py-5">
                            Nama
                        </th>
                        <th scope="col" class="px-2 py-5">
                            Default Gaji
                        </th>
                        <th scope="col" class="px-2 py-5">
                            Input Gaji
                        </th>
                        <th scope="col" class="px-2 py-5">
                            Riwayat Gaji
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($karyawan as $data)
                        <tr class="border-[#242947] border-[1px]">
                            <td class="p-1 border-[#242947] border-[1px]">
                                {{ $loop->iteration }}
                            </td>
                            <td class="p-1 border-[#242947] border-[1px]">
                                {{ $data->nama }}
                            </td>
                            <td class="p-1 border-[#242947] border-[1px]">
                                {{ $data->nip }}
                            </td>
                            <td class="p-1 border-[#242947] border-[1px]">
                                <a href="{{route('dashboard.gaji.default')}}"
                                    class="px-2 py-2 pl-3 text-sm font-medium text-center text-white bg-yellow-400 rounded-lg hover:bg-yellow-300 hover:text-gray-800">
                                    Detail
                                </a>
                            </td>
                            <td class="p-4 border-[#242947] border-[1px]">
                                <a href="{{route('dashboard.gaji.input',$data->id)}}"
                                    class="px-2 py-2 pl-3 text-sm font-medium text-center text-white bg-yellow-400 rounded-lg hover:bg-yellow-300 hover:text-gray-800">
                                    Detail
                                </a>
                            </td>
                            <td class="p-4 border-[#242947] border-[1px]">
                                <a href="{{route('dashboard.gaji.riwayat')}}"
                                    class="px-2 py-2 pl-3 text-sm font-medium text-center text-white bg-yellow-400 rounded-lg hover:bg-yellow-300 hover:text-gray-800">
                                    Detail
                                </a>
                            </td>

                        </tr>
                    @endforeach
                    {{-- <x-admin.popup-admin title="delete" :action="route('dashboard.deletekaryawan',$data->id)"
                        :id="'delete' . $data->id" :data="$data->nama" /> --}}

                </tbody>
            </table>
        </div>
    </div>
</x-layout.layout-admin>
