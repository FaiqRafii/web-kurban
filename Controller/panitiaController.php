<?php
require_once '../Model/panitiaModel.php';
require_once '../Model/koneksi.php';



class panitiaController extends panitiaModel
{

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

        $update=$this->updateDagingModel($dagingKambing, $dagingSapi);
        if($update){
            $_SESSION['alertSukses'] = 'Berhasil mengubah total daging';
        }else{
            $_SESSION['alert'] = 'Gagal mengubah total daging';
        }

        header('Location:../panitia/?page=pembagian');
    }

    function getTotalKambing(){
        return $this->getTotalKambingModel()->fetch_assoc()['berat'];
    }

    function getTotalSapi(){
        return $this->getTotalSapiModel()->fetch_assoc()['berat'];
    }
}

$controller = new panitiaController();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action'])) {
        if ($_POST['action'] == 'gettotaldebet') {
            echo $controller->getTotalDebetFoot();
        }else if($_POST['action']=='updateDaging'){
            $controller->updateDaging();
        }
    } else if (isset($_POST['penginput'])) {
        $controller->addTransaksiBaru();
    } else if (isset($_POST['idTransaksi'])) {
        $controller->hapusTransaksi();
    }
}
