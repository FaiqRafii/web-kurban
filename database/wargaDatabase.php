<?php
require_once 'koneksi.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

class wargaDatabase extends koneksi
{
    function getNamaDatabase()
    {
        return $qNama = $this->connect()->query("SELECT nama FROM akun WHERE id_akun='" . $_SESSION['id_akun'] . "'");
    }

    function getAlamatDatabase()
    {
        return $qAlamat = $this->connect()->query("SELECT alamat FROM akun WHERE id_akun='" . $_SESSION['id_akun'] . "'");
    }

    function getNoHpDatabase()
    {
        return $qNoHp = $this->connect()->query("SELECT no_hp FROM akun WHERE id_akun='" . $_SESSION['id_akun'] . "'");
    }

    function getJatahDatabase()
    {
        $q = $this->connect()->query("SELECT * FROM pembagian WHERE id_akun='" . $_SESSION['id_akun'] . "'");
        return $q;
    }

    function getStatusDatabase()
    {
        $q = $this->connect()->query("SELECT status FROM pembagian WHERE id_akun='" . $_SESSION['id_akun'] . "'");
        return $q;
    }
}
