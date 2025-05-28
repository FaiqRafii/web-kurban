<?php
require_once 'koneksi.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

class wargaModel extends koneksi
{
    function getNamaModel()
    {
        return $qNama = $this->connect()->query("SELECT nama FROM akun WHERE id_akun='" . $_SESSION['id_akun'] . "'");
    }

    function getAlamatModel()
    {
        return $qAlamat = $this->connect()->query("SELECT alamat FROM akun WHERE id_akun='" . $_SESSION['id_akun'] . "'");
    }

    function getNoHpModel()
    {
        return $qNoHp = $this->connect()->query("SELECT no_hp FROM akun WHERE id_akun='" . $_SESSION['id_akun'] . "'");
    }

    function getJatahModel()
    {
        $q = $this->connect()->query("SELECT * FROM pembagian WHERE id_akun='" . $_SESSION['id_akun'] . "'");
        return $q;
    }

    function getStatusModel()
    {
        $q = $this->connect()->query("SELECT status FROM pembagian WHERE id_akun='" . $_SESSION['id_akun'] . "'");
        return $q;
    }
}
