<?php
require_once 'koneksi.php';

session_start();
class adminModel extends koneksi
{

    function getAllAkunByLevel()
    {
        $sql = $this->connect()->query("SELECT * FROM akun ORDER BY level");
        return $sql;
    }

    function getJumlahWarga()
    {
        $sql = $this->connect()->query("SELECT COUNT(*) AS jumlahWarga FROM akun WHERE level='warga'");
        return $jumlahWarga = $sql->fetch_assoc()['jumlahWarga'];
    }

    function getJumlahBerqurban()
    {
        $sql = $this->connect()->query("SELECT COUNT(*) AS jumlahBerqurban FROM akun WHERE level='berqurban'");
        return $jumlahBerqurban = $sql->fetch_assoc()['jumlahBerqurban'];
    }

    function getJumlahAdmin()
    {
        $sql = $this->connect()->query("SELECT COUNT(*) AS jumlahAdmin FROM akun WHERE level='admin'");
        return $jumlahAdmin = $sql->fetch_assoc()['jumlahAdmin'];
    }

    function getJumlahPanitia()
    {
        $sql = $this->connect()->query("SELECT COUNT(*) AS jumlahPanitia FROM akun WHERE level='panitia'");
        return $jumlahPanitia = $sql->fetch_assoc()['jumlahPanitia'];
    }

    function getJumlahTotal()
    {
        $sql = $this->connect()->query("SELECT COUNT(*) AS jumlah FROM akun");
        return $jumlah = $sql->fetch_assoc()['jumlah'];
    }

    function updateAkun($field, $value, $idAkun)
    {
        $update = $this->connect()->query("UPDATE akun SET " . $field . " = '" . $value . "' WHERE id_akun='" . $idAkun . "'");
        if (!$update) {
            die('Update gagal');
        }
    }

    function addAkun($nama, $nik, $alamat, $noHp, $level)
    {
        $add = $this->connect()->query("INSERT INTO akun (nama, alamat, nik, level, no_hp) VALUES ('" . $nama . "','" . $alamat . "','" . $nik . "','" . $level . "','" . $noHp . "')");
        if (!$add) {
            return false;
        } else {
            return true;
        }
    }

    function getAllKeuanganByTanggal(){
        $qAll=$this->connect()->query("SELECT * FROM keuangan ORDER BY tanggal");
        return $qAll;
    }

    function getTotalDebet(){
        $qDebet=$this->connect()->query("SELECT SUM(debet) AS totalDebet FROM keuangan");
        return $qDebet;
    }

    function getTotalDebetString(){
        $qDebet=$this->connect()->query("SELECT SUM(debet) AS totalDebet FROM keuangan");
        $debet=$qDebet->fetch_assoc()['totalDebet'];
        return number_format($debet??0,0,',','.');
    }

    function getTotalKredit(){
        $qKredit=$this->connect()->query("SELECT SUM(kredit) AS totalKredit FROM keuangan");
        return $qKredit;
    }

    function getTotalSaldo(){
        $qSaldo=$this->connect()->query("SELECT SUM(saldo) AS totalSaldo FROM keuangan");
        return $qSaldo;
    }

    function updateKeuangan($idTransaksi,$field,$value){
        $update=$this->connect()->query("UPDATE keuangan SET ".$field."='".$value."' WHERE id_transaksi='".$idTransaksi."'");
        if(!$update){
            die('Update gagal');
        }
    }
}
