@props(['action' => null])
<form action="{{ $action }}" method="POST">
    @csrf
    <div class="flex md:w-96 w-72">
        <div class="relative w-full">
            <input type="search" id="location-search"
                class="block w-full py-2 pl-3 pr-10 text-gray-900 border border-gray-300 rounded-lg appearance-none decoration-none no-cancel-button bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                placeholder="Search..." required />
            <button type="submit"
                class="absolute top-0 right-0 h-full p-2.5 text-sm font-semibold text-white bg-[#242947] rounded-r-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                </svg>
                <span class="sr-only">Search</span>
            </button>
        </div>
    </div>
</form>
