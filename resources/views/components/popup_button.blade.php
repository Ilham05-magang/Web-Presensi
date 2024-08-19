@props(['title', 'description' => null])
<div id="popup-modal" tabindex="-1"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-sm max-h-full">
        <div class="relative bg-white rounded-lg p-4 shadow dark:bg-gray-700">
            <div class=" text-center">
                <div class="text-xl font-bold">{{ $title }}</div>
                <h3 class="mb-5 text-base py-4 font-medium dark:text-gray-400">{{ $description }}</h3>
                <div class=" flex justify-between mx-5 items-center">
                    <button data-modal-hide="popup-modal" type="button"
                        class="py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-[#D9D9D9] rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Tidak</button>
                    <button data-modal-hide="popup-modal" type="button"
                        class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                        Ya
                    </button>
                </div>

            </div>
        </div>
    </div>
</div>
