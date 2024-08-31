@props(['dataadmin'])
<nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
    <div class="px-3 py-3 lg:px-5 lg:pl-3">
        <div class="flex items-center justify-between">
            <div class="flex items-center justify-start rtl:justify-end">
                <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar"
                    type="button"
                    class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                    <span class="sr-only">Open sidebar</span>
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path clip-rule="evenodd" fill-rule="evenodd"
                            d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                        </path>
                    </svg>
                </button>
                <div class="flex ms-2 md:me-24">
                    <img src="/assets/logo-black.svg" class="h-9 me-3" alt="Seven inc Logo" />
                    <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white">Seven
                        Inc</span>
                </div>
            </div>
            <div class="flex">
                <div class="flex items-center ms-3">
                    <div>
                        <button type="button" class="flex text-sm " aria-expanded="false"
                            data-dropdown-toggle="dropdown-user" id="dropdown">
                            <span class="sr-only">Open user menu</span>
                            <div class="flex gap-2 text-base">
                                <h1>{{ $dataadmin->admin->nama }}</h1>
                                <i id="dropdown-icon" class="ri-arrow-drop-down-line"></i>
                            </div>
                        </button>
                    </div>
                    <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600"
                        id="dropdown-user">
                        <div class="px-4 py-3" role="none">
                            <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300" role="none">
                                {{ $dataadmin->username }}
                            </p>
                            <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300" role="none">
                                {{ $dataadmin->email }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
    aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
        <ul class="font-medium text-base">
            <div class="flex flex-col gap-2">
                <x-admin.li-navbar route="dashboard" title="Dashboard" icon="ri-pie-chart-2-fill" />
                <x-admin.li-navbar route="dashboard.presensi" title="Presensi" icon="ri-database-2-fill" />
                <x-admin.li-navbar route="dashboard.divisi" title="Divisi" icon="ri-group-2-fill" />
                <x-admin.li-navbar route="dashboard.gaji" title="Gaji" icon="ri-folder-chart-fill" />
                <x-admin.li-navbar route="dashboard.karyawan" title="Karyawan" icon="ri-team-fill" />
                <button id="dropdownPengaturanButton" data-dropdown-toggle="dropdownPengaturan"
                    class="flex items-center p-2 text-gray-700 rounded-lg dark:text-white hover:bg-[#242947] hover:text-white {{ request()->routeIs('dashboard.pengaturan.profile') || request()->routeIs('dashboard.pengaturan.kantor') || request()->routeIs('dashboard.pengaturan.shift') ? 'bg-[#242947] text-white' : '' }}">
                    <i class="flex-shrink-0 text-2xl font-medium transition duration-75 ri-user-settings-fill "></i>
                    <span class="ms-3 hover:text-white">Pengaturan</span>
                    <svg class="w-2.5 h-2.5 ms-20" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 4 4 4-4" />
                </button>
                <div id="dropdownPengaturan"
                    class="z-10 hidden w-56 bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700">
                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                        aria-labelledby="dropdownPengaturanButton">
                        <x-admin.li-navbar route="dashboard.pengaturan.profile" title="Profile" />
                        <x-admin.li-navbar route="dashboard.pengaturan.kantor" title="Kantor" />
                        <x-admin.li-navbar route="dashboard.pengaturan.shift" title="Shift" />
                        <x-admin.li-navbar route="dashboard.pengaturan.tanggal" title="Tanggal" />
                        <x-admin.li-navbar route="dashboard.pengaturan.quotes" title="Quotes" />
                    </ul>
                </div>
                <x-admin.li-navbar route="logout" title="Sign out" icon="ri-logout-box-fill" addclass="absolute bottom-5 w-[231px] "/>
            </div>
        </ul>
    </div>
</aside>

<div class="sm:ml-64">
    {{ $slot }}
</div>
