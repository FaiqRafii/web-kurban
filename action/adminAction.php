<?php
require_once '../database/adminDatabase.php';
require_once '../database/koneksi.php';



class adminAction extends adminDatabase
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

        $allowedFields = ['nama', 'no_hp', 'alamat', 'level'];
        if (!in_array($field, $allowedFields)) {
            echo 'Field tidak valid.';
            exit;
        }

        $this->updateAkun($field, $value, $idAkun);
    }

    function addAkunBaru()
    {
        $nama = ucwords($_POST['nama']);
        $idAkun = ucwords($_POST['id_akun']);
        $alamat = ucwords($_POST['alamat']);
        $noHp = ucwords($_POST['noHp']);
        $level = ucwords($_POST['level']);

        $addStatus = $this->addAkun($nama, $idAkun, $alamat, $noHp, $level);

        if ($addStatus) {
            $_SESSION['alertSukses'] = 'Berhasil menambah akun';
            header('Location: ../admin/');
        } else {
            $_SESSION['alert'] = 'Gagal menambah akun';
            header('Location: ../admin/');
        }
    }

    function hapusAkun()
    {
        $idAkun = $_POST['idAkun'];
        $this->deleteAkun($idAkun);
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
            $this->updateSaldoAll();
            $_SESSION['alertSukses'] = 'Berhasil menambah transaksi';
            header('Location: ../admin/index.php?page=keuangan');
        } else {
            $_SESSION['alert'] = 'Gagal menambah transaksi';
            header('Location: ../admin/index.php?page=keuangan');
        }
    }

    function hapusTransaksi()
    {
        $idTransaksi = $_POST['idTransaksi'];
        $status=$this->deleteTransaksi($idTransaksi);
        if($status){
            $_SESSION['alertSukses'] = 'Berhasil menghapus transaksi';
            header('Location: ../admin/index.php?page=keuangan');
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
        $totalSaldoRaw = $this->getTotalSaldo();
        if(!empty($totalSaldoRaw)){
            $totalSaldo=$totalSaldoRaw->fetch_assoc();
            if($totalSaldo&&isset($totalSaldo['totalSaldo'])){
                return $totalSaldo['totalSaldo'];
            }
        }
        return 0;
    }
}

$action = new adminAction();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action'])) {
        if ($_POST['action'] == 'updateField') {
            $action->updateFields();
        } else if ($_POST['action'] == 'add') {
            $action->addAkunBaru();
        } else if ($_POST['action'] == 'gettotaldebet') {
            echo $action->getTotalDebetFoot();
        }
    } else if (isset($_POST['idAkun'])) {
        $action->hapusAkun();
    } else if (isset($_POST['penginput'])) {
        $action->addTransaksiBaru();
    } else if (isset($_POST['idTransaksi'])) {
        $action->hapusTransaksi();
    }
}
