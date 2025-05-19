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

    function getNIK()
    {
        $sql = $this->connect()->query("SELECT nik FROM akun WHERE id_akun='" . $_SESSION['id_akun'] . "'");
        $nik = $sql->fetch_assoc()['nik'];
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
        $sql = $this->connect()->query("SELECT * FROM akun WHERE nik='" . $nik . "'");
        $isLogin = $sql->num_rows;

        if ($isLogin > 0) {
            $this->akun = $sql->fetch_assoc();
            return true;
        } else {
            return false;
        }
    }
}
