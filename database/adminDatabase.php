<?php
require_once 'koneksi.php';
require_once '../pembagian/seederPembagian.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
class adminDatabase extends koneksi
{

    private $seeder;

    function __construct()
    {
        $this->seeder = new seederPembagian();
    }

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
        $this->seeder->seedPembagian();
    }

    function addAkun($nama, $idAkun, $alamat, $noHp, $level)
    {
        $add = $this->connect()->query("INSERT INTO akun (nama, alamat, id_akun, level, no_hp) VALUES ('" . $nama . "','" . $alamat . "','" . $idAkun . "','" . $level . "','" . $noHp . "')");
        if (!$add) {
            return false;
        } else {
            $this->seeder->seedPembagian();
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
        $qSaldo = $this->connect()->query("SELECT saldo AS totalSaldo FROM keuangan ORDER BY tanggal DESC LIMIT 1");
        return $qSaldo;
    }

    function getTotalTransaksi()
    {
        $qTotal = $this->connect()->query("SELECT COUNT(*) AS totalTransaksi FROM keuangan");
        return $qTotal;
    }

    function addTransaksi($penginput, $tgl_input, $tanggal, $keterangan, $nominal, $akun)
    {
        if ($akun == 'debet') {
            $add = $this->connect()->query("INSERT INTO keuangan (penginput, tgl_input, tanggal, keterangan, nominal, akun) VALUES ('" . $penginput . "', '" . $tgl_input . "', '" . $tanggal . "', '" . $keterangan . "', '" . $nominal . "', '" . $akun . "') ");
            if ($add) {
                $this->updateSaldoAll();
                return true;
            } else {
                return false;
            }
        } else if ($akun == 'kredit') {
            $add = $this->connect()->query("INSERT INTO keuangan (penginput, tgl_input, tanggal, keterangan, nominal, akun) VALUES ('" . $penginput . "', '" . $tgl_input . "', '" . $tanggal . "', '" . $keterangan . "', '" . $nominal . "', '" . $akun . "') ");
            if ($add) {
                $this->updateSaldoAll();
                return true;
            } else {
                return false;
            }
        }
    }

    function deleteAkun($idAkun)
    {
        foreach ($idAkun as $akun) {
            $hapusPembagian = $this->connect()->query("DELETE FROM pembagian WHERE id_akun='" . $akun . "'");
            $hapus = $this->connect()->query("DELETE FROM akun WHERE id_akun='" . $akun . "'");
            if ($hapus && $hapusPembagian) {
                $this->seeder->seedPembagian();
                $_SESSION['alertSukses'] = 'Berhasil menghapus akun';
            } else {
                $_SESSION['alert'] = 'Gagal menghapus akun';
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

            $hapus = $this->connect()->query("DELETE FROM keuangan WHERE id_transaksi='" . $transaksi . "'");

            $this->updateSaldoAll();
            return true;
        }
    }

    function updateSaldoAll()
    {
        $qDataSetelah = $this->connect()->query("SELECT * FROM keuangan ORDER BY tanggal ASC");
        $saldo = 0;
        while ($dataSetelah = $qDataSetelah->fetch_assoc()) {
            if ($dataSetelah['akun'] == 'debet') {
                $saldo += (int) $dataSetelah['nominal'];
            } else if ($dataSetelah['akun'] == 'kredit') {
                $saldo -= (int) $dataSetelah['nominal'];
            }
            $q = $this->connect()->query("UPDATE keuangan SET saldo='" . $saldo . "' WHERE id_transaksi='" . $dataSetelah['id_transaksi'] . "'");
        }
    }
}
