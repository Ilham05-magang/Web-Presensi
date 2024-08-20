<x-layout.layout-admin>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="flex items-center justify-between w-full px-10 py-8 text-2xl">
        <h1>{{ $title2 }}</h1>
        <x-admin.searchbutton action="" />
    </div>
    <hr class="border-t-2 border-gray-200">
    <div class="p-8"></div>
</x-layout.layout-admin>
