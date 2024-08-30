<x-layout.layout-admin>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="flex items-center justify-between w-full px-10 py-8 text-2xl">
        <h1>{{ $title }}</h1>
        <button data-modal-target="tambahquote" data-modal-toggle="tambahquote"
            class="text-white hover:bg-[#5B6390] border-2 border-[#242947] font-bold bg-[#242947] px-2 rounded-lg py-1 text-center text-xl font-medium">
            <i class="text-2xl ri-add-circle-line"></i>
        </button>
    </div>
    <hr class="border-t-2 border-gray-200">
    <div class="px-5 py-8">
        <div class="relative overflow-x-auto shadow-md sm:rounded-t-xl">
            <table class="w-full text-sm text-center text-black bg-blue-100 rounded-b-lg rtl:text-right">
                <thead class="text-xs uppercase bg-[#242947] py-14 border-[1px] border-[#242947] text-white">
                    <tr>
                        <th scope="col" class="p-3 border-[#242947] border-[1px] border-t-0">
                            No
                        </th>
                        <th scope="col" class="px-2 py-3 border-[#242947] border-[1px] border-t-0">
                            Quote
                        </th>
                        <th class="px-2 py-3 ">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $quote)
                        <tr class="border-[#242947] border-[1px] border-t-0 ">
                            <td class="p-3 border-[#242947] border-[1px]">
                                {{ $loop->iteration }}
                            </td>
                            <td class="p-2 border-[#242947] border-[1px] border-t-0">
                                {{ $quote->quote }}
                            </td>
                            <td class="p-2 border-[#242947] border-[1px] border-t-0">
                                <button data-modal-target="editquote{{ $quote->id }}"
                                    data-modal-toggle="editquote{{ $quote->id }}"
                                    class="px-2 py-1 mr-3 text-base font-medium text-center text-white bg-yellow-400 rounded-lg hover:bg-yellow-300 hover:text-gray-800">
                                    <i class="ri-edit-2-line"></i>
                                    <button data-modal-target="deletequotes{{ $quote->id }}"
                                        data-modal-toggle="deletequotes{{ $quote->id }}"
                                        class="px-2 py-1 text-base font-medium text-center text-white bg-red-500 rounded-lg hover:bg-red-400 hover:text-gray-800">
                                        <i class="ri-delete-bin-6-line"></i>
                            </td>

                        </tr>
                        <x-admin.popup-tambah-data title="Edit Quotes" :action="route('dashboard.pengaturan.editquote', $quote->id)"
                            id="editquote{{ $quote->id }}" :data="$quote" method="PUT" />
                        <x-admin.popup-tambah-data title="deletequotes" :action="route('dashboard.pengaturan.deletequote', $quote->id)"
                            id="deletequotes{{ $quote->id }}" :data="$quote" />
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <x-admin.popup-tambah-data title="Tambah Quotes" methdod="POST" :action="route('dashboard.pengaturan.tambahquote')" id="tambahquote" />
</x-layout.layout-admin>
