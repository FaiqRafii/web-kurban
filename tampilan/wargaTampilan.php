<?php
require_once '../action/wargaAction.php';

class wargaTampilan extends wargaAction
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
        $jatah = $this->getJatah()->fetch_assoc();

        echo '
        <ul class="font-semibold text-lg list-disc ml-5">
                            <li>' . number_format($jatah['kambing'], 2) . ' Kg Daging Kambing</li>
                            <li>' . number_format($jatah['sapi'], 2) . ' Kg Daging Sapi</li>
                        </ul>
        ';
    }

    function qrCodeTiket()
    {
        $jatah = $this->getJatah()->fetch_assoc();
        $qrData = [
            "nama" => $this->getNama(),
            "alamat" => $this->getAlamat(),
            "noHp" => $this->getNoHp(),
            "kambing" => number_format($jatah['kambing'], 2) . " Kg Daging Kambing",
            "sapi" => number_format($jatah['sapi'], 2) . " Kg Daging Sapi",
        ];
        $qrSize = 200;
        $jsonString = "Nama\t: {$qrData['nama']} \nAlamat\t: {$qrData['alamat']}\nNomor HP\t: {$qrData['noHp']} \nPembagian\t: \n\t1) {$qrData['kambing']}\n\t2) {$qrData['sapi']}";
        $encodedQr = urlencode($jsonString);

        echo '
        <div class="qr-loading">
            <div>Memuat...</div>
        </div>
        <img src="https://api.qrserver.com/v1/create-qr-code/?size=' . $qrSize . 'x' . $qrSize . '&data=' . $encodedQr . '" class=" mt-3" onload="document.querySelector(\'.qr-loading\').style.display=\'none\';">
        ';
    }

    function qrCodeDashboard()
    {
        $jatah = $this->getJatah()->fetch_assoc();
        $qrData = [
            "nama" => $this->getNama(),
            "alamat" => $this->getAlamat(),
            "noHp" => $this->getNoHp(),
            "kambing" => number_format($jatah['kambing'], 2) . " Kg Daging Kambing",
            "sapi" => number_format($jatah['sapi'], 2) . " Kg Daging Sapi",
        ];
        $qrSize = 200;
        $jsonString = "Nama\t: {$qrData['nama']} \nAlamat\t: {$qrData['alamat']}\nNomor HP\t: {$qrData['noHp']} \nPembagian\t: \n\t1) {$qrData['kambing']}\n\t2) {$qrData['sapi']}";
        $encodedQr = urlencode($jsonString);

        $status = $this->getStatus()->fetch_assoc()['status'];
        if ($status == 'terbagi') {
            echo '
            <div id="qr-loading" class="h-fit mt-13 mb-5 w-full flex justify-center items-center">
            <svg class="shrink-0 size-20 mt-0.5 text-green-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"></path>
            <path d="m9 12 2 2 4-4"></path>
          </svg>
          </div>
          <div class="w-full flex">
          <div class="text-green-500 font-bold">Sudah Ambil Daging</div>
          </div>
            ';
        }else{
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
}
