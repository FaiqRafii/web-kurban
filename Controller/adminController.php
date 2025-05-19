<?php
require_once '../Model/adminModel.php';
require_once '../Model/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['action'] == 'updateField') {
    $idAkun = $_POST['idAkun'];
    $field = $_POST['field'];
    $value = $_POST['value'];

    $allowedFields = ['nama', 'noHp', 'alamat', 'nik', 'level'];
    if (!in_array($field, $allowedFields)) {
        echo 'Field tidak valid.';
        exit;
    }
    $koneksi = new koneksi();
    $update = $koneksi->connect()->query("UPDATE akun SET " . $field . " = '" . $value . "' WHERE id_akun='" . $idAkun . "'");
    if (!$update) {
        die('Update Gagal');
    }
}

class adminController extends adminModel
{

    function getAllAkunByLevel()
    {
        return $this->getAllAkunByLevel();
    }
}
