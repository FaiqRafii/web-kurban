<?php
require_once '../tampilan/Content.php';
require_once '../database/akunDatabase.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SESSION['level_akun'] != 'panitia') {
    header('Location: ../');
}

$akun = new akunDatabase();
$content = new Content();
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="tampilanport" content="width=device-width, initial-scale=1.0">
    <title>Easy Qurban | Panitia</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" href="../assets/img/icon.png">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">

</head>
<?php include 'sidebar.php' ?>

<body class="font-montserrat bg-white p-4 sm:ml-64">
    <?php $content->loadContent($content->getPage()) ?>

    <script src="../assets/js/date2.js"></script>
    <script src="../assets/js/alert.js"></script>
    <script src="../assets/js/admin.js"></script>

</body>

</html>