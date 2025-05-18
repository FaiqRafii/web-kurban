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
        echo 'Alart sebelum unset: '. $_SESSION['alert'];
        unset($_SESSION['alert']);
        echo 'Alart setelah unset: '. $_SESSION['alert'];
    }
    ?>




    <div class="absolute z-10 w-2/6 h-3/4 ml-150 rounded-2xl bg-white border border-neutral-300">
        <div class="flex justify-center items-center mt-10">
            <img src="../assets/img/logoScroll.png" class="w-25 h-fit" alt="">
        </div>
        <div class="mt-10 px-10">
            <form action="index.php" method="POST">
                <div class="flex justify-center items-center mb-5">
                    <h1 class=" font-bold text-xl">Login</h1>
                </div>
                <label for="input-group-1" class="block mb-2 text-sm  text-gray-900">Email</label>
                <div class="relative mb-4">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">
                            <path d="m10.036 8.278 9.258-7.79A1.979 1.979 0 0 0 18 0H2A1.987 1.987 0 0 0 .641.541l9.395 7.737Z" />
                            <path d="M11.241 9.817c-.36.275-.801.425-1.255.427-.428 0-.845-.138-1.187-.395L0 2.6V14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2.5l-8.759 7.317Z" />
                        </svg>
                    </div>
                    <input type="email" name="email" id="email" class="bg-neutral-50 border border-gray-300 text-gray-900 text-sm rounded-lg  focus:ring-blue-500 focus:border-neutral-500 block w-full ps-10 p-2.5" placeholder="name@gmail.com">
                </div>
                <label for="input-group-1" class="block mb-3 text-sm  text-gray-900">Password</label>
                <div class="relative mb-10">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                        <svg viewBox="0 0 24 24" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M18.9771 14.7904C21.6743 12.0932 21.6743 7.72013 18.9771 5.02291C16.2799 2.3257 11.9068 2.3257 9.20961 5.02291C7.41866 6.81385 6.8169 9.34366 7.40432 11.6311C7.49906 12 7.41492 12.399 7.14558 12.6684L3.43349 16.3804C3.11558 16.6984 2.95941 17.1435 3.00906 17.5904L3.24113 19.679C3.26587 19.9017 3.36566 20.1093 3.52408 20.2677L3.73229 20.4759C3.89072 20.6343 4.09834 20.7341 4.32101 20.7589L6.4096 20.9909C6.85645 21.0406 7.30164 20.8844 7.61956 20.5665L8.32958 19.8565L6.58343 18.1294C6.28893 17.8382 6.28632 17.3633 6.5776 17.0688C6.86888 16.7743 7.34375 16.7717 7.63825 17.063L9.39026 18.7958L11.3319 16.8541C11.6013 16.5848 12 16.5009 12.3689 16.5957C14.6563 17.1831 17.1861 16.5813 18.9771 14.7904ZM12.5858 8.58579C13.3668 7.80474 14.6332 7.80474 15.4142 8.58579C16.1953 9.36684 16.1953 10.6332 15.4142 11.4142C14.6332 12.1953 13.3668 12.1953 12.5858 11.4142C11.8047 10.6332 11.8047 9.36684 12.5858 8.58579Z" fill="#99a1af"></path>
                            </g>
                        </svg>
                    </div>
                    <input type="password" name="password" id="ipassword" class="bg-neutral-50 border border-gray-300 text-gray-900 text-sm rounded-lg  focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5" placeholder="Masukkan password anda">
                </div>
                <div class="flex justify-center items-center">
                    <input type="submit" class="bg-gradient-to-l from-[rgb(154,94,44)] to-[rgb(99,52,14)] hover:bg-gradient-to-r  text-white hover:cursor-pointer hover:bg-[#5D320E] transition-all ease-in duration-75 px-5 py-1.5  font-semibold text-sm rounded">
                </div>
            </form>
        </div>
    </div>
</body>

<!-- <script src="assets/js/configUrl.js"></script> -->
<script src="assets/js/alert.js"></script>

</html>