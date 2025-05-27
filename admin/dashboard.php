<?php require_once '../View/adminView.php';
$view = new adminView();

if (isset($_SESSION['alert'])) {
    $view->alert($_SESSION['alert']);
    unset($_SESSION['alert']);
} else if (isset($_SESSION['alertSukses'])) {
    $view->alertSukses($_SESSION['alertSukses']);
    unset($_SESSION['alertSukses']);
}
?>
<div class="relative px-10 py-5">

    <div class="w-full h-fit px-10 pb-15 bg-gradient-to-b from-[#fff5e3] via-white to-white rounded-xl">
        <div class="w-full pt-1">
            <form action="../Controller/adminController.php" method="POST">
                <table class="mt-10 w-full text-sm">
                    <tr class="">
                        <th colspan="3" class="text-left text-3xl pb-5">Pendataan Akun</th>
                    </tr>
                    <tr class=" text-left text-white bg-gradient-to-bl from-[rgb(154,94,44)] to-[rgb(99,52,14)]">
                        <th class="border border-black py-2 pl-5"></th>
                        <th class="border border-black py-2 pl-5">No</th>
                        <th class="border border-black py-2 pl-5">Nama</th>
                        <th class="border border-black py-2 pl-5">NIK</th>
                        <th class="border border-black py-2 px-5">Alamat</th>
                        <th class="border border-black py-2 px-5">No HP</th>
                        <th class="border border-black py-2 px-5">Level</th>
                    </tr>

                    <?php $view->isiTabelAkun(); ?>

                </table>
                
            </form>
        </div>

        <div id="addModal" class="hw-fit transition-all ease-in duration-150 fixed bottom-3 right-3 z-30 h-fit bg-white border border-neutral-300 rounded-xl mt-23.5">
            <div onclick="minimizeAddModal()" class="hover:cursor-pointer flex justify-between items-center space-x-3 p-4">
                <h3 class="font-bold">Tambah Akun</h3>
                <div class="hover:cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                    </svg>
                </div>
            </div>
            <div id="addModalContent" class="hidden pb-6 pr-4">
                <form action="../Controller/adminController.php" method="POST">
                    <input type="hidden" name="action" value="add" id="">
                    <div class="w-full max-w-sm min-w-[200px] relative mt-5 ml-5">
                        <label class="block mb-1 text-sm text-neutral-600">
                            Nama
                        </label>
                        <div class="relative">
                            <input required name="nama" type="text" class="w-81 bg-transparent placeholder:text-neutral-400 text-black text-sm border border-neutral-300 rounded-md pr-3 pl-10 py-2 transition duration-300 ease focus:outline-none focus:border-neutral-400 hover:border-neutral-300" placeholder="Masukkan nama" />
                            <div class="absolute left-1 top-1 rounded bg-gradient-to-bl from-[rgb(154,94,44)] to-[rgb(99,52,14)] p-1.5 border border-transparent text-center text-sm text-white transition-all focus:bg-neutral-700 active:bg-neutral-700  disabled:pointer-events-none disabled:opacity-50">
                                <svg fill="#ffffff" class="w-4 h-fit" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path d="M12,11A5,5,0,1,0,7,6,5.006,5.006,0,0,0,12,11Zm0-8A3,3,0,1,1,9,6,3,3,0,0,1,12,3ZM3,22V18a5.006,5.006,0,0,1,5-5h8a5.006,5.006,0,0,1,5,5v4a1,1,0,0,1-2,0V18a3,3,0,0,0-3-3H8a3,3,0,0,0-3,3v4a1,1,0,0,1-2,0Z"></path>
                                    </g>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="w-full max-w-sm min-w-[200px] relative mt-2 ml-5">
                        <label class="block mb-1 text-sm text-neutral-600">
                            NIK
                        </label>
                        <div class="relative">
                            <input required name="id_akun" type="text" class="w-81 bg-transparent placeholder:text-neutral-400 text-black text-sm border border-neutral-300 rounded-md pr-3 pl-10 py-2 transition duration-300 ease focus:outline-none focus:border-neutral-400 hover:border-neutral-300" placeholder="Masukkan NIK" />
                            <div class="absolute left-1 top-1 rounded bg-gradient-to-bl from-[rgb(154,94,44)] to-[rgb(99,52,14)] p-1.5 border border-transparent text-center text-sm text-white transition-all focus:bg-neutral-700 active:bg-neutral-700  disabled:pointer-events-none disabled:opacity-50">
                                <svg fill="#ffffff" class="w-4 h-fit" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path d="M4,21H20a3,3,0,0,0,3-3V6a3,3,0,0,0-3-3H4A3,3,0,0,0,1,6V18A3,3,0,0,0,4,21ZM3,6A1,1,0,0,1,4,5H20a1,1,0,0,1,1,1V18a1,1,0,0,1-1,1H4a1,1,0,0,1-1-1ZM5,16a1,1,0,0,1,1-1H9a1,1,0,0,1,0,2H6A1,1,0,0,1,5,16Zm0-3a1,1,0,0,1,1-1h6a1,1,0,0,1,0,2H6A1,1,0,0,1,5,13Z"></path>
                                    </g>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="w-full max-w-sm min-w-[200px] relative mt-2 ml-5">
                        <label class="block mb-1 text-sm text-neutral-600">
                            Alamat
                        </label>
                        <div class="relative">
                            <input required name="alamat" type="text" class="w-81 bg-transparent placeholder:text-neutral-400 text-black text-sm border border-neutral-300 rounded-md pr-3 pl-10 py-2 transition duration-300 ease focus:outline-none focus:border-neutral-400 hover:border-neutral-300" placeholder="Masukkan alamat" />
                            <div class="absolute left-1 top-1 rounded bg-gradient-to-bl from-[rgb(154,94,44)] to-[rgb(99,52,14)] p-1.5 border border-transparent text-center text-sm text-white transition-all focus:bg-neutral-700 active:bg-neutral-700  disabled:pointer-events-none disabled:opacity-50">
                                <svg fill="#ffffff" class="w-4 h-fit" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path d="M21.555,8.168l-9-6A1,1,0,0,0,12,2h0a1,1,0,0,0-.554.168l-9,6A1,1,0,0,0,3,10H4V21a1,1,0,0,0,1,1H19a1,1,0,0,0,1-1V10h1a1,1,0,0,0,.556-1.832ZM18,20H6V8.2l6-4,6,4Z"></path>
                                    </g>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="w-full max-w-sm min-w-[200px] relative mt-2 ml-5">
                        <label class="block mb-1 text-sm text-neutral-600">
                            Nomor HP
                        </label>
                        <div class="relative">
                            <input required name="noHp" type="text" class="w-81 bg-transparent placeholder:text-neutral-400 text-black text-sm border border-neutral-300 rounded-md pr-3 pl-10 py-2 transition duration-300 ease focus:outline-none focus:border-neutral-400 hover:border-neutral-300" placeholder="Masukkan nomor hp" />
                            <div class="absolute left-1 top-1 rounded bg-gradient-to-bl from-[rgb(154,94,44)] to-[rgb(99,52,14)] p-1.5 border border-transparent text-center text-sm text-white transition-all focus:bg-neutral-700 active:bg-neutral-700  disabled:pointer-events-none disabled:opacity-50">
                                <svg fill="#ffffff" class="w-4 h-fit" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path d="M1.277,8.858C2.606,14.138,9.863,21.4,15.142,22.723a8.938,8.938,0,0,0,2.18.274,8.54,8.54,0,0,0,4.006-1,3.11,3.11,0,0,0,.764-4.951h0L20.006,14.96a3.111,3.111,0,0,0-3.444-.651,4.859,4.859,0,0,0-1.471.987c-.178.177-.506.205-.977.077A9.981,9.981,0,0,1,8.626,9.886c-.126-.471-.1-.8.078-.977a4.864,4.864,0,0,0,.988-1.473,3.112,3.112,0,0,0-.651-3.442L6.955,1.909A3.065,3.065,0,0,0,4.3,1.035,3.1,3.1,0,0,0,2,2.672,8.58,8.58,0,0,0,1.277,8.858ZM3.773,3.6A1.115,1.115,0,0,1,4.6,3.013,1.044,1.044,0,0,1,4.767,3a1.088,1.088,0,0,1,.774.323L7.626,5.408a1.1,1.1,0,0,1,.239,1.213A2.9,2.9,0,0,1,7.29,7.5,2.817,2.817,0,0,0,6.7,10.4c.722,2.7,4.205,6.179,6.9,6.9a2.821,2.821,0,0,0,2.907-.6,2.906,2.906,0,0,1,.874-.576,1.1,1.1,0,0,1,1.214.239l2.085,2.085a1.089,1.089,0,0,1,.31.942,1.114,1.114,0,0,1-.591.826,6.517,6.517,0,0,1-4.766.556C11.089,19.641,4.36,12.912,3.216,8.37A6.53,6.53,0,0,1,3.773,3.6Z"></path>
                                    </g>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="w-full max-w-sm min-w-[200px] relative mt-2 ml-5">
                        <label class="block mb-1 text-sm text-neutral-600">
                            Level
                        </label>
                        <div class="relative">
                            <div class="relative">
                                <select required name="level" class="w-81 pl-10 bg-transparent placeholder:text-neutral-700 text-black text-sm border border-neutral-300 rounded py-2 transition duration-300 ease focus:outline-none focus:border-neutral-400 hover:border-neutral-400 appearance-none cursor-pointer">
                                    <option value="" selected="" disabled class="disabled:text-neutral-700 hover:bg-[rgb(99,52,14)]">Pilih level</option>
                                    <option value="warga">Warga</option>
                                    <option value="berqurban">Berqurban</option>
                                    <option value="panitia">Panitia</option>
                                    <option value="admin">Admin</option>
                                </select>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.2" stroke="currentColor" class="h-5 w-5 ml-1 absolute top-2.5 right-12 text-neutral-700">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15 12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                </svg>
                            </div>
                            <div class="absolute left-1 top-1 rounded bg-gradient-to-bl from-[rgb(154,94,44)] to-[rgb(99,52,14)] p-1.5 border border-transparent text-center text-sm text-white transition-all focus:bg-neutral-700 active:bg-neutral-700  disabled:pointer-events-none disabled:opacity-50">
                                <svg fill="#ffffff" class="w-4 h-fit" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path d="M19.73,16.663A3.467,3.467,0,0,0,20.5,14.5a3.5,3.5,0,0,0-7,0,3.467,3.467,0,0,0,.77,2.163A6.04,6.04,0,0,0,12,18.69a6.04,6.04,0,0,0-2.27-2.027A3.467,3.467,0,0,0,10.5,14.5a3.5,3.5,0,0,0-7,0,3.467,3.467,0,0,0,.77,2.163A6,6,0,0,0,1,22a1,1,0,0,0,1,1H22a1,1,0,0,0,1-1A6,6,0,0,0,19.73,16.663ZM7,13a1.5,1.5,0,1,1-1.5,1.5A1.5,1.5,0,0,1,7,13ZM3.126,21a4,4,0,0,1,7.748,0ZM17,13a1.5,1.5,0,1,1-1.5,1.5A1.5,1.5,0,0,1,17,13Zm-3.873,8a4,4,0,0,1,7.746,0ZM7.2,8.4A1,1,0,0,0,8.8,9.6a4,4,0,0,1,6.4,0,1,1,0,1,0,1.6-1.2,6,6,0,0,0-2.065-1.742A3.464,3.464,0,0,0,15.5,4.5a3.5,3.5,0,0,0-7,0,3.464,3.464,0,0,0,.765,2.157A5.994,5.994,0,0,0,7.2,8.4ZM12,3a1.5,1.5,0,1,1-1.5,1.5A1.5,1.5,0,0,1,12,3Z"></path>
                                    </g>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="px-5 pt-5">
                        <input type="submit" class="w-full transition-all ease-in duration-300 bg-gradient-to-l from-[rgb(154,94,44)] to-[rgb(99,52,14)] hover:bg-gradient-to-r hover:cursor-pointer h-fit py-1.5 rounded-lg text-white" value="Tambah">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>