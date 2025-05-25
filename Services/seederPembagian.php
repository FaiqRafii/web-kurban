<?php
require_once '../Model/koneksi.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

class seederPembagian extends koneksi
{

    function seedPembagian()
    {
        $resetTabel=$this->connect()->query("TRUNCATE TABLE pembagian");
        $qAkun = $this->connect()->query("SELECT * FROM akun");
        $jatahWarga = $this->getJatahWarga();
        $jatahBerqurban = $this->getJatahBerqurban();
        $idPengqurbanKambing = explode(', ', $this->getPengqurbanKambing());
        $idPengqurbanSapi = explode(', ', $this->getPengqurbanSapi());

        while ($akun = $qAkun->fetch_assoc()) {
            $insert = $this->connect()->query("INSERT INTO pembagian(id_akun,kambing,sapi) VALUES ('" . $akun['id_akun'] . "','" . $jatahWarga[0] . "','" . $jatahWarga[1] . "')");
        }

        foreach ($idPengqurbanKambing as $pKambing) {
            $kambing = $jatahBerqurban[0];
            $sapi = $jatahWarga[1];

            //cek apakah dia juga kurban sapi
            if (in_array($pKambing, $idPengqurbanSapi)) {
                $sapi = $jatahBerqurban[1];
            }

            //cek kalo dia di hewan yang sama qurban > 1
            $countKambing = $this->connect()->query("SELECT COUNT(*) AS jumlahQurbanKambing FROM pengqurban p JOIN qurban q ON p.id_qurban=q.id_qurban WHERE q.hewan='kambing' AND p.id_akun='$pKambing'")->fetch_column();
            $countSapi = $this->connect()->query("SELECT COUNT(*) AS jumlahQurbanSapi FROM pengqurban p JOIN qurban q ON p.id_qurban=q.id_qurban WHERE q.hewan='sapi' AND p.id_akun='$pKambing'")->fetch_column();

            if ($countKambing > 1) {
                $kambing *= $countKambing;
            }

            if ($countSapi > 1) {
                $sapi *= $countSapi;
            }

            $updateKambing = $this->connect()->query("UPDATE pembagian SET kambing='" . $kambing . "',sapi='" . $sapi . "' WHERE id_akun='" . $pKambing . "'");
        }

        foreach ($idPengqurbanSapi as $pSapi) {
            $kambing = $jatahWarga[0];
            $sapi = $jatahBerqurban[1];

            //cek apakah dia juga kurban kambing
            if (in_array($pSapi, $idPengqurbanKambing)) {
                $kambing = $jatahBerqurban[0];
            }

            //cek kalo dia di hewan yang sama qurban > 1
            $countKambing = $this->connect()->query("SELECT COUNT(*) AS jumlahQurbanKambing FROM pengqurban p JOIN qurban q ON p.id_qurban=q.id_qurban WHERE q.hewan='kambing' AND p.id_akun='$pSapi'")->fetch_column();
            $countSapi = $this->connect()->query("SELECT COUNT(*) AS jumlahQurbanSapi FROM pengqurban p JOIN qurban q ON p.id_qurban=q.id_qurban WHERE q.hewan='sapi' AND p.id_akun='$pSapi'")->fetch_column();

            if ($countKambing > 1) {
                $kambing *= $countKambing;
            }

            if ($countSapi > 1) {
                $sapi *= $countSapi;
            }
            $updateSapi = $this->connect()->query("UPDATE pembagian SET kambing='" . $kambing . "',sapi='" . $sapi . "' WHERE id_akun='" . $pSapi . "'");
        }

        if ($updateKambing && $updateSapi) {
            return true;
        } else {
            return false;
        }
    }

    function getPengqurbanKambing()
    {
        $q = $this->connect()->query("SELECT GROUP_CONCAT(p.id_akun SEPARATOR ', ') AS pengqurbanKambing FROM pengqurban p JOIN qurban q ON p.id_qurban=q.id_qurban WHERE q.hewan='kambing'");
        return $q->fetch_column();
    }

    function getPengqurbanSapi()
    {
        $q = $this->connect()->query("SELECT GROUP_CONCAT(p.id_akun SEPARATOR ', ') AS pengqurbanKambing FROM pengqurban p JOIN qurban q ON p.id_qurban=q.id_qurban WHERE q.hewan='sapi'");
        return $q->fetch_column();
    }

    function getJatahBerqurban()
    {
        $q = $this->connect()->query("SELECT COUNT(*) AS jumlah FROM pengqurban p JOIN qurban q on p.id_qurban=q.id_qurban WHERE q.hewan='kambing'");
        $jumlahPengqurbanKambing = $q->fetch_column();
        echo 'jumlah pengqurban kambing: ' . $jumlahPengqurbanKambing;
        $q = $this->connect()->query("SELECT COUNT(*) AS jumlah FROM pengqurban p JOIN qurban q on p.id_qurban=q.id_qurban WHERE q.hewan='sapi'");
        $jumlahPengqurbanSapi = $q->fetch_column();
        echo 'jumlah pengqurban sapi: ' . $jumlahPengqurbanSapi;

        $jatahKambing = 0;
        $jataSapi = 0;

        if ($jumlahPengqurbanKambing > 0) {
            $jatahKambingRaw = $this->connect()->query("SELECT (SUM(berat*0.05))/$jumlahPengqurbanKambing AS jatah FROM daging WHERE hewan='kambing'");
            $jatahKambing = number_format($jatahKambingRaw->fetch_column(), 2, '.');
            echo "jatah kambing: " . $jatahKambing;
        }

        if ($jumlahPengqurbanSapi > 0) {
            $jatahSapiRaw = $this->connect()->query("SELECT (SUM(berat*0.1))/$jumlahPengqurbanSapi AS jatah FROM daging WHERE hewan='sapi'");
            $jatahSapi = number_format($jatahSapiRaw->fetch_column(), 2, '.');
            echo "jatah sapi: " . $jatahSapi;
        }
        return [$jatahKambing, $jatahSapi];
    }

    function getJatahWarga()
    {
        $jatahKambing = 0;
        $jataSapi = 0;

        $jumlahPenerimaRaw = $this->connect()->query("SELECT COUNT(*) AS jumlah FROM akun WHERE level IN('admin','warga','panitia')");
        $jumlahPenerima = $jumlahPenerimaRaw->fetch_column();
        if ($jumlahPenerima > 0) {
            $jatahKambingRaw = $this->connect()->query("SELECT (SUM(berat*0.95))/$jumlahPenerima AS jatah FROM daging WHERE hewan='kambing'");
            $jatahKambing = number_format($jatahKambingRaw->fetch_column(), 2, '.');
            echo "jatah kambing: " . $jatahKambing;
            $jatahSapiRaw = $this->connect()->query("SELECT (SUM(berat*0.9))/$jumlahPenerima AS jatah FROM daging WHERE hewan='sapi'");
            $jatahSapi = number_format($jatahSapiRaw->fetch_column(), 2, '.');
            echo "jatah sapi: " . $jatahSapi;
        }

        return [$jatahKambing, $jatahSapi];
    }
}
new seederPembagian();
