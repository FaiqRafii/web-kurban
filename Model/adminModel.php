<?php
require_once 'koneksi.php';

class adminModel extends koneksi
{

    function getAllAkunByLevel()
    {
        $sql = $this->connect()->query("SELECT * FROM akun ORDER BY level");
        return $sql;
    }

    function getJumlahWarga() {
        $sql=$this->connect()->query("SELECT COUNT(*) AS jumlahWarga FROM akun WHERE level='warga'");
        return $jumlahWarga=$sql->fetch_assoc()['jumlahWarga'];
    }

    function getJumlahBerqurban() {
        $sql=$this->connect()->query("SELECT COUNT(*) AS jumlahBerqurban FROM akun WHERE level='berqurban'");
        return $jumlahBerqurban=$sql->fetch_assoc()['jumlahBerqurban'];
    }

    function getJumlahAdmin() {
        $sql=$this->connect()->query("SELECT COUNT(*) AS jumlahAdmin FROM akun WHERE level='admin'");
        return $jumlahAdmin=$sql->fetch_assoc()['jumlahAdmin'];
    }

    function getJumlahPanitia() {
        $sql=$this->connect()->query("SELECT COUNT(*) AS jumlahPanitia FROM akun WHERE level='panitia'");
        return $jumlahPanitia=$sql->fetch_assoc()['jumlahPanitia'];
    }

    function getJumlahTotal() {
        $sql=$this->connect()->query("SELECT COUNT(*) AS jumlah FROM akun");
        return $jumlah=$sql->fetch_assoc()['jumlah'];
    }
}
