<x-layout.layout-admin>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="flex items-center justify-between w-full px-10 py-8 text-2xl">
        <h1>{{ $title2 }}</h1>
        <x-admin.searchbutton :action="route('dashboard.divisi.Search')" />
    </div>
    <hr class="border-t-2 border-gray-200">
    <div class="p-8">
        <div class="grid grid-cols-4 gap-10">
            @foreach ($dataPerDivisi as $divisiCollection)
                @foreach ($divisiCollection as $divisi)
                    <a href="{{ route('dashboard.divisi.show', $divisi->id) }}"
                        class="flex items-center gap-3 text-lg font-bold hover:text-blue-600">
                        <div class="px-3 py-3 text-2xl border-2 border-[#242947] rounded-full">
                            <img class="object-cover w-8"
                                src="https://api.dicebear.com/9.x/identicon/svg?seed={{ $divisi->divisi }}"
                                alt="icon divisi">
                        </div>
                        <div class="flex flex-col capitalize">
                            <h1>{{ $divisi->divisi }}</h1>
                            <div class="text-sm font-semibold text-blue-600">{{ $divisi->karyawan->count() }} Anggota
                            </div>
                        </div>
                    </a>
                @endforeach
            @endforeach
            <button data-modal-target="TambahDivisi" data-modal-toggle="TambahDivisi"
                class="text-white w-12 h-12 my-auto hover:bg-[#5B6390] border-2 border-[#242947] font-bold bg-[#242947] px-2 rounded-lg py-1 text-center text-xl font-medium">
                <i class="text-2xl ri-add-circle-line"></i>
            </button>
            <x-admin.popup-divisi title="Tambah Divisi" id="TambahDivisi" :action="route('dashboard.divisi.Tambah')" />
        </div>
    </div>
</x-layout.layout-admin>
