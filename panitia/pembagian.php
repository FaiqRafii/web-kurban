<?php require_once '../View/panitiaView.php';
$view = new panitiaView();

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
                <table class="mt-10 w-fit text-sm">
                    <tr>
                        <th colspan="5" class="text-3xl text-left pb-10">Rekapan Pembagian</th>
                    </tr>
                    <tr class="">
                        <th class="pb-15">
                            <input type="hidden" disabled name="action" value="cariPenerima" id="">
                            <div class="w-full relative">
                                <div class="relative">
                                    <input required name="keyword" type="text" class="w-45 absolute left-0 bg-white placeholder:text-neutral-400 text-black text-sm border border-neutral-300 rounded-md pr-3 pl-10 font-normal py-2 transition duration-300 ease focus:outline-none focus:border-neutral-400 hover:border-neutral-300" placeholder="Cari penerima..." />
                                    <div class="absolute bg-gradient-to-bl from-[rgb(154,94,44)] to-[rgb(99,52,14)] left-1 top-1 rounded p-1.5 text-center text-sm text-white transition-all focus:bg-neutral-700 active:bg-neutral-700  disabled:pointer-events-none disabled:opacity-50">
                                        <svg fill="currentColor" class="w-4 h-fit text-white" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                            <g id="SVGRepo_iconCarrier">
                                                <path d="M3.624,15a8.03,8.03,0,0,0,10.619.659l5.318,5.318a1,1,0,0,0,1.414-1.414l-5.318-5.318A8.04,8.04,0,0,0,3.624,3.624,8.042,8.042,0,0,0,3.624,15Zm1.414-9.96a6.043,6.043,0,1,1-1.77,4.274A6,6,0,0,1,5.038,5.038Z"></path>
                                            </g>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </th>
                        <th ></th>
                        <th class="pr-20"></th>
                        <th class="pb-15 pl-35">
                            <input type="hidden" disabled name="action" value="updateDaging" id="">
                            <div class="w-fit relative">
                                <label class="absolute w-40 left-0 -top-6 mb-1 text-sm font-normal text-neutral-600">
                                    Total Daging Kambing
                                </label>
                                <div class="absolute left-0 h-9.5 w-40 bg-white placeholder:text-neutral-400 text-black text-sm border border-neutral-300 rounded-md pr-3 pl-10 py-2 transition duration-300 ease focus:outline-none focus:border-neutral-400 hover:border-neutral-300"><?php $view->totalDagingKambing() ?> Kg</div>
                                <div class="absolute left-1 top-1 rounded bg-gradient-to-bl from-[rgb(154,94,44)] to-[rgb(99,52,14)] p-1.5 border border-transparent text-center text-sm text-white transition-all focus:bg-neutral-700 active:bg-neutral-700  disabled:pointer-events-none disabled:opacity-50">
                                    <svg fill="#ffffff" class="w-4 h-fit" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                        <g id="SVGRepo_iconCarrier">
                                            <path d="M4,23H20a1,1,0,0,0,1-1V18a9.008,9.008,0,0,0-6-8.475V7h1.764a2.983,2.983,0,0,0,2.683-1.658L20.9,2.447A1,1,0,0,0,20,1H4a1,1,0,0,0-.895,1.447L4.553,5.342A2.983,2.983,0,0,0,7.236,7H9V9.525A9.008,9.008,0,0,0,3,18v4A1,1,0,0,0,4,23ZM7.236,5a1,1,0,0,1-.894-.553L5.618,3H18.382l-.724,1.447A1,1,0,0,1,16.764,5ZM13,7V9.059a8.5,8.5,0,0,0-2,0V7ZM5,18a7.006,7.006,0,0,1,5.252-6.77,6.836,6.836,0,0,1,3.5,0A7.006,7.006,0,0,1,19,18v3H5Zm9.707-4.707a1,1,0,0,1,0,1.414l-2,2a1,1,0,0,1-1.414-1.414l2-2A1,1,0,0,1,14.707,13.293Z"></path>
                                        </g>
                                    </svg>
                                </div>
                            </div>
                        </th>
                        <th class="pb-15 pl-30">
                            <input type="hidden" disabled name="action" value="updateDaging" id="">
                            <div class="w-fit relative">
                                <label class="absolute w-40 text-left left-0 -top-6 mb-1 text-sm font-normal text-neutral-600">
                                    Total Daging Sapi
                                </label>
                                <div class="absolute left-0 h-9.5 w-40 bg-white placeholder:text-neutral-400 text-black text-sm border border-neutral-300 rounded-md pr-3 pl-10 py-2 transition duration-300 ease focus:outline-none focus:border-neutral-400 hover:border-neutral-300"><?php $view->totalDagingSapi() ?> Kg</div>
                                <div class="absolute left-1 top-1 rounded bg-gradient-to-bl from-[rgb(154,94,44)] to-[rgb(99,52,14)] p-1.5 border border-transparent text-center text-sm text-white transition-all focus:bg-neutral-700 active:bg-neutral-700  disabled:pointer-events-none disabled:opacity-50">
                                    <svg fill="#ffffff" class="w-4 h-fit" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                        <g id="SVGRepo_iconCarrier">
                                            <path d="M4,23H20a1,1,0,0,0,1-1V18a9.008,9.008,0,0,0-6-8.475V7h1.764a2.983,2.983,0,0,0,2.683-1.658L20.9,2.447A1,1,0,0,0,20,1H4a1,1,0,0,0-.895,1.447L4.553,5.342A2.983,2.983,0,0,0,7.236,7H9V9.525A9.008,9.008,0,0,0,3,18v4A1,1,0,0,0,4,23ZM7.236,5a1,1,0,0,1-.894-.553L5.618,3H18.382l-.724,1.447A1,1,0,0,1,16.764,5ZM13,7V9.059a8.5,8.5,0,0,0-2,0V7ZM5,18a7.006,7.006,0,0,1,5.252-6.77,6.836,6.836,0,0,1,3.5,0A7.006,7.006,0,0,1,19,18v3H5Zm9.707-4.707a1,1,0,0,1,0,1.414l-2,2a1,1,0,0,1-1.414-1.414l2-2A1,1,0,0,1,14.707,13.293Z"></path>
                                        </g>
                                    </svg>
                                </div>
                            </div>
                        </th>
                    </tr>
                    <tr class="text-left text-white bg-gradient-to-bl from-[rgb(154,94,44)] to-[rgb(99,52,14)]">
                        <th class="py-2 pl-5">Dibagikan</th>
                        <th class="py-2 pl-5">NIK</th>
                        <th class="py-2 px-5">Nama</th>
                        <th class="py-2 px-5">Alamat</th>
                        <th class="py-2 pr-5">No HP</th>
                        <th class="py-2 pr-5">Kambing</th>
                        <th class="py-2 pr-5">Sapi</th>
                    </tr>

                    <tbody id="isiTabelPembagian">
                        <?php $view->isiTabelPembagian() ?>
                    </tbody>

                </table>

            </form>
        </div>

        <div id="addModal" class="hw-fit transition-all ease-in duration-150 fixed bottom-3 right-3 z-30 h-fit bg-white border border-neutral-300 rounded-xl mt-23.5">
            <div onclick="minimizeAddModal()" class="hover:cursor-pointer flex justify-between items-center space-x-3 p-4">
                <h3 class="font-bold">Edit Total Daging</h3>
                <div class="hover:cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                    </svg>
                </div>
            </div>
            <div id="addModalContent" class="hidden pb-6 pr-4">
                <form action="../Controller/panitiaController.php" method="POST">
                    <input type="hidden" name="action" value="updateDaging" id="">
                    <div class="w-full max-w-sm min-w-[200px] relative ml-5">
                        <label class="block mb-1 text-sm text-neutral-600">
                            Total Daging Kambing (Kg)
                        </label>
                        <div class="relative">
                            <input required name="kambing" type="number" class="w-81 bg-transparent placeholder:text-neutral-400 text-black text-sm border border-neutral-300 rounded-md pr-3 pl-10 py-2 transition duration-300 ease focus:outline-none focus:border-neutral-400 hover:border-neutral-300" placeholder="Masukkan total daging sapi" value="<?php $view->totalDagingKambing() ?>" />
                            <div class="absolute left-1 top-1 rounded bg-gradient-to-bl from-[rgb(154,94,44)] to-[rgb(99,52,14)] p-1.5 border border-transparent text-center text-sm text-white transition-all focus:bg-neutral-700 active:bg-neutral-700  disabled:pointer-events-none disabled:opacity-50">
                                <svg fill="#ffffff" class="w-4 h-fit" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path d="M4,23H20a1,1,0,0,0,1-1V18a9.008,9.008,0,0,0-6-8.475V7h1.764a2.983,2.983,0,0,0,2.683-1.658L20.9,2.447A1,1,0,0,0,20,1H4a1,1,0,0,0-.895,1.447L4.553,5.342A2.983,2.983,0,0,0,7.236,7H9V9.525A9.008,9.008,0,0,0,3,18v4A1,1,0,0,0,4,23ZM7.236,5a1,1,0,0,1-.894-.553L5.618,3H18.382l-.724,1.447A1,1,0,0,1,16.764,5ZM13,7V9.059a8.5,8.5,0,0,0-2,0V7ZM5,18a7.006,7.006,0,0,1,5.252-6.77,6.836,6.836,0,0,1,3.5,0A7.006,7.006,0,0,1,19,18v3H5Zm9.707-4.707a1,1,0,0,1,0,1.414l-2,2a1,1,0,0,1-1.414-1.414l2-2A1,1,0,0,1,14.707,13.293Z"></path>
                                    </g>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="w-full max-w-sm min-w-[200px] relative mt-2 ml-5">
                        <label class="block mb-1 text-sm text-neutral-600">
                            Total Daging Sapi (Kg)
                        </label>
                        <div class="relative">
                            <input required name="sapi" type="number" class="w-81 bg-transparent placeholder:text-neutral-400 text-black text-sm border border-neutral-300 rounded-md pr-3 pl-10 py-2 transition duration-300 ease focus:outline-none focus:border-neutral-400 hover:border-neutral-300" placeholder="Masukkan total daging sapi" value="<?php $view->totalDagingSapi() ?>" />
                            <div class="absolute left-1 top-1 rounded bg-gradient-to-bl from-[rgb(154,94,44)] to-[rgb(99,52,14)] p-1.5 border border-transparent text-center text-sm text-white transition-all focus:bg-neutral-700 active:bg-neutral-700  disabled:pointer-events-none disabled:opacity-50">
                                <svg fill="#ffffff" class="w-4 h-fit" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path d="M23,4a1,1,0,0,0-1-1H17V2a1,1,0,0,0-2,0v.589a7.935,7.935,0,0,0-6,0V2A1,1,0,0,0,7,2V3H2A1,1,0,0,0,1,4,4.946,4.946,0,0,0,4.186,8.3,8.008,8.008,0,0,0,4,10v2.851C2.136,13.921,1,15.374,1,17c0,3.364,4.832,6,11,6s11-2.636,11-6c0-1.626-1.136-3.079-3-4.149V10a8.008,8.008,0,0,0-.186-1.7A4.946,4.946,0,0,0,23,4ZM4.856,6.414A3.269,3.269,0,0,1,3.294,5H5.765a8.1,8.1,0,0,0-.889,1.379C4.87,6.391,4.862,6.4,4.856,6.414ZM21,17c0,1.892-3.7,4-9,4s-9-2.108-9-4c0-.929.894-1.908,2.428-2.666l.012,0A15.4,15.4,0,0,1,12,13a15.4,15.4,0,0,1,6.56,1.33l.008,0C20.1,15.09,21,16.07,21,17Zm-9-6a19.14,19.14,0,0,0-6,.939V10a6,6,0,0,1,12,0v1.939A19.039,19.039,0,0,0,12,11Zm7.144-4.586c-.006-.011-.012-.02-.017-.03A8.173,8.173,0,0,0,18.235,5h2.47A3.261,3.261,0,0,1,19.144,6.414ZM10,17a2,2,0,1,1-2-2A2,2,0,0,1,10,17Zm8,0a2,2,0,1,1-2-2A2,2,0,0,1,18,17Z"></path>
                                    </g>
                                </svg>
                            </div>
                        </div>
                    </div>


                    <div class="px-5 pt-5">
                        <input type="submit" class="w-full transition-all ease-in duration-300 bg-gradient-to-l from-[rgb(154,94,44)] to-[rgb(99,52,14)] hover:bg-gradient-to-r hover:cursor-pointer h-fit py-1.5 rounded-lg text-white" value="Update">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script defer src="../assets/js/pembagian.js"></script>
