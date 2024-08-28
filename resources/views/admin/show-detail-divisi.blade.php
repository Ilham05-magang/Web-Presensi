<x-layout.layout-admin>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="flex items-center justify-between w-full py-10 text-2xl capitalize px-7">
        <div class="flex items-center justify-between w-full gap-3 text-lg font-bold capitalize">
            <div class="flex items-center gap-3">
                <a href="{{ route('dashboard.divisi') }}"><i class="py-1 pr-3 text-2xl hover:text-blue-600 ri-arrow-left-line"></i></a>
                <div class="px-3 py-2 text-2xl bg-gray-300 rounded-full">
                    <i class="{{ $dataPerDivisi->icon ?? 'ri-heart-add-2-line' }} font-semibold"></i>
                </div>
                <div class="flex flex-col text-3xl">
                    <h1>Divisi {{ $dataPerDivisi->divisi }}</h1>
                </div>
            </div>
            <button data-modal-target="delete{{ $dataPerDivisi->id }}" data-modal-toggle="delete{{ $dataPerDivisi->id }}"
                class="px-2.5 py-1.5 ml-4 text-2xl font-medium text-center text-white bg-red-500 rounded-lg hover:bg-red-400 hover:text-gray-800">
                <i class="ri-delete-bin-6-line"></i>
            </button>
            <x-admin.popup-divisi title="delete" id="delete{{ $dataPerDivisi->id }}" :action="route('dashboard.divisi.Delete',$dataPerDivisi->id)" :data="$dataPerDivisi"/>
        </div>
    </div>
    <hr class="border-t-2 border-gray-200">
    <div class="p-5 capitalize">
        <div class="relative overflow-x-auto shadow-md sm:rounded-t-xl">
            <table class="w-full text-sm text-center text-black bg-blue-100 rounded-b-lg rtl:text-right">
                <thead class="text-xs uppercase bg-[#242947] py-14 border-[1px] border-[#242947] text-white">
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
                            Tempat,Tanggal Lahir
                        </th>
                        <th scope="col" class="px-4 py-3 border-[#242947] border-[1px] border-t-0">
                            Kantor
                        </th>
                        <th scope="col" class="px-4 py-3 border-[#242947] border-[1px] border-t-0">
                            Shift
                        </th>
                        <th scope="col" class="px-2 py-5">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataPerDivisi->karyawan as $data)
                    @php
                        $tanggalLahir = carbon\Carbon::parse($data->tanggal_lahir)->locale('id')->translatedFormat('d-F-Y');
                    @endphp
                    <tr class="border-[#242947] border-[1px] border-t-0 ">
                        <td class="p-3 border-[#242947] border-[1px] border-t-0 text-center">
                            {{ $loop->iteration }}
                        </td>
                        <td class="px-2 py-4 border-[#242947] border-[1px] border-t-0">
                            {{ $data->nama }}
                        </td>
                        <td class="px-2 py-4 border-[#242947] border-[1px] border-t-0">
                            {{ $data->nip ?? '--//--' }}
                        </td>
                        <td class="px-2 py-4 border-[#242947] border-[1px] border-t-0">
                            {{ $data->telepon ?? '--//--' }}
                        </td>
                        <td class="px-2 py-4 border-[#242947] border-[1px] border-t-0">
                            {{ $data->tempat_lahir. ', '. $tanggalLahir ?? '--//--' }}
                        </td>
                        <td class="px-2 py-4 border-[#242947] border-[1px] border-t-0">
                            {{ $data->kantor->nama ?? '--//--' }}
                        </td>
                        <td class="px-2 py-4 border-[#242947] border-[1px] border-t-0">
                            {{ $data->shift->nama ?? '--//--' }}
                        </td>
                        <td class="px-2 py-4 border-[#242947] border-[1px] border-t-0">
                            <a href="{{ route('dashboard.karyawan.show', $data->id) }}"
                                class="px-2 py-2 text-sm font-medium text-center text-white bg-yellow-400 rounded-lg hover:bg-yellow-300 hover:text-gray-800">
                                Detail
                            </a>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
            @if($dataPerDivisi->karyawan->count()<1)
                <div class="w-full py-10 text-base font-semibold text-center">Data Kosong</div>
            @endif
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
