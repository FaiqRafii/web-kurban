<?php
require_once '../tampilan/Content.php';
require_once '../database/akunDatabase.php';

session_start();
if ($_SESSION['level_akun'] != 'warga' && $_SESSION['level_akun'] != 'berqurban') {
    header('Location: ../');
}

$akun = new akunDatabase();
$content = new Content();
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="tampilanport" content="width=device-width, initial-scale=1.0">
    <title>Easy Qurban | Warga</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" href="../assets/img/icon.png">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">

</head>

<?php include 'sidebar.php' ?>

<body class="p-4 sm:ml-64 font-montserrat">
    <?php $content->loadContent($content->getPage()) ?>
</body>

</html>