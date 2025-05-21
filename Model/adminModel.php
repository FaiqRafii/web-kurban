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

    function getAllKeuanganByTanggal()
    {
        $qAll = $this->connect()->query("SELECT * FROM keuangan ORDER BY tanggal");
        return $qAll;
    }

    function getTotalDebet()
    {
        $qDebet = $this->connect()->query("SELECT SUM(nominal) AS totalDebet FROM keuangan WHERE akun='debet'");
        return $qDebet;
    }

    function getTotalDebetString()
    {
        $qDebet = $this->connect()->query("SELECT SUM(nominal) AS totalDebet FROM keuangan WHERE akun='debet'");
        $debet = $qDebet->fetch_assoc()['totalDebet'];
        $saldoRaw = $this->getTotalSaldo()->fetch_assoc()['totalSaldo'];
        $saldo = number_format($saldoRaw ?? 0, 0, ',', '.');
        return "Rp" . number_format($debet ?? 0, 0, ',', '.') . '|' . "Rp" . $saldo;
    }

    function getTotalKredit()
    {
        $qKredit = $this->connect()->query("SELECT SUM(nominal) AS totalKredit FROM keuangan WHERE akun='kredit'");
        return $qKredit;
    }

    function getTotalSaldo()
    {
        $qSaldo = $this->connect()->query("SELECT saldo AS totalSaldo FROM keuangan ORDER BY id_transaksi DESC LIMIT 1");
        return $qSaldo;
    }

    function getTotalTransaksi()
    {
        $qTotal = $this->connect()->query("SELECT COUNT(*) AS totalTransaksi FROM keuangan");
        return $qTotal;
    }

    function addTransaksi($penginput, $tgl_input, $tanggal, $keterangan, $nominal, $akun)
    {
        $qIdTransaksiTerakhir = $this->connect()->query("SELECT saldo FROM keuangan ORDER BY id_transaksi DESC LIMIT 1");
        $saldoTerakhir = (int)$qIdTransaksiTerakhir->fetch_assoc()['saldo'];
        if ($akun == 'debet') {
            $saldoTerakhir += (int)$nominal;
            $add = $this->connect()->query("INSERT INTO keuangan (penginput, tgl_input, tanggal, keterangan, nominal, akun, saldo) VALUES ('" . $penginput . "', '" . $tgl_input . "', '" . $tanggal . "', '" . $keterangan . "', '" . $nominal . "', '" . $akun . "', '" . $saldoTerakhir . "') ");
            if ($add) {
                return true;
            } else {
                return false;
            }
        } else if ($akun == 'kredit') {
            $saldoTerakhir -= (int)$nominal;
            $add = $this->connect()->query("INSERT INTO keuangan (penginput, tgl_input, tanggal, keterangan, nominal, akun, saldo) VALUES ('" . $penginput . "', '" . $tgl_input . "', '" . $tanggal . "', '" . $keterangan . "', '" . $nominal . "', '" . $akun . "', '" . $saldoTerakhir . "') ");
            if ($add) {
                return true;
            } else {
                return false;
            }
        }
    }

    function deleteAkun($idAkun){
        foreach($idAkun as $akun){
            $hapus=$this->connect()->query("DELETE FROM akun WHERE id_akun='".$akun."'");
            if($hapus){
                $_SESSION['alertSukses']='Berhasil menghapus akun';
            }else{
                $_SESSION['alert']='Gagal menghapus akun';
            }
            header('Location: ../admin/');
        }
    }

    function deleteTransaksi($idTransaksi)
    {
        foreach ($idTransaksi as $transaksi) {
            $q = $this->connect()->query("SELECT * FROM keuangan WHERE id_transaksi='" . $transaksi . "'");
            $dataTransaksi = $q->fetch_assoc();
            if (!$dataTransaksi) continue;

            $saldoSebelum = 0;
            $qDataTerakhir = $this->connect()->query("SELECT saldo FROM keuangan WHERE id_transaksi<'$transaksi' ORDER BY id_transaksi DESC LIMIT 1");
            if ($qDataTerakhir->num_rows > 0) {
                $saldoSebelum = (int) $qDataTerakhir->fetch_assoc()['saldo'];
            }

            $hapus = $this->connect()->query("DELETE FROM keuangan WHERE id_transaksi='" . $transaksi . "'");

            $qDataSetelah = $this->connect()->query("SELECT * FROM keuangan WHERE id_transaksi>'$transaksi' ORDER BY id_transaksi ASC");
            $saldo = $saldoSebelum;
            while ($dataSetelah = $qDataSetelah->fetch_assoc()) {
                if ($dataSetelah['akun'] == 'debet') {
                    $saldo += (int) $dataSetelah['nominal'];
                } else if ($dataSetelah['akun'] == 'kredit') {
                    $saldo -= (int) $dataSetelah['nominal'];
                }
                $q = $this->connect()->query("UPDATE keuangan SET saldo='" . $saldo . "' WHERE id_transaksi='" . $dataSetelah['id_transaksi'] . "'");
            }
            $_SESSION['alertSukses'] = 'Berhasil menghapus transaksi';
            header('Location: ../admin/index.php?page=keuangan');
        }
    }
}
