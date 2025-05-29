<?php
require_once '../Model/panitiaModel.php';
require_once '../View/panitiaView.php';
$view = new panitiaView();
$model = new panitiaModel();
?>

<div class="mt-20 mx-10 grid lg:grid-cols-5 space-y-8 gap-x-5">
    <div class="border border-neutral-300 rounded-xl w-full h-25 relative">
        <div class="bg-gradient-to-bl from-[rgb(154,94,44)] to-[rgb(99,52,14)] w-18 h-18 rounded-xl absolute -inset-y-7 inset-x-2 flex justify-center items-center">
            <svg fill="#ffffff" class="w-10 h-fit" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                <g id="SVGRepo_iconCarrier">
                    <path d="M19.73,16.663A3.467,3.467,0,0,0,20.5,14.5a3.5,3.5,0,0,0-7,0,3.467,3.467,0,0,0,.77,2.163A6.04,6.04,0,0,0,12,18.69a6.04,6.04,0,0,0-2.27-2.027A3.467,3.467,0,0,0,10.5,14.5a3.5,3.5,0,0,0-7,0,3.467,3.467,0,0,0,.77,2.163A6,6,0,0,0,1,22a1,1,0,0,0,1,1H22a1,1,0,0,0,1-1A6,6,0,0,0,19.73,16.663ZM7,13a1.5,1.5,0,1,1-1.5,1.5A1.5,1.5,0,0,1,7,13ZM3.126,21a4,4,0,0,1,7.748,0ZM17,13a1.5,1.5,0,1,1-1.5,1.5A1.5,1.5,0,0,1,17,13Zm-3.873,8a4,4,0,0,1,7.746,0ZM7.2,8.4A1,1,0,0,0,8.8,9.6a4,4,0,0,1,6.4,0,1,1,0,1,0,1.6-1.2,6,6,0,0,0-2.065-1.742A3.464,3.464,0,0,0,15.5,4.5a3.5,3.5,0,0,0-7,0,3.464,3.464,0,0,0,.765,2.157A5.994,5.994,0,0,0,7.2,8.4ZM12,3a1.5,1.5,0,1,1-1.5,1.5A1.5,1.5,0,0,1,12,3Z"></path>
                </g>
            </svg>

        </div>
        <div class="absolute text-xs right-0 mr-4 mt-4.5">
            Warga
        </div>
        <div class="font-bold absolute right-0 top-7 text-3xl mr-5 mt-2">
            <?= $model->getJumlahWarga() ?>
        </div>
    </div>
    <div class="border border-neutral-300 rounded-xl w-full h-25 relative">
        <div class="bg-gradient-to-bl from-[#ffc261] to-[#B78029] w-18 h-18 rounded-xl absolute -inset-y-7 inset-x-2 flex justify-center items-center">
            <svg fill="#ffffff" class="w-10 h-fit" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                <g id="SVGRepo_iconCarrier">
                    <path d="M23,4a1,1,0,0,0-1-1H17V2a1,1,0,0,0-2,0v.589a7.935,7.935,0,0,0-6,0V2A1,1,0,0,0,7,2V3H2A1,1,0,0,0,1,4,4.946,4.946,0,0,0,4.186,8.3,8.008,8.008,0,0,0,4,10v2.851C2.136,13.921,1,15.374,1,17c0,3.364,4.832,6,11,6s11-2.636,11-6c0-1.626-1.136-3.079-3-4.149V10a8.008,8.008,0,0,0-.186-1.7A4.946,4.946,0,0,0,23,4ZM4.856,6.414A3.269,3.269,0,0,1,3.294,5H5.765a8.1,8.1,0,0,0-.889,1.379C4.87,6.391,4.862,6.4,4.856,6.414ZM21,17c0,1.892-3.7,4-9,4s-9-2.108-9-4c0-.929.894-1.908,2.428-2.666l.012,0A15.4,15.4,0,0,1,12,13a15.4,15.4,0,0,1,6.56,1.33l.008,0C20.1,15.09,21,16.07,21,17Zm-9-6a19.14,19.14,0,0,0-6,.939V10a6,6,0,0,1,12,0v1.939A19.039,19.039,0,0,0,12,11Zm7.144-4.586c-.006-.011-.012-.02-.017-.03A8.173,8.173,0,0,0,18.235,5h2.47A3.261,3.261,0,0,1,19.144,6.414ZM10,17a2,2,0,1,1-2-2A2,2,0,0,1,10,17Zm8,0a2,2,0,1,1-2-2A2,2,0,0,1,18,17Z"></path>
                </g>
            </svg>
        </div>
        <div class="absolute text-xs right-0 mr-4 mt-4.5">
            Berqurban
        </div>
        <div class="font-bold absolute right-0 top-7 text-3xl mr-5 mt-2">
            <?= $model->getJumlahBerqurban() ?>
        </div>
    </div>
    <div class="border border-neutral-300 rounded-xl w-full h-25 relative">
        <div class="bg-gradient-to-br from-[#e2cca7] to-[#F6F2EC] w-18 h-18 rounded-xl absolute -inset-y-7 inset-x-2 flex justify-center items-center">
            <svg fill="#673A10" class="w-10 h-fit" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                <g id="SVGRepo_iconCarrier">
                    <path d="M12,11A5,5,0,1,0,7,6,5.006,5.006,0,0,0,12,11Zm0-8A3,3,0,1,1,9,6,3,3,0,0,1,12,3ZM3,22V18a5.006,5.006,0,0,1,5-5h8a5.006,5.006,0,0,1,5,5v4a1,1,0,0,1-2,0V18a3,3,0,0,0-3-3H8a3,3,0,0,0-3,3v4a1,1,0,0,1-2,0Z"></path>
                </g>
            </svg>
        </div>
        <div class="absolute text-xs right-0 mr-4 mt-4.5">
            Panitia
        </div>
        <div class="font-bold absolute right-0 top-7 text-3xl mr-5 mt-2">
            <?= $model->getJumlahPanitia() ?>
        </div>
    </div>
    <div class="border border-neutral-300 rounded-xl w-full h-25 relative">
        <div class="bg-gradient-to-bl from-[#ffffff] to-[#dfdfdf] w-18 h-18 rounded-xl absolute -inset-y-7 inset-x-2 flex justify-center items-center">
            <svg fill="currentColor" class="text-black w-10 h-fit" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                <g id="SVGRepo_iconCarrier">
                    <path d="M12,11A5,5,0,1,0,7,6,5.006,5.006,0,0,0,12,11Zm0-8A3,3,0,1,1,9,6,3,3,0,0,1,12,3ZM3,22V18a5.006,5.006,0,0,1,5-5h8a5.006,5.006,0,0,1,5,5v4a1,1,0,0,1-2,0V18a3,3,0,0,0-3-3H8a3,3,0,0,0-3,3v4a1,1,0,0,1-2,0Z"></path>
                </g>
            </svg>
        </div>
        <div class="absolute text-xs right-0 mr-4 mt-4.5">
            Admin
        </div>
        <div class="font-bold absolute right-0 top-7 text-3xl mr-5 mt-2">
            <?= $model->getJumlahAdmin() ?>
        </div>
    </div>
    <div class="border border-neutral-300 rounded-xl w-full h-25 flex justify-center items-center">
        <div class="grid grid-rows-20%_80% text-center">
            <div class="text-base">
                Total
            </div>
            <div class="font-bold text-3xl">
                <?= $model->getJumlahTotal() ?>
            </div>
        </div>
    </div>
</div>

<div class="flex space-x-5">
    <div class="flex bg-gradient-to-l from-[#fff5e3] via-white to-white rounded-xl w-full h-30 relative overflow-hidden">
        <div class="grid grid-cols-75%_25%">
            <div class="absolute right-0 h-full w-35 overflow-hidden">
                <img src="../assets/img/sapi.png" class="absolute scale-250 left-20 top-15" alt="">
            </div>
            <div class="w-85 h-30 ml-6 grid grid-cols-3">
                <div class="flex justify-center items-center ">
                    <div class="grid grid-rows-10%_90% text-center">
                        <div class="text-sm ">Total</div>
                        <div class="font-bold text-xl"><?php $view->totalDagingSapi() ?> Kg</div>
                    </div>
                </div>
                <div class="flex justify-center items-center ">
                    <div class="grid grid-rows-10%_90% text-center">
                        <div class="text-sm ">Terbagi</div>
                        <div class="font-bold text-xl"><?php $view->totalTerbagiSapi() ?></div>
                    </div>
                </div>
                <div class="flex justify-center items-center ">
                    <div class="font-bold text-3xl text-green-800"><?php $view->persenTerbagiSapi() ?></div>
                </div>
            </div>
        </div>
    </div>
    <div class="flex bg-gradient-to-r from-[#fff5e3] via-white to-white rounded-xl w-full h-30 relative overflow-hidden">
        <div class="grid grid-cols-75%_25%">
            <div class="absolute left-0 h-full w-35 overflow-hidden">
                <img src="../assets/img/kambing.png" class="absolute scale-180 right-10 top-14" alt="">
            </div>
            <div class="w-85 h-30 ml-28 grid grid-cols-3">
                <div class="flex justify-center items-center ">
                    <div class="grid grid-rows-10%_90% text-center">
                        <div class="text-sm ">Total</div>
                        <div class="font-bold text-xl"><?php $view->totalDagingKambing(); ?> Kg</div>
                    </div>
                </div>
                <div class="flex justify-center items-center ">
                    <div class="grid grid-rows-10%_90% text-center">
                        <div class="text-sm ">Terbagi</div>
                        <div class="font-bold text-xl"><?php $view->totalTerbagiKambing() ?></div>
                    </div>
                </div>
                <div class="flex justify-center items-center ">
                    <div class="font-bold text-3xl text-green-800"><?php $view->persenTerbagiKambing() ?></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="p-10 w-full">
    <div class=" bg-gradient-to-l from-[#fff5e3] via-white to-white rounded-xl h-30 px-10 relative">
        <div class="grid grid-cols-2">
            <div class="w-full max-w-sm min-w-[200px] relative mt-6 ml-15">
                <label class="block mb-2 text-sm text-slate-600">
                    Periksa Jatah Penerima
                </label>

                <div class="relative">
                    <input type="text" data-idPembagian="" name="cariJatah" autocomplete="off" class="w-full bg-transparent placeholder:text-slate-400 text-black text-sm border border-slate-200 rounded-md pl-3 pr-20 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow" placeholder="Masukkan nama penerima" />
                    <div id="suggestions" class="absolute z-100 mt-1 w-full bg-white border border-neutral-300 rounded-md shadow-lg max-h-48 overflow-auto hidden"></div>
                    <button class="hitungBtn absolute right-1 top-1 rounded bg-[rgb(154,94,44)] py-1 px-2.5 border border-transparent text-center text-sm text-white transition-all shadow-sm hover:shadow hover:bg-[rgb(99,52,14)] hover:cursor-pointer disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none" type="button">
                        Hitung
                    </button>
                </div>
            </div>
            <div class=" w-full h-30 grid grid-cols-3 ml-3">
                <div class="flex justify-center items-center text-center">
                    <div class="grid grid-rows-10%_90%">
                        <div class="text-sm">Kambing</div>
                        <div class="font-bold text-2xl"><span class="jatahKambing">0</span> Kg</div>
                    </div>
                </div>
                <div class="flex justify-center items-center text-center">
                    <div class="grid grid-rows-10%_90%">
                        <div class="text-sm">Sapi</div>
                        <div class="font-bold text-2xl"><span class="jatahSapi">0</span> Kg</div>
                    </div>
                </div>
                <div class="flex justify-center items-center text-center">
                    <div class="statusTerbagi font-bold text-xl">Belum Menerima</span></div>
                </div>
            </div>
        </div>
    </div>
</div>




<script defer src="../assets/js/dashboardPanitia.js"></script>