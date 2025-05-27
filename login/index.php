<?php
require_once '../Controller/loginController.php';
require_once '../View/loginView.php';


$view = new loginView();
$login = new loginController();

$login->cekIsLogin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login->validasiData();
}
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Easy Qurban | Login</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body class="relative flex justify-center items-center min-h-screen bg-neutral-100 font-montserrat overflow-hidden">
    <div class="absolute inset-0 z-0">
        <div class="bg-gradient-to-l from-[rgb(154,94,44)] to-[rgb(99,52,14)] h-3/7 w-screen absolute top-0 left-0"></div>
        <div class="text-white font-semibold text-5xl absolute left-30 top-40">Selamat Datang</div>
        <div class="bg-gradient-to-r from-[rgb(154,94,44)] to-[rgb(99,52,14)] max-h-full h-screen w-screen absolute top-3/7 left-0"></div>
        <div class="text-white font-thin text-sm absolute left-30 top-55">*Silahkan kontak <span><a href="" class="font-bold hover:underline">Admin</a></span> bila belum terdaftar</div>
    </div>

    <?php
    if ($_SESSION['alert']) {
        $view->alert($_SESSION['alert']);
        unset($_SESSION['alert']);
    }
    ?>




    <div class="absolute z-10 w-2/6 h-3/4 ml-150 rounded-2xl bg-white border border-neutral-300">
        <a href="../" class="flex justify-center items-center mt-10">
            <img src="../assets/img/logoScroll.png" class="w-25 h-fit" alt="">
        </a>
        <div class="mt-10 px-10">
            <form action="index.php" method="POST">
                <div class="flex justify-center items-center mb-10">
                    <h1 class=" font-bold text-xl">Login</h1>
                </div>
                <label for="input-group-1" class="block mb-2 text-sm  text-neutral-900">NIK</label>
                <div class="relative mb-4">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                        <svg fill="currentColor" class="text-neutral-400 w-5 h-fit" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path d="M12,11A5,5,0,1,0,7,6,5.006,5.006,0,0,0,12,11Zm0-8A3,3,0,1,1,9,6,3,3,0,0,1,12,3ZM3,22V18a5.006,5.006,0,0,1,5-5h8a5.006,5.006,0,0,1,5,5v4a1,1,0,0,1-2,0V18a3,3,0,0,0-3-3H8a3,3,0,0,0-3,3v4a1,1,0,0,1-2,0Z"></path>
                            </g>
                        </svg>
                    </div>
                    <input type="text" name="id_akun" id="id_akun" class="bg-neutral-50 border border-gray-300 text-gray-900 text-sm rounded-lg  focus:ring-blue-500 focus:border-neutral-500 block w-full ps-10 p-2.5" placeholder="Masukkan NIK Anda">
                </div>

                <div class="flex justify-center items-center mt-15">
                    <input type="submit" class="bg-gradient-to-l from-[rgb(154,94,44)] to-[rgb(99,52,14)] hover:bg-gradient-to-r  text-white hover:cursor-pointer hover:bg-[#5D320E] transition-all ease-in duration-75 px-5 py-1.5  font-semibold text-sm rounded">
                </div>
            </form>
        </div>
    </div>
</body>

<!-- <script src="assets/js/configUrl.js"></script> -->
<script src="../assets/js/alert.js"></script>

</html>