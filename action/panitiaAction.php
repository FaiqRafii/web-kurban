<?php
require_once '../database/panitiaDatabase.php';
require_once '../database/koneksi.php';
require_once '../pembagian/seederPembagian.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


class panitiaAction extends panitiaDatabase
{

    private $seeder;

    function __construct()
    {
        $this->seeder = new seederPembagian();
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

        $update = $this->updateDagingDatabase($dagingKambing, $dagingSapi);
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
        return $this->getTotalKambingDatabase()->fetch_assoc()['berat'];
    }

    function getTotalSapi()
    {
        return $this->getTotalSapiDatabase()->fetch_assoc()['berat'];
    }

    function getAkun()
    {
        return $this->getAkunDatabase();
    }

    function getResult($keyword)
    {
        return $this->getResultDatabase($keyword);
    }

    function addQurban()
    {
        $hewan = $_POST['hewan'];
        $idAkun = $_POST['idAkun'];
        $status = $this->addQurbanDatabase($hewan, $idAkun);
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

        $status = $this->updateQurbanDatabase($idQurban, $hewan, $pengqurban, $pengqurbanLama);

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
        return $this->getPembagianDatabase();
    }

    function checkedStatus()
    {
        $idPembagian = $_POST['id'];
        $status = $this->checkedStatusDatabase($idPembagian);
    }

    function uncheckedStatus()
    {
        $idPembagian = $_POST['id'];
        $status = $this->uncheckedStatusDatabase($idPembagian);
    }

    function getTerbagiKambing()
    {
        return $this->getTerbagiKambingDatabase();
    }

    function getTerbagiSapi()
    {
        return $this->getTerbagiSapiDatabase();
    }

    function searchJatah($keyword)
    {
        return $this->searchJatahDatabase($keyword);
    }

    function getJatah()
    {
        $idPembagian = $_GET['searchjt'];
        $jatahAll = $this->getJatahDatabase($idPembagian)->fetch_assoc();
        $kambing = number_format($jatahAll['kambing'], 2);
        $sapi = number_format($jatahAll['sapi'], 2);
        $status = $jatahAll['status'];
        if ($status == 'terbagi') {
            $status = 'Sudah Menerima';
        } else {
            $status = 'Belum Menerima';
        }
        $data = [
            "kambing" => $kambing,
            "sapi" => $sapi,
            "status" => $status
        ];
        echo json_encode($data);
    }
}

$action = new panitiaAction();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action'])) {
        if ($_POST['action'] == 'gettotaldebet') {
            echo $action->getTotalDebetFoot();
        } else if ($_POST['action'] == 'updateDaging') {
            $action->updateDaging();
        } else if ($_POST['action'] == 'addQurban') {
            $action->addQurban();
        } else if ($_POST['action'] == 'updateQurban') {
            $action->updateQurban();
        } else if ($_POST['action'] == 'hapusQurban') {
            $action->hapusQurban();
        } else if ($_POST['action'] == 'checkedStatus') {
            $action->checkedStatus();
        } else if ($_POST['action'] == 'uncheckedStatus') {
            $action->uncheckedStatus();
        }
    } else if (isset($_POST['penginput'])) {
        $action->addTransaksiBaru();
    } else if (isset($_POST['idTransaksi'])) {
        $action->hapusTransaksi();
    }
} else if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['searchjt'])) {
        $action->getJatah();
    }
}
