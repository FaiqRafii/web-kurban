<?php
require_once '../tampilan/wargaTampilan.php';
require_once '../action/wargaAction.php';
$action = new wargaAction();
$tampilan = new wargaTampilan();

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$status = $action->getStatus()->fetch_assoc()['status'];
if ($status == 'terbagi') {
    header('Location: ../' . $_SESSION["level_akun"] . '');
}
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="tampilanport" content="width=device-width, initial-scale=1.0">
    <title>Tiket Pengambilan Daging</title>
    <link rel="icon" href="../assets/img/icon.png">

    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .tiket {
            width: 700px;
            border: 1px solid #ccc;
            border-radius: 10px;
            overflow: hidden;
            display: flex;
        }

        .left {
            padding: 20px;
            width: 60%;
        }

        .right {
            padding: 20px;
            width: 40%;
            border-left: 1px dashed #ccc;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .qrTitle {
            font-size: 13px;
            text-align: center;
        }

        .qr-loading {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
            width: 100%;
        }

        .qr img {
            width: 150px;
            margin-top: 20px;
            border: none;
        }

        .info {
            margin-bottom: 10px;
        }

        .small {
            font-size: 10px;
            color: #555;
            margin-top: 20px;
        }

        .logo {
            display: flex;
            align-items: center;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .logo img {
            height: 20px;
            margin-right: 8px;
        }

        ul {
            padding-left: 20px;
        }
    </style>
</head>

<body>
    <div class="tiket">
        <div class="left">
            <div class="logo">
                <img src="../assets/img/logoScroll.png" alt="">
            </div>
            <div class="info"><strong>Nama:</strong> <?= $tampilan->getNama() ?></div>
            <div class="info"><strong>Alamat:</strong> <?= $tampilan->getAlamat() ?></div>
            <div class="info"><strong>No HP:</strong> <?= $tampilan->getNoHp() ?></div>
            <div class="info"><strong>Menerima:</strong>
                <?php $tampilan->pembagian() ?>
            </div>
            <div class="small">*harap menunjukkan qr-code saat mengambil daging</div>
        </div>
        <div class="right">
            <div class="qrTitle"><strong>QR-CODE PENGAMBILAN DAGING</strong></div>
            <div class="qr">
                <?php $tampilan->qrCodeTiket() ?>
            </div>
        </div>
    </div>
    <script>
        window.onload = function() {
            window.print();
        }
    </script>
</body>

</html>