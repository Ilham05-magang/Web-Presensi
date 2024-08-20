@props(['route', 'title', 'icon'])

<li>
    <a href="{{ route($route) }}"
        class="flex items-center p-2 text-gray-700 rounded-lg dark:text-white hover:bg-[#242947] hover:text-white {{ request()->routeIs($route) ? 'bg-[#242947] text-white' : '' }} ">
        <i class="flex-shrink-0 text-2xl font-medium transition duration-75 {{ $icon }} "></i>
        <span class="ms-3 hover:text-white">{{ $title }}</span>
    </a>
</li>
