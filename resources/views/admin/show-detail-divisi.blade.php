<x-layout.layout-admin>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="flex items-center justify-between w-full px-10 py-8 text-2xl capitalize">
        <div class="flex items-center gap-3 text-lg font-bold capitalize">
            <a href="{{ route('dashboard.divisi') }}"><i class="py-1 pr-3 text-2xl hover:text-blue-600 ri-arrow-left-line"></i></a>
            <div class="px-3 py-2 text-2xl bg-gray-300 rounded-full">
                <i class="{{ $dataPerDivisi->icon ?? 'ri-heart-add-2-line' }} font-semibold"></i>
            </div>
            <div class="flex flex-col text-3xl">
                <h1>Divisi {{ $dataPerDivisi->divisi }}</h1>
            </div>
        </div>
    </div>
    <hr class="border-t-2 border-gray-200">
    <div class="capitalize">
        <div class="relative p-5 overflow-x-auto">
            <table class="w-full text-sm text-left text-black border-[1px]  border-[#242947]  bg-gray-100 rtl:text-right rounded-b-lg">
                <thead class="text-xs uppercase text-center bg-gray-100 border-[1px] border-t-0  border-[#242947] ">
                    <tr>
                        <th scope="col" class="p-3 border-[#242947]  border-[1px] border-t-0">
                            No
                        </th>
                        <th scope="col" class="px-4 py-3 border-[#242947] border-[1px] border-t-0">
                            Nama
                        </th>
                        <th scope="col" class="px-4 py-3 border-[#242947] border-[1px] border-t-0">
                            NIP
                        </th>
                        <th scope="col" class="px-4 py-3 border-[#242947] border-[1px] border-t-0">
                            Telepon
                        </th>
                        <th scope="col" class="px-4 py-3 border-[#242947] border-[1px] border-t-0">
                            Tempat, Tanggal Lahir
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataPerDivisi->karyawan as $data)
                    <tr class="border-[#242947] border-[1px] border-t-0 ">
                        <td class="p-3 border-[#242947] border-[1px] border-t-0 text-center">
                            {{ $loop->iteration }}
                        </td>
                        <td class="px-4 py-3 border-[#242947] border-[1px] border-t-0">
                            {{ $data->nama }}
                        </td>
                        <td class="px-4 py-3 border-[#242947] border-[1px] border-t-0">
                            {{ $data->nip ?? '--//--' }}
                        </td>
                        <td class="px-4 py-3 border-[#242947] border-[1px] border-t-0">
                            {{ $data->telepon ?? '--//--' }}
                        </td>
                        <td class="px-4 py-3 border-[#242947] border-[1px] border-t-0">
                            {{ $data->tempat_lahir . ', ' . ($data->tanggal_lahir ?? '--//--') }}
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</x-layout.layout-admin>
