<?php
require_once 'koneksi.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
class panitiaModel extends koneksi
{

    function getAllAkunByLevel()
    {
        $sql = $this->connect()->query("SELECT * FROM akun ORDER BY level");
        return $sql;
    }

    function getAkunModel()
    {
        $akun = $this->connect()->query("SELECT * FROM akun");
        return $akun;
    }

    function getResultModel($keyword)
    {
        $q = $this->connect()->query("SELECT * FROM akun WHERE nama LIKE '%$keyword%'");
        return $q;
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

    function getQurbanAll()
    {
        $q = $this->connect()->query("SELECT GROUP_CONCAT(a.nama SEPARATOR ', ') AS nama, q.id_qurban, q.hewan FROM qurban q JOIN pengqurban p ON q.id_qurban=p.id_qurban JOIN akun a ON p.id_akun=a.id_akun GROUP BY q.id_qurban, q.hewan ORDER BY q.hewan");
        return $q;
    }

    function getIdAkunQurban($idQurban)
    {
        $q = $this->connect()->query("SELECT GROUP_CONCAT(p.id_akun SEPARATOR ', ') AS id_akun FROM pengqurban p WHERE p.id_qurban='" . $idQurban . "'");
        return $q;
    }

    function addQurbanModel($hewan, $idAkun)
    {
        $conn = $this->connect();
        $insertQurban = $conn->query("INSERT INTO qurban (hewan) VALUES ('" . $hewan . "')");
        $idQurban = $conn->insert_id;
        echo "idQurban: " . $idQurban;
        $idAkunArr = explode(", ", $idAkun);
        foreach ($idAkunArr as $p) {
            echo "idAkun: " . $p;
            $insertPengqurban = $this->connect()->query("INSERT INTO pengqurban(id_qurban,id_akun) VALUES ('" . $idQurban . "', '" . $p . "')");
            $levelRaw = $this->connect()->query("SELECT level FROM akun WHERE id_akun='" . $p . "'");
            $levelRaw2 = $levelRaw->fetch_assoc()['level'];
            $level = explode(", ", $levelRaw2);
            if ($level[0] !== 'berqurban' && $level[0] != 'warga') {
                $akun = $this->connect()->query("UPDATE akun SET level='" . $level[0] . ", berqurban' WHERE id_akun='" . $p . "'");
            } else if ($level[0] == 'warga') {
                $akun = $this->connect()->query("UPDATE akun SET level='berqurban' WHERE id_akun='" . $p . "'");
            }
        }
        if ($insertPengqurban && $akun) {
            return true;
        } else {
            return false;
        }
    }

    function updateQurbanModel($idQurban, $hewan, $pengqurban, $pengqurbanLama)
    {
        $pengqurbanBaruArr = explode(", ", $pengqurban);
        $pengqurbanLamaArr = explode(", ", $pengqurbanLama);
        foreach ($pengqurbanLamaArr as $arr) {
            $levelRaw = $this->connect()->query("SELECT level FROM akun WHERE id_akun='" . $arr . "'");
            $levelRaw2 = $levelRaw->fetch_assoc()['level'];
            $level = explode(", ", $levelRaw2);
            echo 'arrLama: ' . $arr;
            echo 'levelLama: ' . $level[0];
            if ($level[0] == 'berqurban') {
                if (in_array($arr, $pengqurbanBaruArr)) {
                    $akun = $this->connect()->query("UPDATE akun SET level='berqurban' WHERE id_akun='" . $arr . "'");
                } else {
                    $akun = $this->connect()->query("UPDATE akun SET level='warga' WHERE id_akun='" . $arr . "'");
                }
            } else {
                $akun = $this->connect()->query("UPDATE akun SET level='" . $level[0] . "' WHERE id_akun='" . $arr . "'");
            }
        }
        $deletePengqurban = $this->connect()->query("DELETE FROM pengqurban WHERE id_qurban='$idQurban'");

        echo "pengqurban: " . $pengqurban;
        echo "pengqurbanbaruarr[0]: " . $pengqurbanBaruArr[0];
        foreach ($pengqurbanBaruArr as $arr) {
            echo 'arrBaru: ' . $arr;
            $levelRaw = $this->connect()->query("SELECT level FROM akun WHERE id_akun='" . $arr . "'");
            $level = $levelRaw->fetch_assoc()['level'];
            echo 'levelBaru: ' . $level;
            if ($level == 'berqurban') {
                $akunBaru = $this->connect()->query("UPDATE akun SET level='berqurban' WHERE id_akun='" . $arr . "'");
            } else if ($level !== 'warga') {
                $akunBaru = $this->connect()->query("UPDATE akun SET level='" . $level . ", berqurban' WHERE id_akun= '" . $arr . "'");
            } else {
                $akunBaru = $this->connect()->query("UPDATE akun SET level='berqurban' WHERE id_akun='" . $arr . "'");
            }
            $update = $this->connect()->query("INSERT INTO pengqurban (id_qurban,id_akun) VALUES ('" . $idQurban . "','" . $arr . "')");
        }


        if ($akun && $akunBaru && $update) {
            return true;
        } else {
            return false;
        }
    }

    function deleteQurban($idQurban)
    {
        $qIdAkunPengqurban = $this->connect()->query("SELECT GROUP_CONCAT(id_akun SEPARATOR ', ') AS id_akun FROM pengqurban WHERE id_qurban='" . $idQurban . "'");
        $idAkunArr = explode(', ', $qIdAkunPengqurban->fetch_assoc()['id_akun']);
        foreach ($idAkunArr as $arrId) {
            $qLevelAkun = $this->connect()->query("SELECT level FROM akun WHERE id_akun='" . $arrId . "'");
            $levelAkun = explode(', ', $qLevelAkun->fetch_assoc()['level']);
            if ($levelAkun[0] == 'berqurban') {
                $updateAkun = $this->connect()->query("UPDATE akun SET level='warga' WHERE id_akun='".$arrId."'");
            } else {
                $updateAkun = $this->connect()->query("UPDATE akun SET level='" . $levelAkun[0] . "' WHERE id_akun='".$arrId."'");
            }
        }

        if ($updateAkun) {
            $qP = $this->connect()->query("DELETE FROM pengqurban WHERE id_qurban='" . $idQurban . "'");
            if ($qP) {
                $hapusQurban = $this->connect()->query("DELETE FROM qurban WHERE id_qurban='" . $idQurban . "'");
                if ($hapusQurban) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
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

    function updateDagingModel($dagingKambing, $dagingSapi)
    {
        $cek = $this->connect()->query("SELECT * FROM daging");
        if ($cek->num_rows > 1) {
            $updateKambing = $this->connect()->query("UPDATE daging SET berat='$dagingKambing' WHERE hewan='kambing'");
            $updateSapi = $this->connect()->query("UPDATE daging SET berat='$dagingSapi' WHERE hewan='sapi'");
            if ($updateKambing && $updateSapi) {
                return true;
            } else {
                return false;
            }
        } else {
            $insertKambing = $this->connect()->query("INSERT INTO daging (hewan, berat) VALUES ('kambing','" . $dagingKambing . "')");
            $insertSapi = $this->connect()->query("INSERT INTO daging (hewan, berat) VALUES ('sapi','" . $dagingSapi . "')");
            if ($insertKambing && $insertKambing) {
                return true;
            } else {
                return false;
            }
        }
    }

    function getTotalKambingModel()
    {
        $q = $this->connect()->query("SELECT berat FROM daging WHERE hewan='kambing'");
        return $q;
    }

    function getTotalSapiModel()
    {
        $q = $this->connect()->query("SELECT berat FROM daging WHERE hewan='sapi'");
        return $q;
    }
}
