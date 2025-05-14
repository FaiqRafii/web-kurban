<?php
$page = isset($_GET['page']) ? $_GET['page'] : '';
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Easy Qurban</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" href="assets/img/logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">

    <style>
        .font-montserrat {
            font-family: 'Montserrat', sans-serif;
        }
    </style>
</head>

<?php include '../Utils/sidebar.php' ?>

<body class="p-4 sm:ml-64 font-montserrat">
    <?php
    if ($page != '') {
        include "$page.php";
    }else{
        include "dashboard.php";
    }
    ?>
</body>

</html>