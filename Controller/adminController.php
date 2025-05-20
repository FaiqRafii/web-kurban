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

    function getAllKeuanganByTanggal()
    {
        return $this->getAllKeuanganByTanggal();
    }

    function updateFieldsKeuangan(){
    $idTransaksi=$_POST['idTransaksi'];
    $field=$_POST['field'];
    $valueRaw=$_POST['value'];
    $value=str_replace('.','',$valueRaw);

    $this->updateKeuangan($idTransaksi,$field,$value);
    }

    function getTotalDebetFoot(){
       return $this->getTotalDebetString();
    }
}

$controller = new adminController();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action'])) {
        if ($_POST['action'] == 'updateField') {
            $controller->updateFields();
        } else if ($_POST['action'] == 'add') {
            $controller->addAkunBaru();
        }else if($_POST['action']=='updateFieldKeuangan'){
            $controller->updateFieldsKeuangan();
        }else if($_POST['action']=='gettotaldebet'){
            echo "Rp".$controller->getTotalDebetFoot();
        }
    }
}
