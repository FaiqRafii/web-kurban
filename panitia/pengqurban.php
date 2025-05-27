<?php
require_once '../Model/panitiaModel.php';
require_once '../View/panitiaView.php';
$view = new panitiaView();
$model = new panitiaModel();

if (isset($_SESSION['alert'])) {
    $view->alert($_SESSION['alert']);
    unset($_SESSION['alert']);
} else if (isset($_SESSION['alertSukses'])) {
    $view->alertSukses($_SESSION['alertSukses']);
    unset($_SESSION['alertSukses']);
}
?>

<div class="my-20 mx-10 grid lg:grid-cols-4 space-y-8 gap-x-5">

    <?php $view->isiQurban() ?>

    <div id="openModal" class="group hover:bg-green-600 transition-all ease-in duration-100 hover:cursor-pointer col-span-2 border-dashed bg-white border border-green-600 rounded-xl w-full h-30 relative flex justify-center items-center overflow-hidden">
        <svg fill="currentColor" class="text-green-600 group-hover:text-white w-20 h-fit" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
            <g id="SVGRepo_iconCarrier">
                <path d="M11,17V13H7a1,1,0,0,1,0-2h4V7a1,1,0,0,1,2,0v4h4a1,1,0,0,1,0,2H13v4a1,1,0,0,1-2,0Z"></path>
            </g>
        </svg>
    </div>




</div>

<div id="containerQurban" class="hidden absolute flex justify-center items-center z-80 top-0 left-0 bg-black/20 w-screen h-screen mx-auto my-auto">
    <div class="modalQurban w-1/2 h-2/3 bg-white rounded-lg opacity-100 p-5 relative">
        <form action="../Controller/panitiaController.php" method="POST">
            <div class="w-full h-10 border-b border-neutral-300 flex justify-between">
                <div class="font-semibold">Pengqurban</div>
                <div>
                    <svg fill="#000000" class="closeModal w-7 h-fit hover:cursor-pointer hover:rotate-90 transition-all ease-in duration-100" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <path d="M16.707,8.707,13.414,12l3.293,3.293a1,1,0,1,1-1.414,1.414L12,13.414,8.707,16.707a1,1,0,1,1-1.414-1.414L10.586,12,7.293,8.707A1,1,0,1,1,8.707,7.293L12,10.586l3.293-3.293a1,1,0,1,1,1.414,1.414Z"></path>
                        </g>
                    </svg>
                </div>
            </div>
            <input type="hidden" name="action" value="addQurban">
            <input type="hidden" name="idQurban">
            <input type="hidden" name="pengqurbanLama">
            <div class="relative mt-5 mb-5">
                <div class="text-sm ml-5 mb-2 text-neutral-500">Hewan</div>
                <select
                    name="hewan"
                    class="hover:cursor-pointer peer p-4 pe-12 block w-full border border-neutral-300 rounded-lg text-sm focus:border-neutral-400 focus:outline-none disabled:opacity-50 disabled:pointer-events-none appearance-none">
                    <option disabled selected="" value="">Pilih hewan qurban</option>
                    <option value="kambing">Kambing</option>
                    <option value="sapi">Sapi</option>
                </select>

                <div class="pointer-events-none absolute top-7 inset-y-0 right-4 flex items-center">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>
            </div>


            <div id="labelPengqurbanLuar" class="hidden text-sm ml-5 mb-2 text-neutral-500">Pengqurban</div>
            <button onclick="openMenu()" type="button" class="w-full min-h-10 flex justify-center items-center p-2 hover:cursor-pointer border border-neutral-300 hover:border-neutral-400 rounded-lg transition-all duration-200 ease-in">
                <input type="hidden" id="idAkun" name="idAkun">
                <div id="labelPengqurban" class="text-sm">Pengqurban</div>
                <div id="pengqurbanList" class="w-full min-h-10 flex items-center justify-start space-x-1.5 p-1">
                </div>
            </button>
            <div id="selectMenu" class="hidden mt-1 w-60 max-h-40 overflow-hidden rounded border border-neutral-300 p-2">
                <div class="w-full h-10 rounded border border-neutral-300 mx-auto flex items-center p-2">
                    <input type="text" name="searchAkun" id="searchAkun" class="w-full focus:outline-none placeholder:text-sm text-xs" placeholder="Masukkan nama...">
                </div>
                <div id="listAkun" class="h-24 overflow-y-scroll">
                    <?php $view->listAkun(); ?>
                </div>
            </div>
            <div class="absolute bottom-5 right-5 space-x-3 mt-5">
                <input type="reset" name="" id="" class="bg-gradient-to-l from-neutral-100 to-neutral-300 px-2 py-0.5 rounded text-black hover:cursor-pointer hover:bg-gradient-to-r">
                <input type="submit" value="Simpan" name="" id="" class="bg-gradient-to-l from-[rgb(154,94,44)] to-[rgb(99,52,14)] px-2 py-0.5 rounded text-white hover:cursor-pointer hover:bg-gradient-to-r">
            </div>
        </form>
    </div>
</div>

<script defer src="../assets/js/panitia.js"></script>
