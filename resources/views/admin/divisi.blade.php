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
                        @if ($divisi->icon)
                            <div class="px-3 py-3 text-2xl bg-gray-300 rounded-full">
                                <img class="object-cover w-8"
                                    src="{{ asset('storage/divisi/' . basename($divisi->icon)) }}" alt="icon divisi">
                            </div>
                        @else
                            <div class="px-4 py-3 text-2xl bg-gray-300 rounded-full">
                                <i class="{{ $divisi->icon ?? 'ri-heart-add-2-line' }} font-semibold"></i>
                            </div>
                        @endif
                        <div class="flex flex-col capitalize">
                            <h1>{{ $divisi->divisi }}</h1>
                            <div class="text-sm font-semibold text-blue-600">{{ $divisi->karyawan->count() }} Anggota
                            </div>
                        </div>
                    </a>
                @endforeach
            @endforeach
            <button data-modal-target="TambahDivisi" data-modal-toggle="TambahDivisi"
                class="flex items-center gap-3 text-lg font-bold hover:text-blue-700">
                <div class="px-4 py-3 text-2xl bg-gray-300 rounded-full">
                    <i class="font-semibold ri-add-circle-line"></i>
                </div>
                <div class="flex flex-col">
                    <h1>Tambah Divisi</h1>
                </div>
            </button>
            <x-admin.popup-divisi title="Tambah Divisi" id="TambahDivisi" :action="route('dashboard.divisi.Tambah')" />
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
    </div>
</x-layout.layout-admin>
