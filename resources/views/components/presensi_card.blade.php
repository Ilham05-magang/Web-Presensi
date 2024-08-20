@props(['title', 'presensi' => '---', 'late'])
<div class="flex flex-auto bg-gray-200 p-3 gap-1 rounded-xl">
    <div class="bg-gray-400 h-3 w-3 rounded-full max-md:h- "></div>
    <div class="flex flex-col">
        <div class="font-bold text-xs pb-2">{{ $title }}</div>
        <div class=" font-semibold">
            {{ $presensi }}
        </div>
        <div class="text-[10px] font-semibold text-red-500 pb-2">{{ $late ?? '' }}</div>
    </div>
</div>
