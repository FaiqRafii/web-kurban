<?php
require_once '../View/Content.php';
require_once '../Model/akunModel.php';
require_once '../View/wargaView.php';

use App\View\Content;

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if ($_SESSION['level_akun'] != 'warga' && $_SESSION['level_akun']!='berqurban') {
    header('Location: ../');
}

$view = new wargaView();
$akun = new akunModel();
$content = new Content();
?>

<div class="p-15">
    <div class="bg-white border border-neutral-300 rounded-xl w-full h-80 overflow-hidden">
        <div class="flex relative">
            <div class="absolute left-38 top-6">
                <img src="../assets/img/logoScroll.png" class=" w-20 h-fit" alt="">
            </div>
            <div class="bg-gradient-to-bl from-[rgb(154,94,44)] to-[rgb(99,52,14)] w-30 h-80"></div>
            <div class=" w-3/5 h-80 ">
                <div class="mt-20 ml-10 grid grid-cols-[45%_55%]">
                    <div>
                        <div class="text-neutral-400">Nama</div>
                        <div class="font-semibold text-lg mb-3"><?= $view->getNama() ?></div>
                        <div class="text-neutral-400">Alamat</div>
                        <div class="font-semibold text-lg mb-3"><?= $view->getAlamat() ?></div>
                        <div class="text-neutral-400">No HP</div>
                        <div class="font-semibold text-lg mb-4"><?= $view->getNoHp() ?></div>
                    </div>
                    <div>
                        <div class="text-neutral-400">Menerima</div>
                        <?php $view->pembagian() ?>
                    </div>
                </div>
                <div class="text-neutral-400 text-xs ml-10">*harap menunjukkan qr-code saat mengambil daging</div>
            </div>
            <div class="h-96 border-l border-dashed border-neutral-500"></div>
            <div class="w-72">
                <div class="grid grid-rows-[50px_1fr_320px]">
                    <div class="bg-black w-full h-full flex justify-center items-center">
                        <div class="text-white font-bold text-sm">
                            QR-CODE PENGAMBILAN DAGING
                        </div>
                    </div>
                    <div class="mx-auto
                    ">
                        <?php $view->qrCodeDashboard() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>