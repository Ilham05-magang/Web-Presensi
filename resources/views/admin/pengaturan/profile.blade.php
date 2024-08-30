<x-layout.layout-admin>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="-mx-px -mt-px shadow-xl shadow-[#242947]/40">
        <div class="flex justify-between gap-1 px-10 text-4xl font-medium text-white bg-no-repeat bg-cover py-14 rounded-t-xl bg-karyawan-bg">
            <div class="flex items-center gap-3">
                <div>
                    <h1>"{{ $data->username }}"</h1>
                    <p class="text-lg">{{ $data->email ?? '--\\--' }}</p>
                </div>
            </div>
            <div>
                <button id="buttonfirst" data-modal-target="EditAdmin{{ $data->id }}" data-modal-toggle="EditAdmin{{ $data->id }}"
                    class="text-white hover:bg-yellow-300 hover:text-gray-800 bg-yellow-400 px-2 rounded-lg py-1.5 text-center text-xl font-medium mr-3">
                    <i class="ri-edit-2-line"></i>
                </button>
                <x-admin.popup-admin title="Ingin Edit Admin"
                    :id="'EditAdmin' . $data->id" :data="$data->admin->nama" />
            </div>
        </div>
    </div>
    <div class="text-left capitalize ">
        <form class="grid grid-cols-2 gap-4 p-5 text-sm capitalize" action="{{ route('dashboard.pengaturan.editprofile', $data->admin->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="p-5 border-2 border-gray-400 rounded-xl">
                <div class="flex flex-col gap-5">
                    <div class="flex flex-col gap-1">
                        <label  for="nama">Nama</label>
                        <input type="text" name="nama" disabled class="editstatus px-3 py-1.5 border-2 border-gray-400 rounded-lg text-sm" value="{{ $data->admin->nama }}"/>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label  for="telepon">Telepon</label>
                        <input type="text" name="telepon" disabled class="editstatus px-3 py-1.5 border-2 border-gray-400 rounded-lg text-sm" value="{{ $data->admin->telepon }}"/>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label  for="username">Username</label>
                        <input type="text" name="username" disabled class="editstatus px-3 py-1.5 border-2 border-gray-400 rounded-lg text-sm" value="{{ $data->username }}"/>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label  for="email">Email</label>
                        <input type="email" name="email" disabled class="editstatus px-3 py-1.5 border-2 border-gray-400 rounded-lg text-sm" value="{{ $data->email }}"/>
                    </div>
                </div>
            </div>
            <div class="p-5 border-2 border-gray-400 rounded-xl">
                <div class="flex flex-col gap-5">
                    <div class="relative flex flex-col gap-1">
                        <label for="password" class="font-semibold">Password Baru</label>
                        <input type="password" id="password" name="password" disabled class="text-sm rounded-lg editstatus" placeholder="Ubah Password" >
                        <button type="button" id="togglePassword" disabled class="absolute inset-y-0 flex items-center editstatus top-6 right-3">
                            <i id="eyeIcon" class="ri-eye-off-fill"></i>
                        </button>
                    </div>
                    <div class="relative flex flex-col gap-1">
                        <label for="password_confirmation" class="font-semibold">Konfirmasi Password Baru</label>
                        <input type="password" name="password_confirmation" disabled id="password_confirmation" class="text-sm rounded-lg editstatus" placeholder="Ubah Password">
                        <button type="button" id="toggleKonfirmasiPassword" disabled class="absolute inset-y-0 flex items-center editstatus top-6 right-3">
                            <i id="eyeIconKonfirmasi" class="ri-eye-off-fill"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="flex gap-5">
                <button type="submit" id="submitForm" class=" w-32 hidden text-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Simpan
                </button>
                <div id="BatalEdit" class=" cursor-pointer w-32 hidden text-center text-white bg-red-600 hover:bg-red-500 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-800 dark:hover:bg-red-700 dark:focus:ring-red-800">
                    Batal
                </div>
            </div>
        </form>
    </div>
</x-layout.layout-admin>
