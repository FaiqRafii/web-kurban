<?php
require_once 'koneksi.php';


class akunModel extends koneksi
{
    protected $akun;

    function getNama()
    {
        $sql = $this->connect()->query("SELECT nama FROM akun WHERE id_akun='" . $_SESSION['id_akun'] . "'");
        $nama = $sql->fetch_assoc()['nama'];
        return $nama;
    }

    function getAlamat()
    {
        $sql = $this->connect()->query("SELECT alamat FROM akun WHERE id_akun='" . $_SESSION['id_akun'] . "'");
        $alamat = $sql->fetch_assoc()['alamat'];
        return $alamat;
    }

    function getNoHp()
    {
        $sql = $this->connect()->query("SELECT no_hp FROM akun WHERE id_akun='" . $_SESSION['id_akun'] . "'");
        $noHp = $sql->fetch_assoc()['no_hp'];
        return $noHp;
    }

    function getNIK()
    {
        $sql = $this->connect()->query("SELECT id_akun FROM akun WHERE nama='" . $_SESSION['nama_akun'] . "'");
        $nik = $sql->fetch_assoc()['id_akun'];
        return $nik;
    }

    function getLevel()
    {
        $sql = $this->connect()->query("SELECT level FROM akun WHERE id_akun='" . $_SESSION['id_akun'] . "'");
        $level = $sql->fetch_assoc()['level'];
        return $level;
    }

    function login($nik)
    {
        $sql = $this->connect()->query("SELECT * FROM akun WHERE id_akun='" . $nik . "'");
        $isLogin = $sql->num_rows;

        if ($isLogin > 0) {
            $this->akun = $sql->fetch_assoc();
            return true;
        } else {
            return false;
        }
    }
}
