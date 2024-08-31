<x-layout.layout-admin>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="flex items-center justify-between w-full px-10 py-8 text-2xl">
        <h1>{{ $title }}</h1>
        <x-admin.searchbutton action="" />
    </div>
    <hr class="border-t-2 border-gray-200">
    <div class="p-8"></div>

    @foreach ($karyawan as $karyawan)
    @foreach ($karyawan->gajiKaryawan as $gaji)
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Periode</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"><input type="text" disabled value="{{ $gaji->periode }}"></th>
            </tr>
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"><input type="text" disabled value="{{ $karyawan->nama }}"></th>
            </tr>
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Method</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"><input type="text" value="{{ $gaji->method ?? 'Transfer' }}"></th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            <tr>
                <td class="px-2 py-4 whitespace-nowrap">Total Shift <input type="text" disabled value="{{ $gaji->periode }}"></td>
                <td class="px-6 py-4 whitespace-nowrap"><input type="text" value="{{ $gaji->hadir_total }}"></td>
            </tr>
            <tr>
                <td class="px-6 py-4 whitespace-nowrap">terlambat</td>
                <td class="px-6 py-4 whitespace-nowrap"><input type="text" value="{{ $gaji->terlambat }}"></td>
            </tr>
            @endforeach
            @endforeach
        </tbody>
    </table>
</x-layout.layout-admin>

