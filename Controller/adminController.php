<?php
require_once '../Model/adminModel.php';
require_once '../Model/koneksi.php';



class adminController extends adminModel
{

    function getAllAkunByLevel()
    {
        return $this->getAllAkunByLevel();
    }

    function updateFields()
    {
        $idAkun = $_POST['idAkun'];
        $field = $_POST['field'];
        $value = $_POST['value'];

        $allowedFields = ['nama', 'noHp', 'alamat', 'nik', 'level'];
        if (!in_array($field, $allowedFields)) {
            echo 'Field tidak valid.';
            exit;
        }

        $this->updateAkun($field, $value, $idAkun);
    }

    function addAkunBaru()
    {
        $nama = ucwords($_POST['nama']);
        $nik = ucwords($_POST['nik']);
        $alamat = ucwords($_POST['alamat']);
        $noHp = ucwords($_POST['noHp']);
        $level = ucwords($_POST['level']);

        $addStatus = $this->addAkun($nama, $nik, $alamat, $noHp, $level);

        if ($addStatus) {
            $_SESSION['alertSukses'] = 'Berhasil menambah akun';
            header('Location: ../admin/');
        } else {
            $_SESSION['alert'] = 'Gagal menambah akun';
            header('Location: ../admin/');
        }
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
            header('Location: ../admin/index.php?page=keuangan');
        } else {
            $_SESSION['alert'] = 'Gagal menambah transaksi';
            header('Location: ../admin/index.php?page=keuangan');
        }
    }

    function hapusTransaksi(){
        $idTransaksi=$_POST['idTransaksi'];
        $this->deleteTransaksi($idTransaksi);
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
}

$controller = new adminController();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action'])) {
        if ($_POST['action'] == 'updateField') {
            $controller->updateFields();
        } else if ($_POST['action'] == 'add') {
            $controller->addAkunBaru();
        } else if ($_POST['action'] == 'gettotaldebet') {
            echo $controller->getTotalDebetFoot();
        }
    } else if (isset($_POST['idAkun'])) {
        $controller->addAkunBaru();
    } else if (isset($_POST['penginput'])) {
        $controller->addTransaksiBaru();
    }else if(isset($_POST['idTransaksi'])){
        $controller->hapusTransaksi();
    }
}
