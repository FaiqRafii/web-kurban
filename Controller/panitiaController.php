<?php
require_once '../Model/panitiaModel.php';
require_once '../Model/koneksi.php';
require_once '../Services/seederPembagian.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


class panitiaController extends panitiaModel
{

    private $seeder;

    function __construct()
    {
        $seeder = new seederPembagian();
    }

    function addTransaksiBaru()
    {
        $penginput = $_POST['penginput'];
        $tglInput = $_POST['tgl_input'];
        $tanggal = $_POST['tanggal'];
        $keterangan = $_POST['keterangan'];
        $nominalRaw = $_POST['nominal'];
        $nominal = str_replace('.', '', $nominalRaw);
        $akun = $_POST['akun'];

        $addStatus = $this->addTransaksi($penginput, $tglInput, $tanggal, $keterangan, $nominal, $akun);
        if ($addStatus) {
            $_SESSION['alertSukses'] = 'Berhasil menambah transaksi';
            header('Location: ../panitia/index.php?page=keuangan');
        } else {
            $_SESSION['alert'] = 'Gagal menambah transaksi';
            header('Location: ../panitia/index.php?page=keuangan');
        }
    }

    function hapusTransaksi()
    {
        $idTransaksi = $_POST['idTransaksi'];
        $status = $this->deleteTransaksi($idTransaksi);
        if ($status) {
            $_SESSION['alertSukses'] = 'Berhasil menghapus transaksi';
            header('Location: ../panitia/index.php?page=keuangan');
        }
    }

    function getAllKeuanganByTanggal()
    {
        return $this->getAllKeuanganByTanggal();
    }

    function getTotalDebetFoot()
    {
        $dataRaw = $this->getTotalDebetString();
        $data = explode('|', $dataRaw);
        return $data;
    }

    function getTotalTransaksiClean()
    {
        return $totalTransaksi = $this->getTotalTransaksi()->fetch_assoc()['totalTransaksi'];
    }

    function getTotalDebetClean()
    {
        return $totalDebet = $this->getTotalDebet()->fetch_assoc()['totalDebet'];
    }

    function getTotalKreditClean()
    {
        return $totalKredit = $this->getTotalKredit()->fetch_assoc()['totalKredit'];
    }

    function getTotalSaldoClean()
    {
        return $totalSaldo = $this->getTotalSaldo()->fetch_assoc()['totalSaldo'];
    }

    function getJumlahWargaClean()
    {
        return $this->getJumlahWarga();
    }

    function getJumlahBerqurbanClean()
    {
        return $this->getJumlahBerqurbanClean();
    }

    function getJumlahPanitiaClean()
    {
        return $this->getJumlahPanitia();
    }

    function getJumlahTotalClean()
    {
        return $this->getJumlahTotal();
    }

    function updateDaging()
    {
        $dagingKambing = $_POST['kambing'];
        $dagingSapi = $_POST['sapi'];

        $update = $this->updateDagingModel($dagingKambing, $dagingSapi);
        if ($update) {
            $this->seeder->seedPembagian();
            $_SESSION['alertSukses'] = 'Berhasil mengubah total daging';
        } else {
            $_SESSION['alert'] = 'Gagal mengubah total daging';
        }

        header('Location:../panitia/?page=pembagian');
    }

    function getTotalKambing()
    {
        return $this->getTotalKambingModel()->fetch_assoc()['berat'];
    }

    function getTotalSapi()
    {
        return $this->getTotalSapiModel()->fetch_assoc()['berat'];
    }

    function getAkun()
    {
        return $this->getAkunModel();
    }

    function getResult($keyword)
    {
        return $this->getResultModel($keyword);
    }

    function addQurban()
    {
        $hewan = $_POST['hewan'];
        $idAkun = $_POST['idAkun'];
        $status = $this->addQurbanModel($hewan, $idAkun);
        if ($status) {
            $this->seeder->seedPembagian();
            $_SESSION['alertSukses'] = 'Berhasil menambah qurban';
            header('Location: ../panitia?page=pengqurban');
        } else {
            $_SESSION['alert'] = 'Gagal menambah qurban';
            header('Location: ../panitia?page=pengqurban');
        }
    }

    function updateQurban()
    {
        $idQurban = $_POST['idQurban'];
        $hewan = $_POST['hewan'];
        $pengqurban = $_POST['idAkun'];
        $pengqurbanLama = $_POST['pengqurbanLama'];

        $status = $this->updateQurbanModel($idQurban, $hewan, $pengqurban, $pengqurbanLama);

        if ($status) {
            $this->seeder->seedPembagian();
            $_SESSION['alertSukses'] = "Berhasil mengupdate qurban";
            header('Location: ../panitia?page=pengqurban');
        } else {
            $_SESSION['alert'] = "Gagal mengupdate qurban";
            header('Location: ../panitia?page=pengqurban');
        }
    }

    function hapusQurban()
    {
        $idQurban = $_POST['id_qurban'];

        $status = $this->deleteQurban($idQurban);
        if ($status) {
            $this->seeder->seedPembagian();
            $_SESSION['alertSukses'] = "Berhasil menghapus qurban";
            header('Location: ../panitia?page=pengqurban');
        } else {
            $_SESSION['alert'] = "Gagal menghapus qurban";
            header('Location: ../panitia?page=pengqurban');
        }
    }

    function getPembagian()
    {
        return $this->getPembagianModel();
    }
}

$controller = new panitiaController();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action'])) {
        if ($_POST['action'] == 'gettotaldebet') {
            echo $controller->getTotalDebetFoot();
        } else if ($_POST['action'] == 'updateDaging') {
            $controller->updateDaging();
        } else if ($_POST['action'] == 'addQurban') {
            $controller->addQurban();
        } else if ($_POST['action'] == 'updateQurban') {
            $controller->updateQurban();
        } else if ($_POST['action'] == 'hapusQurban') {
            $controller->hapusQurban();
        }
    } else if (isset($_POST['penginput'])) {
        $controller->addTransaksiBaru();
    } else if (isset($_POST['idTransaksi'])) {
        $controller->hapusTransaksi();
    }
}
