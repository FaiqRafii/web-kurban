<?php
require_once '../Controller/wargaController.php';

class wargaView extends wargaController
{
    function getNama()
    {
        return $this->getNamaClean();
    }

    function getAlamat()
    {
        return $this->getAlamatClean();
    }

    function getNoHp()
    {
        return $this->getNoHpClean();
    }

    function pembagian()
    {
        echo '
        <ul class="font-semibold text-lg list-disc ml-5">
                            <li>3 Kg Daging Kambing</li>
                            <li>1 Kg Daging Sapi</li>
                        </ul>
        ';
    }

    function qrCodeTiket()
    {
        $qrData = [
            "nama" => $this->getNama(),
            "alamat" => $this->getAlamat(),
            "noHp" => $this->getNoHp(),
            "pembagian" => "3 Kg Daging Kambing, 1 Kg Daging Sapi"
        ];
        $qrSize = 200;
        $jsonQr = json_encode($qrData, JSON_UNESCAPED_UNICODE);
        $encodedQr = urlencode($jsonQr);

        echo '
        <div class="qr-loading">
            <div>Memuat...</div>
        </div>
        <img src="https://api.qrserver.com/v1/create-qr-code/?size=' . $qrSize . 'x' . $qrSize . '&data=' . $encodedQr . '" class=" mt-3" onload="document.querySelector(\'.qr-loading\').style.display=\'none\';">
        ';
    }

    function qrCodeDashboard()
    {
        $qrData = [
            "nama" => $this->getNama(),
            "alamat" => $this->getAlamat(),
            "noHp" => $this->getNoHp(),
            "pembagian" => "3 Kg Daging Kambing, 1 Kg Daging Sapi"
        ];
        $qrSize = 200;
        $jsonQr = json_encode($qrData, JSON_UNESCAPED_UNICODE);
        $encodedQr = urlencode($jsonQr);

        echo '
        <div id="qr-loading" class="h-60 w-full flex justify-center items-center">
            <div class="w-20 h-20 rounded-full border border-t-2 border-b-2 border-black animate-spin"></div>
        </div>
        <img src="https://api.qrserver.com/v1/create-qr-code/?size=' . $qrSize . 'x' . $qrSize . '&data=' . $encodedQr . '" class=" mt-3" alt="" onload="document.getElementById(\'qr-loading\').style.display=\'none\'; document.getElementById(\'unduhBtn\').classList.remove(\'hidden\')">
        <div id="unduhBtn" class="mx-auto mt-3 hidden flex justify-center items-center">
                        <a href="tiket.php" class="bg-black hover:bg-neutral-800 transition-all ease-in duration-75 w-fit h-fit text-white rounded flex items-center gap-2 px-2 py-1">
                            <svg viewBox="0 0 24 24" class="w-4 h-fit" xmlns="http://www.w3.org/2000/svg" fill="#ffffff" stroke="#ffffff">
                                <g id="SVGRepo_iconCarrier">
                                    <g id="Complete">
                                        <g id="download">
                                            <path d="M3,12.3v7a2,2,0,0,0,2,2H19a2,2,0,0,0,2-2v-7" fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                                            <polyline points="7.9 12.3 12 16.3 16.1 12.3" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" fill="none"></polyline>
                                            <line x1="12" x2="12" y1="2.7" y2="14.2" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" fill="none"></line>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                            <span class="text-sm">Unduh</span>
                        </a>
                    </div>
        ';
    }
}
